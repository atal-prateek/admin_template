<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index(){
		loginredirect();
		$this->session->unset_userdata("username");
		$style['file']="includes/plugins/iCheck/square/blue.css";
		$data['styles']=$style;
		$data['title']="Login";
		$data['body_class']="login-page";
		$this->load->view('includes/top-section',$data);
		$this->load->view('pages/login');
	}
	
	public function forgotpassword(){
		$this->session->unset_userdata("username");
		$data['title']="Forgot Password";
		$data['body_class']="login-page";
		$this->load->view('includes/top-section',$data);
		$this->load->view('pages/forgotpassword');
	}
	
	public function enterotp(){
		if($this->session->userdata('username')===NULL){redirect('/');}
		$data['title']="Enter OTP";
		$data['body_class']="login-page";
		$this->load->view('includes/top-section',$data);
		$this->load->view('pages/enterotp');
	}
	
	public function resetpassword(){
		if($this->session->userdata('username')===NULL){redirect('/');}
		$data['title']="Reset Password";
		$data['body_class']="login-page";
		$this->load->view('includes/top-section',$data);
		$this->load->view('pages/resetpassword');
	}
	
	public function privacypolicy(){
		$data['title']="Privacy Policy";
		$data['body_class']="login-page";
		$this->load->view('includes/top-section',$data);
		$this->load->view('pages/privacypolicy');
	}
	
	public function validatelogin(){
		
		$data=$this->input->post();
		unset($data['login']);
		$result=$this->Account_model->login($data);
		if($result['verify']===true){
			$this->startsession($result);
			loginredirect();
		}
		else{ 
			$this->session->set_flashdata('logerr',$result['verify']);
			redirect('login/');
		}
	}
	
	public function startsession($result){
		$data['user']=md5($result['id']);
		$data['name']=$result['name'];
		$data['role']=$result['role'];
		$this->session->set_userdata($data);
	}
	
	public function logout(){
		if($this->session->userdata('user')!==NULL){
			$data=array("user","name","role","section");
			$this->session->unset_userdata($data);
		}
		redirect('login/');
	}
	
	
	public function validateUser(){
		if($this->input->post('forgotpassword')!==NULL){
			$username=$this->input->post('username');
			$result=$this->Account_model->sendotp($username);
			if($result['status']===true){
				$otp=$result['otp'];
				$verification_msg="$otp is your One Time Password to Reset password . This OTP is valid for 15 minutes. Ratnesh Product Marketing Pvt. Ltd.";
				$smsdata=array("mobile"=>$result['mobile'],"message"=>$verification_msg);
				send_sms($smsdata);
				$this->session->set_userdata("username",$username);
				redirect('login/enterotp/'.$otp);
			}
			else{
				$this->session->set_flashdata("logerr","Username not valid!");
				redirect('login/forgotpassword/');
			}
		}
		else{
			redirect('login/');
		}
	}
	
	public function validateOTP(){
		if($this->session->userdata('username')===NULL){redirect('login/');}
		if($this->input->post('submitotp')!==NULL){
			$data['otp']=$this->input->post('otp');
			$data['username']=$this->session->userdata("username");
			$result=$this->Account_model->verifyotp($data);
			if($result['verify']===true){
				redirect('login/resetpassword/');
			}
			else{
				$this->session->set_flashdata("logerr",$result['verify']);
				redirect('login/enterotp/');
			}
		}
		redirect('login/');
	}
	
	public function skipreset(){
		if($this->session->userdata('username')!==NULL){
			$username=$this->session->userdata("username");
			$this->session->unset_userdata("username");
			$result=$this->Account_model->getuser(array("username"=>$username));
			$this->startsession($result);
			redirect('/');
		}
		redirect("login/");
	}
	
	public function changepassword(){
		if($this->session->userdata('username')!==NULL){
			$password=$this->input->post('password');
			$username=$this->session->userdata("username");
			$where['username']=$username;
			$result=$this->Account_model->changepassword($password,$where);
		}
		redirect('login/');
	}
}
