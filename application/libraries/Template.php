<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Template {
    var $ci;
	private $styles=array("link"=>array(),"file"=>array());
	private $top_script=array("link"=>array(),"file"=>array());
	private $bottom_script=array("link"=>array(),"file"=>array());
      
    function __construct() {
       $this->ci =& get_instance();
    }
	
    function load($folder, $view, $data) {
		$location=$folder.'/';
		
		if(!empty($data['styles'])){ 
			$styles=$data['styles'];
			foreach($styles as $key=>$style){
				if(is_array($style)){
					foreach($style as $single_style){
						if(array_search($single_style,$this->styles[$key])===false)
							$this->styles[$key][]=$single_style;
					}
				}
				else{
					if(array_search($style,$this->styles[$key])===false)
						$this->styles[$key][]=$style;
				}
			}
		}
		
		if(!empty($data['top_script'])){ 
			$top_script=$data['top_script'];
			foreach($top_script as $key=>$script){
				if(is_array($script)){
					foreach($script as $single_script){
						if(array_search($single_script,$this->top_script[$key])===false)
							$this->top_script[$key][]=$single_script;
					}
				}
				else{
					if(array_search($script,$this->top_script[$key])===false)
						$this->top_script[$key][]=$script;
				}
			}
		}
		
		if(!empty($data['bottom_script'])){ 
			$bottom_script=$data['bottom_script'];
			foreach($bottom_script as $key=>$script){
				if(is_array($script)){
					foreach($script as $single_script){
						if(array_search($single_script,$this->bottom_script[$key])===false)
							$this->bottom_script[$key][]=$single_script;
					}
				}
				else{
					if(array_search($script,$this->bottom_script[$key])===false)
						$this->bottom_script[$key][]=$script;
				}
			}
		}
		if(isset($data['datatable']) && $data['datatable']===true){
			$this->loaddatatable();
		}
		if(isset($data['select2']) && $data['select2']===true){
			$this->loadselect2();
		}
		if(isset($data['rangepicker']) && $data['rangepicker']===true){
			$this->loadrangepicker();
		}
		$data['styles']=$this->styles;
		$data['top_script']=$this->top_script;
		$data['bottom_script']=$this->bottom_script;
		$data['user']['photo']=file_url("assets/images/blank.png");
		$data['remember']='';
		$this->ci->load->view('includes/top-section',$data);
		$this->ci->load->view('includes/header');
		$this->ci->load->view('includes/sidebar');
		$this->ci->load->view($location.$view);
		$this->ci->load->view('includes/bottom-section');
	}
	
	function loaddatatable(){
		$this->styles['link'][]="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css";
		$this->styles['link'][]="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css";
		$this->styles['link'][]="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css";
		$this->top_script['link'][]="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js";
		$this->top_script['link'][]="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js";
		$this->top_script['link'][]="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js";
		$this->top_script['link'][]="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js";
		$this->top_script['link'][]="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js";
	}
	
	function loadselect2(){
		$this->styles['file'][]="includes/plugins/select2/select2.min.css";
		$this->bottom_script['file'][]="includes/plugins/select2/select2.full.min.js";
	}
	
	function rangepicker(){
		$this->styles['file'][]="plugins/daterangepicker/daterangepicker.css";
		$this->bottom_script['link'][]="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js";
		$this->bottom_script['file'][]="plugins/daterangepicker/daterangepicker.js";
	}
}
