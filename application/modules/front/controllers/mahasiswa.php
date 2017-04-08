<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_register'));

        $this->arr_dimension = array();
        $this->arr_dimension['display']['width'] = 100;
        $this->arr_dimension['display']['height'] = 150;
    }

    public function index() {
        $data['fakultas'] = array();
        $data['fakultas'] = $this->m_register->getDataKey('fakultas', array('status_fakultas' => 1));
        $data['tab_active'] = 'login';
        $this->frview('v_register_mhs', $data);
    }

    function submit_register_mhs() {
        $data['fakultas'] = array();
        $data['fakultas'] = $this->m_register->getDataKey('fakultas', array('status_fakultas' => 1));
        $data['tab_active'] = 'register';

        $this->form_validation->set_rules('namaDpn', 'First Name', 'required');
        $this->form_validation->set_rules('NIMmhs', 'NIM', 'required');
        $this->form_validation->set_rules('emailmhs', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('NIMmhs', 'NIM', 'required');
        $this->form_validation->set_rules('thn_masuk', 'Year', 'required');
        $this->form_validation->set_rules('status_smt', 'Stat', 'required');
        $this->form_validation->set_rules('jurusan_fakultas', 'Fakultas Jurusan', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Retype Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->frview('v_register_mhs', $data);
        } else {
            $post = $this->input->post();
            //check to NIM valid ; 
            $checkNIM = $this->m_register->checkNIM('mahasiswa', array('nim_mahasiswa' => $post['NIMmhs']));
            if ($checkNIM) {
                $this->session->set_flashdata('infoNIMinvalid', 'Maaf NIM tidak valid / sudah terpakai');
                $this->frview('v_register_mhs', $data);
            } else {
                //insert to database ;                    
                $namaDpn = trim($post['namaDpn']);
                $namaBlkg = trim($post['namaBlkg']);
                $NIMmhs = trim($post['NIMmhs']);
                $tipe_mahasiswa = trim($post['tipe_mahasiswa']);
                $emailmhs = trim($post['emailmhs']);
                $alamat_mhs = trim($post['alamat_mhs']);
                $telp_mhs = trim($post['telp_mhs']);
                $thn_masuk = trim($post['thn_masuk']);
                $status_smt = trim($post['status_smt']);
                $jurusan_fakultas = trim($post['jurusan_fakultas']);
                $password = trim(encryptPass($post['password']));
                $file_name = base_url('/assets/uploads/mahasiswa/display/100/150/no-photo.png');
                if (!empty($_FILES['photo_mhs']['name'])) {
                    $filename = $this->upload_image($_FILES['photo_mhs']);
                    $file_name = base_url('/assets/uploads/mahasiswa/display/100/150/' . $filename);
                }

                $dataInsert = array(
                    'nama_depan' => $namaDpn,
                    'nama_belakang' => $namaBlkg,
                    'nim_mahasiswa' => $NIMmhs,
                    'tipe_mahasiswa' => $tipe_mahasiswa,
                    'email_mahasiswa' => $emailmhs,
                    'alamat_mahasiswa' => $alamat_mhs,
                    'telp_mahasiswa' => $telp_mhs,
                    'tahun_masuk' => $thn_masuk,
                    'semester_mahasiswa' => $status_smt,
                    'password_mahasiswa' => $password,
                    'id_jurusan_fak' => $jurusan_fakultas,
                    'photo_mahasiswa' => $file_name,
                    'date_create' => date('Y-m-d')
                );

                //insert to table mahasiswa ;
                $insert_mhs = $this->m_register->insertData('mahasiswa', $dataInsert);
                if ($insert_mhs) {
                    $last_id = $this->db->insert_id();
                    $getLastIdInsertMhs = $this->m_register->getDetailMahasiswa($last_id);
                    //echo '<pre>',print_r($getLastIdInsertMhs);die();
                    if ($getLastIdInsertMhs) {
                        //buat session untuk masuk mahasiswa
                        $sessionMHS = array(
                            'id_mahasiswa' => $getLastIdInsertMhs['id_mahasiswa'],
                            'nama_depan' => $getLastIdInsertMhs['nama_depan'],
                            'nama_belakang' => $getLastIdInsertMhs['nama_belakang'],
                            'nim_mahasiswa' => $getLastIdInsertMhs['nim_mahasiswa'],
                            'email_mahasiswa' => $getLastIdInsertMhs['email_mahasiswa'],
                            'alamat_mahasiswa' => $getLastIdInsertMhs['alamat_mahasiswa'],
                            'telp_mahasiswa' => $getLastIdInsertMhs['telp_mahasiswa'],
                            'tahun_masuk' => $getLastIdInsertMhs['tahun_masuk'],
                            'semester_mahasiswa' => $getLastIdInsertMhs['semester_mahasiswa'],
                            'photo_mahasiswa' => $getLastIdInsertMhs['photo_mahasiswa'],
                            'nama_fakultas' => $getLastIdInsertMhs['nama_fakultas'],
                            'nama_jurusan' => $getLastIdInsertMhs['nama_jurusan']
                        );
                        $this->session->set_userdata('CMS_mahasiswa', $sessionMHS);
                        redirect('mahasiswa-dashboard');
                    } else {
                        $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
                        $this->frview('v_register_mhs', $data);
                    }
                } else {
                    die('gagal');
                    $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
                    $this->frview('v_register_mhs', $data);
                }
            }
        }
    }

    function get_jurusan() {
        $id_fakultas = $this->input->post('id_fakultas');

        $get_jurusan = $this->m_register->getDataKey('jurusan_fakultas', array('id_fakultas' => $id_fakultas));
        echo json_encode((object) array('jurusan_fakultas' => $get_jurusan));
    }

    public function mahasiswa_login() {
        $data['fakultas'] = array();
        $data['fakultas'] = $this->m_register->getDataKey('fakultas', array('status_fakultas' => 1));
        $data['tab_active'] = 'login';
        $this->form_validation->set_rules('nim_login', 'NIM', 'required|callback_check_nim');
        $this->form_validation->set_rules('password_login', 'Password', 'required|callback_check_password');
        if ($this->form_validation->run($this) == FALSE) {
            //$data['error'] = $this->form_validation->error_array();
            $this->frview('v_register_mhs', $data);
        } else {
            $post = $this->input->post();
            $nim_mahasiswa = $post['nim_login'];
            $password = $post['password_login'];
            $mahasiswa_login = $this->m_register->do_login_mahasiswa($nim_mahasiswa, $password);
            if ($mahasiswa_login) {
                //buat session untuk masuk mahasiswa
                $sessionMHS = array(
                    'id_mahasiswa' => $mahasiswa_login->id_mahasiswa,
                    'nama_depan' => $mahasiswa_login->nama_depan,
                    'nama_belakang' => $mahasiswa_login->nama_belakang,
                    'nim_mahasiswa' => $mahasiswa_login->nim_mahasiswa,
                    'email_mahasiswa' => $mahasiswa_login->email_mahasiswa,
                    'alamat_mahasiswa' => $mahasiswa_login->alamat_mahasiswa,
                    'telp_mahasiswa' => $mahasiswa_login->telp_mahasiswa,
                    'tahun_masuk' => $mahasiswa_login->tahun_masuk,
                    'semester_mahasiswa' => $mahasiswa_login->semester_mahasiswa,
                    'photo_mahasiswa' => $mahasiswa_login->photo_mahasiswa,
                    'nama_fakultas' => $mahasiswa_login->nama_fakultas,
                    'nama_jurusan' => $mahasiswa_login->nama_jurusan,
                    'tipe_mahasiswa' => $mahasiswa_login->tipe_mahasiswa
                );
                $this->session->set_userdata('CMS_mahasiswa', $sessionMHS);
                redirect('mahasiswa-dashboard');
            } else {
                $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
                $this->frview('v_register_mhs', $data);
            }
        }
    }

    function check_nim($str) {
        $this->form_validation->set_message('check_nim', 'NIM is invalid.');
        if ($this->m_register->check_nim($str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_password($str) {
        $this->form_validation->set_message('check_password', 'Password is invalid.');
        $nim = $this->input->post('nim_login');
        if (($this->m_register->check_nim($nim)) && ($this->m_register->check_password($nim, $str))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('CMS_mahasiswa');
        redirect(base_url());
    }

    private function upload_image($image) {
        $data = array();
        $config['upload_path'] = FCPATH . 'assets/uploads/mahasiswa';
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
            $this->frview('v_register_mhs', $data);
        } else {
            /* First size */
            $configSize1['image_library'] = 'gd2';
            $configSize1['source_image'] = FCPATH . 'assets/uploads/mahasiswa/' . $file_name;
            $configSize1['create_thumb'] = false;
            $configSize1['maintain_ratio'] = true;
            $configSize1['width'] = $this->arr_dimension['display']['width'];
            $configSize1['height'] = $this->arr_dimension['display']['height'];

            $path1['display'] = FCPATH . 'assets/uploads/mahasiswa/display';
            if (!is_dir($path1['display'])) {
                mkdir($path1['display'], 0775, true);
            }
            $path2['100'] = FCPATH . 'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'];
            if (!is_dir($path2['100'])) {
                mkdir($path2['100'], 0775, true);
            }
            $path3['150'] = FCPATH . 'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'];
            if (!is_dir($path3['150'])) {
                mkdir($path3['150'], 0775, true);
            }

            $configSize1['new_image'] = FCPATH . 'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'] . '/' . $file_name;
            $this->image_lib->initialize($configSize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return $file_name;
        }
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */