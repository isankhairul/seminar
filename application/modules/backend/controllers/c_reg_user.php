<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reg_user extends MY_Controller {
    protected $sessionData; 
    function __construct(){
	parent::__construct();
	$this->load->model('m_register_user');
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
        $data   = array();
        $config['base_url'] 	= site_url('backend/c_reg_user/index');
        $config['total_rows'] 	= $this->db->count_all('user');
        $config['per_page'] 	= "2";
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
        $data['listRegisterUser'] 	= $this->m_register_user->list_dataRegisterUser($config["per_page"],$data['page']);
        
	$data['pagination'] = $this->pagination->create_links();
        $this->doview('list_RegUser', $data);
    }
            
    public function v_registerUser($id = ''){
        $data               	= array();
        $data['getDetail']  	= array();
		$data['type_form']	= 'add' ;
        if(!empty($id)){
            $detailRegisterUser	= $this->m_register_user->detailRegisterUser($id);
            $data['getDetail']  = $detailRegisterUser ;
	    $data['type_form']	= 'edit' ;
        }
        $this->doview('v_register_user', $data);
    
    }
    public function register_user(){
	$data               = array();
	$post = $this->input->post();
	if(!isset($post['id_user'])){
	    $this->form_validation->set_rules('nama', 'Name', 'required');
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	    $this->form_validation->set_rules('kategori_user', 'Category', 'required');
	    $this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required|matches[Re_password]');
	    $this->form_validation->set_rules('Re_password', 'Retype Password', 'required');
	}else{
	    $this->form_validation->set_rules('nama', 'Name', 'required');
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	    $this->form_validation->set_rules('kategori_user', 'Category', 'required');
	    $this->form_validation->set_rules('username', 'Username', 'required');
	}
        
	
	if ($this->form_validation->run() == FALSE)
	{
	    if(!isset($post['id_user'])){
		$this->doview('v_register_user', $data);
	    }
	}
	else
	{
	    $nama = $post['nama'];
	    $email = $post['email'];	
	    $telepon = $post['telepon'];
	    $kategoriuser = $post['kategori_user'];
	    $create_date = date('Y-m-d H:i:s');
	    $username = $post['username'];
	    $pass = encryptPass($post['password']);
	    
	    if(isset($post['id_user']))
	    {
		$checkUsername 		= $this->m_register_user->check_username($username);
		if($checkUsername){
		    $this->session->set_flashdata('infoCheckUsername', 'Maaf username sudah di gunakan');
		    redirect('register_user');
		    exit;
		}else{
		    $data = array(
			'nama_user'		=> $nama,
			'email_user' 	=> $email,
			'telp_user' 	=> $telepon,
			'kategori_user' 	=> $kategoriuser,
			'update_date' 	=> date('Y-m-d H:i:s'),
			'username_user' 	=> $username		
		    );
		}
		
	    }else{
		$checkUsername 		= $this->m_register_user->check_username($username);
		if($checkUsername){
		    $this->session->set_flashdata('infoCheckUsername', 'Maaf username sudah di gunakan');
		    redirect('register_user');
		    exit;
		}else{
		    $data = array(
			'nama_user'		=> $nama,
			'email_user' 	=> $email,
			'telp_user' 	=> $telepon,
			'kategori_user' 	=> $kategoriuser,
			'create_date' 	=> $create_date,
			'username_user' 	=> $username,
			'password' 		=> $pass		
		    );	
		}
			
	    }
	    if(isset($post['id_user'])){
		$key = array('id_user' => $post['id_user']) ;
		$res = $this->m_register_user->UpdateRegisterUser('user',$data, $key);
	    }else{
		$res = $this->m_register_user->InsertRegisterUser('user',$data);
	    }
	    
	    if ($res){
		if(isset($post['id_user'])){
			$this->session->set_flashdata('infoRegisterUser', 'Data Berhasil Di Ubah');
		}else{
			$this->session->set_flashdata('infoRegisterUser', 'Data Berhasil Di Tambah');
		}
		redirect('register_user');			
	    } else{
		echo "<h2>INsert Data Gagal</h2>";            
	    }
	}
	
    }
    public function do_delete($id = ''){
	$id = $this->input->post('id');
        $where = array ('id_user' => $id);
	
	$delete_user = $this->m_register_user->deleteData('user',$where);
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
