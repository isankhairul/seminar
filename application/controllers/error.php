<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller {
    function __construct(){
	parent::__construct();
        $this->load->model('front/reward_model');
	$this->load->model('front/history_model');
    }
        
    public function index()
    {
        $this->doview('error_pageCustom');
    }
    
}