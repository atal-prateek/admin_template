<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	if(!function_exists('generate_slug')) {
  		function generate_slug($string) {
    		// Getting CI class instance.
    		$ci=& get_instance();
			$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
			$slug=trim($slug,'-');
			return $slug;
		}  
	}
	if(!function_exists('verify_slug')){
		function verify_slug($table,$slug,$id=''){
			$ci=& get_instance();
			
			$where['slug']=$slug;
			if($id!=''){
				$where['id']=$id;
			}
			$count=$ci->db->get_where($table,$where)->num_rows();
			if($count==0){
				return $slug;
			}
			else{
				$slug=increment_string($slug, '-',2);
				return verify_slug($table,$slug);
			}
		}
	}
?>