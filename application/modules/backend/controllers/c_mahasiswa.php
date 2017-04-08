<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_mahasiswa extends MY_Controller {
    protected $sessionData; 
    function __construct(){
	parent::__construct();
	$this->load->model(array('m_mahasiswa'));
	$this->load->library('file_excel');
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
		$this->arr_dimension = array();
        $this->arr_dimension['display']['width'] = 100;
        $this->arr_dimension['display']['height'] = 150;
    }
	
    public function index(){
        //pagination settings
        /*$search 				= $this->input->get('search_mahasiswa');*/
        //echo $search;die();
        $session_searchMahasiswa = $this->session->userdata('pencarian_mahasiswa');
        if(isset($session_searchMahasiswa)){
        	$this->session->unset_userdata('pencarian_mahasiswa');
        }
        $data['listMahasiswa']   = array();
       /* if(isset($search)){
        	$config['base_url'] 	= site_url('backend/c_mahasiswa/index/search_mahasiswa='.$search);	
        }else{
        	$config['base_url'] 	= site_url('backend/c_mahasiswa/index');	
        }*/
        //$config['base_url'] 	= site_url('backend/c_mahasiswa/index');	

        // get search string
        //$search = ($this->input->post("search_mahasiswa"))? $this->input->post("search_mahasiswa") : "NIL";

        //$search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("backend/c_mahasiswa/index/");



        $config['total_rows'] 	= $this->m_mahasiswa->jumlah_dataMahasiswa($search);
        //echo $config['total_rows'];die();
        $config['per_page'] 	= "20";
        $config["uri_segment"] 	= 4;
        //$choice 				= $config["total_rows"] / $config["per_page"];
        //$config["num_links"] 	= floor($choice);
        $config["num_links"] 	= 10;
        
        //config for bootstrap pagination class integration
        $config['full_tag_open']	= '<ul class="pagination">';
        $config['full_tag_close']	= '</ul>';
        $config['first_link'] 		= FALSE;
        $config['last_link'] 		= FALSE;
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
        
        //call the model function to get the Mahasiswa data
		$data['start'] 			= $this->uri->segment(4, 0);
		
        $data['listMahasiswa'] 	= $this->m_mahasiswa->list_dataMahasiswa($config["per_page"],$data['page'],$search);
        //echo $this->db->last_query();die();
		$data['pagination'] = $this->pagination->create_links();
		//echo '<pre>',print_r($data);die();
        $this->doview('list_mahasiswa_b', $data);
    }

function cari()
{
	$page 	= $this->uri->segment(4);
	//echo $page;die();
    $batas 	= 20;
	if(!$page):
	$offset = 0;
	else:
	$offset = $page;
	endif;

	$search_mahasiswa = "";
	$postkata = $this->input->post('search_mahasiswa');
	if(!empty($postkata))
	{
		$search_mahasiswa = $this->input->post('search_mahasiswa');
		$this->session->set_userdata('pencarian_mahasiswa', $search_mahasiswa);
	}
	else
	{
		$search_mahasiswa = $this->session->userdata('pencarian_mahasiswa');
	}
	//$data['listMahasiswa'] = $this->search_model->cari_dosen($batas,$offset,$data['nama']);
	$data['listMahasiswa'] = $this->m_mahasiswa->list_dataMahasiswa($batas,$offset,$search_mahasiswa);
	//$tot_hal = $this->search_model->tot_hal('ja_mst_dosen','nama_dosen',$data['nama']);

	$config['base_url'] = base_url() . 'backend/c_mahasiswa/cari/';
	$config['total_rows'] = $this->m_mahasiswa->jumlah_dataMahasiswa($search_mahasiswa);
	$config['per_page'] = $batas;
	$config['uri_segment'] = 4;


	//config for bootstrap pagination class integration
    $config['full_tag_open']	= '<ul class="pagination">';
    $config['full_tag_close']	= '</ul>';
    $config['first_link'] 		= FALSE;
    $config['last_link'] 		= FALSE;
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
    
    //call the model function to get the Mahasiswa data
	$data['start'] 			= $this->uri->segment(4, 0);
		
	$data["pagination"] =$this->pagination->create_links();
	$this->doview('list_mahasiswa_b', $data);
       
    //$this->load->view('search/hasil',$data);
}

            
public function v_mahasiswa($id = ''){
        $data               	= array();
        $data['getDetail']  	= array();
		$data['type_form']	= 'add' ;
        if(!empty($id)){
            $detail	= $this->m_mahasiswa->getDetailMahasiswa($id);
            $data['getDetail']  = $detail ;
	    	$data['type_form']	= 'edit' ;
        }
        //echo '<pre>',print_r($data);die();
        $this->doview('v_mahasiswa_b', $data);
    
    }
public function edit_mahasiswa(){
    $post 	= $this->input->post();
	$data   = array();
	$id 	= $post['id'];
	
	$dataUpdate = array(
		'nama_depan' 		=> $post['nama_mhs'],
		'email_mahasiswa' 	=> $post['emailmhs'],
		'alamat_mahasiswa' 	=> $post['alamat_mhs'],
		'telp_mahasiswa' 	=> $post['telp_mhs']
		
	);
	if(!empty($_FILES['photo_mhs']['name'])){
		$filename  = $this->upload_image($_FILES['photo_mhs']);
		$file_name = base_url('/assets/uploads/mahasiswa/display/100/150/'.$filename);
		$dataUpdate = array_merge($dataUpdate, array('photo_mahasiswa' => $file_name));
	}
	$updateMhs = $this->m_mahasiswa->UpdateData('mahasiswa',$dataUpdate,array('id_mahasiswa' => $id));
    if ($updateMhs){
		$this->session->set_flashdata('infoUpdateMahasiswa', 'Data Mahasiswa Berhasil Di Update');
		redirect('mahasiswa');			
    } else{
		$this->session->set_flashdata('infoUpdateMahasiswa', 'Data Mahasiswa Gagal Di Update');
		redirect('mahasiswa');         
    }
}
    public function do_delete($id = ''){
	$id 	= $this->input->post('id');
	$data 	= array('status_mahasiswa'	=> 2);	
    $where 	= array ('id_mahasiswa' 		=> $id);
	
	$delete_mahasiswa = $this->m_mahasiswa->UpdateData('mahasiswa',$data, $where);
        if($delete_mahasiswa){
            $alert = 'Data Berhasil Di Hapus';		
            $returnVal = 'success';
        }else{
            $alert = 'Gagal , silahkan hubungi IT';		
            $returnVal = '';
        }
        
        echo json_encode((object) array('alert'=>$alert,'returnVal'=>$returnVal));
            
    }

    public function upg_mahasiswa(){
        //echo '<pre>',print_r($_FILES),'</pre>';die();
        $folder_upload      = './assets/uploads/mahasiswa/';
        $check_file_exist   = $folder_upload.$_FILES['file']['name'];
        $url_path           = base_url().'assets/uploads/mahasiswa/';
        
        //Create Folder Jika tidak ada
        if (!is_dir($folder_upload)) {
            @mkdir($folder_upload, 0775);
        }
        
        //Check file jika pernah di upload 
        if(file_exists($check_file_exist)){
            $status     = "failed";
            $returnVal  = $_FILES['file']['name'].' '.'Sudah pernah di upload' ;
            $terdapatKodeAgentInsert = $tidakterdapatKodeAgent = 0;
        }else{
            
            $config['upload_path']      = $folder_upload;
            $config['allowed_types']    = 'xls|xlsx';
            $config['max_size']         = '50000';
            $this->load->library('upload', $config);
            //$this->upload->initialize($config);
            
            if(! $this->upload->do_upload('file')){
                $data['error'] = $this->upload->display_errors();
                die('Upload error : '.$data['error']); 
            }else{
                
                $data_file = array('upload_data' => $this->upload->data());
                //echo '<pre>',print_r($data_file),'</pre>';die();
                //exit;
            }
            //Insert to tbl_fileExcel_history
             $dataInsert     = array(
                'fileName'      => $data_file['upload_data']['full_path'],
                'file_type'     => $data_file['upload_data']['file_type'],
                'file_path'     => $data_file['upload_data']['file_path'],
                'full_path'     => $data_file['upload_data']['full_path'],
                'file_size'     => $data_file['upload_data']['file_size'],
                'date_create'   => date('Y-m-d H:i:s')
            ) ;
            
            //$insert     = $this->general_model->insertData('tbl_fileExcel_history',$dataInsert);
            
            $folder_upload_excel  = $data_file['upload_data']['full_path'];
            
            
            try {
                $objPHPExcel = $this->file_excel->load($folder_upload_excel);
            }catch(Exception $e) {
                die('Error loading file "'.pathinfo($folder_upload_excel,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
            
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

            
            $arrayCount = count($allDataInSheet); // Here get total count of row in that Excel sheet
            $no = 1 ;
            
            //$terdapatKodeAgentInsert = $tidakterdapatKodeAgent = 0;
            $terdapatNIMInsert = $tidakterdapatNIM = 0;
            
            //$agentKodes = array();
            $NIMS = array();
            for($i=2;$i<$arrayCount;$i++){
                //$agentKodes[] = trim($allDataInSheet[$i]["B"]);
                $NIMS[] = trim($allDataInSheet[$i]["B"]);
            }
            //echo '<pre>',print_r($NIMS);die();
            $rows = $this->db
                ->select('nim_mahasiswa')
                ->where_in('nim_mahasiswa',$NIMS)
                ->get('mahasiswa')->result_array();
            //$agentKodes = array();
            $NIMS = array();
            foreach($rows as $row){
                //$agentKodes[] = $row['kode_agent'];
                $NIMS[] = $row['nim_mahasiswa'];
            }
            
            
            $rows = array();
            for($i=2;$i<$arrayCount;$i++){
                $nama  		= trim($allDataInSheet[$i]["H"]);
                //echo trim($allDataInSheet[$i]["E"]);die();
                switch (trim($allDataInSheet[$i]["E"])) {
                	case "81":
                		$id_jur_fakultas  = 1 ;
                	break;
                	case "83":
                		$id_jur_fakultas  = 2;
                	break;
                }
                $id_jur_fakultas = $id_jur_fakultas;
                $nim_mahasiswa 	= trim($allDataInSheet[$i]["B"]);
                $email 			= trim($allDataInSheet[$i]["I"]);
                $alamat 		= trim($allDataInSheet[$i]["N"]);
                $telp 			= trim($allDataInSheet[$i]["O"]);
                $tipe_mhs 		= trim($allDataInSheet[$i]["K"]);
                $thn_masuk 		= trim($allDataInSheet[$i]["C"]);
                
                switch (trim($allDataInSheet[$i]["D"])) {
                	case "1":
                		$smt_mhs 	= 'ganjil';
                	break;
                	case "2":
                		$smt_mhs  	= 'genap';
                	break;
                }
                $smt_mhs = $smt_mhs ;
                $pass 		= encryptPass(trim($allDataInSheet[$i]["L"]));
                                
                if(!empty($nim_mahasiswa) && array_search($nim_mahasiswa,$NIMS) === FALSE){
                    $rows[]   = array(
                            'nim_mahasiswa' 	=> $nim_mahasiswa,
                            'nama_depan'    	=> $nama,
                            'email_mahasiswa'	=> $email,
                            'alamat_mahasiswa' 	=> $alamat,
                            'telp_mahasiswa'	=> $telp,
                            'tipe_mahasiswa'	=> $tipe_mhs,
                            'tahun_masuk'       => $thn_masuk,                        
                            'semester_mahasiswa'=> $smt_mhs,                        
                            'password_mahasiswa'=> $pass,                        
                            'id_jurusan_fak'	=> $id_jur_fakultas,                        
                            'status_mahasiswa'	=> 1,                        
                            'date_create'		=> date('Y-m-d H:i:s')                         
                        );
                    ++$terdapatNIMInsert;
                }else{
                    ++$tidakterdapatNIM;
                }
                $no++;                
            }
            //echo '<pre>',print_r($rows);die();
            if(!empty($rows)){
                $insert = $this->db->insert_batch('mahasiswa',$rows);
                if($insert){
                    $status     = "success" ;
                    $returnVal  = "Berhasil Ditambahkan" ;
                }
            }
            $status     = "pernah" ;
            $returnVal  = "Sudah Pernah Ditambahkan" ;
            unset($rows);
            
            
        }
        echo json_encode(array(
                'Insert'        => $terdapatNIMInsert,
                'Non_Insert'    => $tidakterdapatNIM,
                'status'         => $status,
                'returnVal'     => $returnVal
                
        ));
        
    }

    public function change_password_mhs(){
    	$id = $this->input->post('id');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[retype_password]');
        $this->form_validation->set_rules('retype_password', 'Retype Password', 'required');
        $data               	= array();
        $data['getDetail']  	= array();
		$data['type_form']	= 'add' ;
        if(!empty($id)){
            $detail	= $this->m_mahasiswa->getDetailMahasiswa($id);
            $data['getDetail']  = $detail ;
	    	$data['type_form']	= 'edit' ;
        }

        if ($this->form_validation->run() == FALSE){
            $this->doview('v_mahasiswa_b',$data);
        }else{
        	$post = $this->input->post();
        	$updatePassMhs = $this->m_mahasiswa->UpdateData('mahasiswa',array('password_mahasiswa' => encryptPass($post['password'])), array('id_mahasiswa' => $id));
        	if ($updatePassMhs){
				$this->session->set_flashdata('infoChangePasswordMhs', 'Data Password Berhasil Di Update');
				redirect('mahasiswa');			
		    } else{
				$this->session->set_flashdata('infoChangePasswordMhs', 'Data Password Gagal Di Update');     
				redirect('mahasiswa');	  
		    }
        }
    }
    private function upload_image($image) {
        $data                   = array();
        $config['upload_path'] = FCPATH.'assets/uploads/mahasiswa';
        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path'], 0775);
        }
        
        $info = pathinfo($image['name']);
        
        $url_title = url_title($info['filename'], '_', TRUE);
        $file_name = generateRandomString(10) . '.' . $info['extension'];
        $config['file_name'] = $file_name;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        //$this->upload->initialize($config);
        $upload = $this->upload->do_upload('photo_mhs');
        
        if (!$upload) {
            $invalid = $this->upload->display_errors();
            $this->session->set_flashdata('infoErrorsPhoto', $invalid);
            $this->frview('v_register_mhs',$data);
        } else {
            /* First size */
            $configSize1['image_library'] = 'gd2';
            $configSize1['source_image'] = FCPATH.'assets/uploads/mahasiswa/'.$file_name;
            $configSize1['create_thumb'] = false;
            $configSize1['maintain_ratio'] = true;
            $configSize1['width'] = $this->arr_dimension['display']['width'];
            $configSize1['height'] = $this->arr_dimension['display']['height'];

            $path1['display'] = FCPATH.'assets/uploads/mahasiswa/display';
            if (!is_dir($path1['display'])) {
                mkdir($path1['display'], 0775, true);
            }
            $path2['100'] = FCPATH.'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'];
            if (!is_dir($path2['100'])) {
                mkdir($path2['100'], 0775, true);
            }
            $path3['150'] = FCPATH.'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'];
            if (!is_dir($path3['150'])) {
                mkdir($path3['150'], 0775, true);
            }

            $configSize1['new_image'] = FCPATH.'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'] . '/' . $file_name;
            $this->image_lib->initialize($configSize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return $file_name; 
        }
        
    }
}
?>
