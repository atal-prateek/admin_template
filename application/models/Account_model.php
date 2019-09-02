<?php
class Account_model extends CI_Model{
	
	private $table1="users";
	private $table2="addressbook";
	
	function __construct(){
		parent::__construct(); 
	}
	
	public function checkUser($data){
		$this->db->where($data);
		$this->db->from("wh_users");
		return $this->db->count_all_results();
	}	
	
	public function register($data){
		$salt=random_string('alnum', 16);
		$password=md5($data['password'].SITE_SALT.$salt);
		$otp=random_string('numeric',6);
		$encotp=md5($otp.SITE_SALT.$salt);
		$data['password']=$password;
		$data['salt']=$salt;
		$data['otp']=$encotp;
		$data['created_on']=date('Y-m-d H:i:s');
		$data['updated_on']=date('Y-m-d H:i:s');
		$data['status']=0;
		if($this->db->insert("wh_users",$data)){
			return array("status"=>true,"otp"=>$otp);
		}
	}
	
	public function login($data){
		$username=$data['username'];		
		$password=$data['password'];
		$this->db->where('username', $username);
		$query = $this->db->get("wh_users");
		$result=$query->row_array();
		if(!empty($result)){
			$salt=$result['salt'];
			$password=md5($password.SITE_SALT.$salt);
			$hashpassword=$result['password'];
			if($password==$hashpassword && $result['status']==1){
				$result['verify']=true;
			}
		}
		if(!isset($result['verify'])){ $result=array('verify'=>"Wrong Password!"); }
		return $result;
	}
	
	public function update_token($token,$id){
		$this->db->where('id',$id);
		$this->db->update('wh_users',array('token'=>$token));
	}
	
	public function verify_user($data){
		$token=$data['token'];		
		$otp=$data['otp'];
		$where['token']=$token;
		$query = $this->db->get_where("wh_users",$where);
		$result=$query->row_array();
		if(!empty($result)){
			if(time()-strtotime($result['updated_on'])<900){
				$salt=$result['salt'];
				$otp=md5($otp.SITE_SALT.$salt);
				$hashotp=$result['otp'];
				if($otp==$hashotp){
					$this->db->where($where);
					$this->db->update("wh_users",array("status"=>1));
					$result['verify']=true;
				}
			}
			else{
				$result['verify']="OTP Expired!";
			}
		}
		else{ $result['verify']="Invalid Login"; }
		if(!isset($result['verify'])){ $result['verify']="Invalid OTP!"; }
		return $result;
	}
	
	public function verify_token($token){
		$getuser=$this->db->get_where('wh_users',"token='$token'");
		$array=$getuser->row_array();
		if(is_array($array)){
			return $array;
		}
		else{
			return false;
		}
	}
		
	public function signup($data){
		$salt=random_string('alnum', 16);
		$password=md5($data['password'].SITE_SALT.$salt);
		$otp=random_string('numeric',6);
		$encotp=md5($otp.SITE_SALT.$salt);
		$data['password']=$password;
		$data['salt']=$salt;
		$data['otp']=$encotp;
		$data['created_on']=date('Y-m-d H:i:s');
		$data['updated_on']=date('Y-m-d H:i:s');
		$data['status']=0;
		if($this->db->insert("wh_users",$data)){
			return array("status"=>true,"otp"=>$otp);
		}
	}
	
	public function sendotp($username){
		$where['username']=$username;
		if(preg_match('/[\d]{10}/', $username) || $username=='admin'){
		$query = $this->db->get_where("wh_users",$where);
			if($query->num_rows()>0){
				$result=$query->row_array();
				$otp=random_string('numeric',6);
				$encotp=md5($otp.SITE_SALT.$result['salt']);
				$data['otp']=$encotp;
				$data['updated_on']=date('Y-m-d H:i:s');
				$this->db->where($where);
				if($this->db->update("wh_users",$data)){
					if($result['status']==1){ $type="login"; }
					else{ $type="activate"; }
					return array("status"=>true,"otp"=>$otp, "type"=>$type, "id"=>$result['id'], "name"=>$result['name'], "email"=>$result['email'], "mobile"=>$result['mobile']);
				}
			}
			else{
				$data['username']=$username;
				$data['mobile']=$username;
				$salt=random_string('alnum', 16);
				$otp=random_string('numeric',6);
				$encotp=md5($otp.SITE_SALT.$salt);
				$data['salt']=$salt;
				$data['otp']=$encotp;
				$data['created_on']=date('Y-m-d H:i:s');
				$data['updated_on']=date('Y-m-d H:i:s');
				$data['status']=0;
				if($this->db->insert("wh_users",$data)){
					$id=$this->db->insert_id();
					return array("status"=>true,"otp"=>$otp, "type"=>"activate", "id"=>$id, "name"=>"", "email"=>"", "mobile"=>$username);
				}
			}
		}
		else{
			return array("status"=>false,"msg"=>"Enter Valid Mobile No.!");
		}
	}
	
	public function verifyotp($data){
		$username=$data['username'];		
		$otp=$data['otp'];
		$where['username']=$username;
		$query = $this->db->get_where("wh_users",$where);
		$result=$query->row_array();
		if(!empty($result)){
			if(time()-strtotime($result['updated_on'])<900){
				$salt=$result['salt'];
				$otp=md5($otp.SITE_SALT.$salt);
				$hashotp=$result['otp'];
				if($otp==$hashotp){
					$this->db->where($where);
					$this->db->update("wh_users",array("status"=>1));
					$result['verify']=true;
				}
			}
			else{
				$result['verify']="OTP Expired!";
			}
		}
		if(!isset($result['verify'])){ $result['verify']="Invalid OTP!"; }
		return $result;
	}
	
	public function getuser($where,$type=true){
		$query = $this->db->get_where("wh_users",$where);
		if($type){ $result=$query->row_array(); }
		else{ $result=$query->row(); }
		return $result;
	}
	
	public function changepassword($password,$where){
		$query = $this->db->get_where("wh_users",$where);
		$result=$query->row_array();
		$checkpass=false;
		if(!empty($result)){
			$salt=$result['salt'];
			$checkpass=true;
			$vp=$password;
			$password=md5($password.SITE_SALT.$salt);
			$this->db->where($where);
			$this->db->update("wh_users",array("password"=>$password,"vp"=>$vp));
		}
		return $checkpass;
	}
	
	public function updatepassword($data){
		$oldpass=$data['oldpass'];
		$password=$data['password'];
		$user=$data['user'];
		$where="md5(id)='$user'";
		$query = $this->db->get_where("wh_users",$where);
		$result=$query->row_array();
		$checkpass=false;
		if(!empty($result)){
			$salt=$result['salt'];
			$oldpass=md5($oldpass.SITE_SALT.$salt);
			$hashpassword=$result['password'];
			if($oldpass==$hashpassword){
				$checkpass=true;
				$vp=$password;
				$password=md5($password.SITE_SALT.$salt);
				$this->db->where($where);
				$this->db->update("wh_users",array("password"=>$password,"vp"=>$vp));
			}
		}
		return $checkpass;
	}
}