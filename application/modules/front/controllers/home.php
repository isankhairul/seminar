<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model(array('m_seminar'));
	
    }
    
    
    public function index(){
    	$today = date('Y-m-d H:i:s');
    	$data['seminar'] = $this->m_seminar->getDataKey('seminar', array('status_seminar' => 1, 'DATE_FORMAT(jadwal_seminar, "%Y-%m-%d %H:%i:%s") >=' => $today), 'jadwal_seminar asc', 3);
		//echo '<pre>',print_r($data);
	   	$this->frview('v_home',$data);
    }

     public function profil(){

       $this->frview('v_profil');
    }
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */