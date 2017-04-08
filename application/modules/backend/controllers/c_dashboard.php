<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends MY_Controller {
    protected $sessionData;    
    function __construct(){
	parent::__construct();
	$this->sessionData = $this->session->userdata('CMS_logged_in');
        
	if(!$this->sessionData){
	    redirect('backend/c_login');
	}
    }
	
    public function index()
    {
	$data = array();
	$this->doview('v_dashboard', $data);
    }
	
	
}

?>
