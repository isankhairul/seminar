<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_seminar extends MY_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model(array('m_seminar'));
	
    }
    
    
    public function index(){

        ($_GET['search']) ? $search = $_GET['search'] : $search = "";

        $today = date('Y-m-d H:i:s');
        $data['page']           = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; 
        $data['start']          = $this->uri->segment(2, 0);

        $config['base_url']     = site_url('seminar');
        

        $query_string = $_GET;
        if (isset($query_string['page']))
        {
            unset($query_string['page']);
        }

        if (count($query_string) > 0)
        {
            $config['suffix'] = '?' . http_build_query($query_string, '', "&");
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($query_string, '', "&"); 
        }


        $config['total_rows']   = count($this->m_seminar->getDataSeminar('seminar', array('status_seminar' => 1, 'DATE_FORMAT(jadwal_seminar, "%Y-%m-%d %H:%i:%s") >=' => $today), 'jadwal_seminar desc', $search, '', ''));
        $config['per_page']     = 10;
        $config["uri_segment"]  = 2;
        $choice                 = $config["total_rows"] / $config["per_page"];
        $config["num_links"]    = floor($choice);
         //$config['use_page_numbers']  = TRUE;
        //config for bootstrap pagination class integration
        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = false;
        $config['last_link']        = false;
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '&laquo';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '&raquo';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);
    

        $data['seminar'] = $this->m_seminar->getDataSeminar('seminar', array('status_seminar' => 1, 'DATE_FORMAT(jadwal_seminar, "%Y-%m-%d %H:%i:%s") >=' => $today), 'jadwal_seminar asc', $search, $config["per_page"], $data['page']);
        //echo $this->db->last_query();
        //echo '<pre>',print_r($config);
        //echo '<pre>',print_r($data);die();
        $data['pagination'] = $this->pagination->create_links();

	   	$this->frview('v_allSeminar',$data);
    }

    public function submit_order(){

    	$id_seminar		= $this->input->post('id_seminar');
    	$id_mahasiswa	= $this->input->post('id_mhs');

    	$id_ticket = $this->m_seminar->getDataKey('ticket_manual', array('id_seminar' => $id_seminar, 'consume' => 0), 'id_ticket asc', 1);

    	if($id_ticket){
    		$data = array(
    				'id_seminar' 	=> $id_seminar,
    				'id_mahasiswa'	=> $id_mahasiswa,
    				'id_ticket' 	=> $id_ticket[0]['id_ticket'],
    				'create_date'	=> date("Y-m-d H:i:s")

    			);

	    	if($this->m_seminar->insertData("order", $data)){

	    		$this->m_seminar->updateData("ticket_manual", array("consume" => 1), array('id_ticket' => $id_ticket[0]['id_ticket']));
	    		echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
	    	}
	    	
    	
    	}else{

    		echo json_encode(array('status' => 'error'));	

    	}
    	
    }
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */