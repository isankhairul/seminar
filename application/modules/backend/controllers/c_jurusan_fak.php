<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jurusan_fak extends MY_Controller {
    protected $sessionData; 
    function __construct(){
	parent::__construct();
	$this->load->model(array('m_jurusan_fak'));
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
        $config['base_url'] 	= site_url('backend/c_jurusan_fak/index');
        $config['total_rows'] 	= $this->db->count_all('jurusan_fakultas');
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
        $data['listJurusanFakultas'] 	= $this->m_jurusan_fak->list_dataJurusanFakultas($config["per_page"],$data['page']);
        
		$data['pagination'] = $this->pagination->create_links();
        $this->doview('list_jurusanfakultas', $data);
    }
            
    public function v_jurusan_fakultas($id = ''){
        $data               	= array();
        $data['getDetail']  	= array();
        $data['listFakultas'] 	= $this->m_jurusan_fak->getAllDataFakultas();
		$data['type_form']		= 'add' ;
        if(!empty($id)){
            $detail	= $this->m_jurusan_fak->detailJurusanFakultas($id);
            $data['getDetail']  = $detail ;
	    $data['type_form']	= 'edit' ;
        }
        $this->doview('v_jurusan_fak', $data);
    
    }
    public function submit_jurusan_fakultas(){
	$data   = array();
	$post 	= $this->input->post();
	$id 	= $post['id'];
	if(!isset($id)){
	    $this->form_validation->set_rules('nama_jurusan_fak', 'Nama Jurusan', 'required');
	    $this->form_validation->set_rules('nama_fakultas', 'Name', 'required');
	}else{
		$this->form_validation->set_rules('nama_jurusan_fak', 'Nama Jurusan', 'required');
	    $this->form_validation->set_rules('nama_fakultas', 'Name', 'required');
	}
        
	
	if ($this->form_validation->run() == FALSE)
	{
	    if(!isset($id)){
			$this->doview('v_jurusan_fak', $data);
	    }
	}
	else
	{
	    $nama_jurusan_fak		= trim(strtoupper($post['nama_jurusan_fak']));
	    $id_fakultas			= trim(strtoupper($post['nama_fakultas']));
	    $status_jurusan_fakultas= $post['status_jurusan_fakultas'];
	    
	    if(isset($id))
	    {
	    	$whereKondisi			= ($status_jurusan_fakultas == 1) ? 1 : 2 ;
			$checkJurFakultas 		= $this->m_jurusan_fak->check_jurusan_fakultas($nama_jurusan_fak, $whereKondisi);
			if($checkJurFakultas){
			    $this->session->set_flashdata('infoCheckJurusanFakultas', 'Maaf nama jurusan fakultas sudah di gunakan');
			    redirect('jurusan-fak');
			    exit;
			}else{
			    $data = array(
			    'nama_jurusan'		=> $nama_jurusan_fak,
			    'id_fakultas'		=> $id_fakultas,
			    'status_jurusan'	=> $status_jurusan_fakultas,
				'date_update' 		=> date('Y-m-d H:i:s')	
			    );
			}		
	    }else{
			$checkJurFakultas 	= $this->m_jurusan_fak->check_jurusan_fakultas($nama_jurusan_fak);
			if($checkJurFakultas){
			    $this->session->set_flashdata('infoCheckJurusanFakultas', 'Maaf nama jurusan fakultas sudah di gunakan');
			    redirect('jurusan-fak');
			    exit;
			}else{
			    $data = array(
				'nama_jurusan'		=> $nama_jurusan_fak,
			    'id_fakultas'		=> $id_fakultas,
				'date_create' 	=> date('Y-m-d H:i:s')
			    );	
			}			
	    }
	    if(isset($id)){
			$key = array('id_jurusan_fakultas' => $id) ;
			$res = $this->m_jurusan_fak->UpdateJurusanFakultas('jurusan_fakultas',$data, $key);
	    }else{
			$res = $this->m_jurusan_fak->InsertJurusanFakultas('jurusan_fakultas',$data);
	    }
	    
	    if ($res){
			if(isset($id)){
				$this->session->set_flashdata('infoJurusanFakultas', 'Data Berhasil Di Ubah');
			}else{
				$this->session->set_flashdata('infoJurusanFakultas', 'Data Berhasil Di Tambah');
			}
			redirect('jurusan-fak');			
	    } else{
			echo "<h2>INsert Data Gagal</h2>";            
	    }
	}
	
    }
    public function do_delete($id = ''){
	$id 	= $this->input->post('id');
	$data 	= array('status_jurusan'	=> 2);	
    $where 	= array ('id_jurusan_fakultas' 		=> $id);
	
	$delete_jurusan_fakultas = $this->m_jurusan_fak->UpdateJurusanFakultas('jurusan_fakultas',$data, $where);
        if($delete_jurusan_fakultas){
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
