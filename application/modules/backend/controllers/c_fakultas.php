<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_fakultas extends MY_Controller {
    protected $sessionData; 
    function __construct(){
	parent::__construct();
	$this->load->model(array('m_register_user','m_fakultas'));
	$this->sessionData = $this->session->userdata('CMS_logged_in');
	if(!$this->sessionData){
	//    if($this->uri->segment(1) == 'dashboard'){ 
	//	$this->result = true;
	//    }
	//    if($this->result){
	//	redirect('dashboard');
	//    }else{
	//	redirect('backend/c_login');
	//    }
	    redirect('backend/c_login');
	}
    }
	
    public function index(){
        //pagination settings
        $data['listFakultas']   = array();
        $config['base_url'] 	= site_url('backend/c_fakultas/index');
        $config['total_rows'] 	= $this->db->count_all('fakultas');
        $config['per_page'] 	= "50";
        $config["uri_segment"] 	= 4;
        $choice 		= $config["total_rows"] / $config["per_page"];
        $config["num_links"] 	= floor($choice);
        
        //config for bootstrap pagination class integration
        $config['full_tag_open']	= '<ul class="pagination">';
        $config['full_tag_close']	= '</ul>';
        $config['first_link'] 		= false;
        $config['last_link'] 		= false;
        $config['first_tag_open'] 	= '<li>';
        $config['first_tag_close'] 	= '</li>';
        $config['prev_link'] 		= '&laquo';
        $config['prev_tag_open'] 	= '<li class="prev">';
        $config['prev_tag_close'] 	= '</li>';
        $config['next_link'] 		= '&raquo';
        $config['next_tag_open'] 	= '<li>';
        $config['next_tag_close'] 	= '</li>';
        $config['last_tag_open'] 	= '<li>';
        $config['last_tag_close'] 	= '</li>';
        $config['cur_tag_open'] 	= '<li class="active"><a href="#">';
        $config['cur_tag_close'] 	= '</a></li>';
        $config['num_tag_open'] 	= '<li>';
        $config['num_tag_close'] 	= '</li>';
        
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        //call the model function to get the department data
		$data['start'] 			= $this->uri->segment(4, 0);
        $data['listFakultas'] 	= $this->m_fakultas->list_dataFakultas($config["per_page"],$data['page']);
        
		$data['pagination'] = $this->pagination->create_links();
        $this->doview('list_fakultas', $data);
    }
            
    public function v_fakultas($id = ''){
        $data               	= array();
        $data['getDetail']  	= array();
		$data['type_form']	= 'add' ;
        if(!empty($id)){
            $detail	= $this->m_fakultas->detailFakultas($id);
            $data['getDetail']  = $detail ;
	    $data['type_form']	= 'edit' ;
        }
        $this->doview('v_fakultas', $data);
    
    }
    public function submit_fakultas(){
	$data   = array();
	$post 	= $this->input->post();
	$id 	= $post['id'];
	if(!isset($id)){
	    $this->form_validation->set_rules('nama_fakultas', 'Name', 'required');
	}else{
	    $this->form_validation->set_rules('nama_fakultas', 'Name', 'required');
	}
        
	
	if ($this->form_validation->run() == FALSE)
	{
	    if(!isset($id)){
			$this->doview('v_fakultas', $data);
	    }
	}
	else
	{
	    $nama_fakultas		= trim(strtoupper($post['nama_fakultas']));
	    $status_fakultas 	= $post['status_fakultas'];
	    
	    if(isset($id))
	    {
	    	$whereKondisi		= ($status_fakultas == 1) ? 1 : 2 ;
			$checkFakultas 		= $this->m_fakultas->check_fakultas($nama_fakultas, $whereKondisi);
			if($checkFakultas){
			    $this->session->set_flashdata('infoCheckFakultas', 'Maaf nama fakultas sudah di gunakan');
			    redirect('fakultas');
			    exit;
			}else{
			    $data = array(
			    'nama_fakultas'		=> $nama_fakultas,
			    'status_fakultas'	=> $status_fakultas,
				'date_update' 		=> date('Y-m-d H:i:s')	
			    );
			}		
	    }else{
			$checkFakultas 		= $this->m_fakultas->check_fakultas($nama_fakultas);
			if($checkFakultas){
			    $this->session->set_flashdata('infoCheckFakultas', 'Maaf nama fakultas sudah di gunakan');
			    redirect('fakultas');
			    exit;
			}else{
			    $data = array(
				'nama_fakultas'	=> $nama_fakultas,
				'date_create' 	=> date('Y-m-d H:i:s')
			    );	
			}			
	    }
	    if(isset($id)){
			$key = array('id_fakultas' => $id) ;
			$res = $this->m_fakultas->UpdateFakultas('fakultas',$data, $key);
	    }else{
			$res = $this->m_fakultas->InsertFakultas('fakultas',$data);
	    }
	    
	    if ($res){
			if(isset($id)){
				$this->session->set_flashdata('infoFakultas', 'Data Berhasil Di Ubah');
			}else{
				$this->session->set_flashdata('infoFakultas', 'Data Berhasil Di Tambah');
			}
			redirect('fakultas');			
	    } else{
			echo "<h2>INsert Data Gagal</h2>";            
	    }
	}
	
    }
    public function do_delete($id = ''){
	$id 	= $this->input->post('id');
	$data 	= array('status_fakultas'	=> 2);	
    $where 	= array ('id_fakultas' 		=> $id);
	
	$delete_user = $this->m_fakultas->UpdateFakultas('fakultas',$data, $where);
        if($delete_user){
            $alert = 'Data Berhasil Di Hapus';		
            $returnVal = 'success';
        }else{
            $alert = 'Gagal , silahkan hubungi IT';		
            $returnVal = '';
        }
        
        echo json_encode((object) array('alert'=>$alert,'returnVal'=>$returnVal));
            
    }
}
?>
