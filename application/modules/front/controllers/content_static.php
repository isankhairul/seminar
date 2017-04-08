<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_static extends MY_Controller {
    function __construct(){
		parent::__construct();
	
    }
    
    
    public function index(){

        $file   = $this->uri->segment(2);

	   	$this->frview('content/'.$file);
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */