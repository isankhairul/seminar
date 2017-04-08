<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {
    
    function __construct(){
	parent::__construct();
	date_default_timezone_set("Asia/Jakarta");
//=======================================AUTHENTICATION & GET DATA ADVERTISOR FOR HEADER=======================================\\
	//$this->sessionData = $this->session->userdata('CMS_logged_in');
	//if($this->sessionData){
	//    if($this->uri->segment(1) == 'dashboard'){ 
	//	$this->result = true;
	//    }
	//    if($this->result){
	//	redirect('dashboard');
	//    }else{
	//	redirect('backend/c_login');
	//    }	    
	//}else{	    
	//    redirect('backend/c_login');
	//}
	

    }
        
    function doview($template, $data = array()) {
        $this->load->view('backend/header', $data);
        $this->load->view('backend/SideMenu', $data);
        $this->load->view($template, $data);
    }

    function frview($template, $data = array()) {
        $this->load->view('front/header', $data);
        $this->load->view($template, $data);
        //$this->load->view('front/footer', $data);
    }
}