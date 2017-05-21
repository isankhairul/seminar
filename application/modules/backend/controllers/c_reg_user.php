<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_reg_user extends MY_Controller {

    protected $sessionData;

    function __construct() {
        parent::__construct();
        $this->load->model('m_register_user');
        $this->sessionData = $this->session->userdata('CMS_logged_in');
        if (!$this->sessionData) {
            redirect('backend/c_login');
        }
    }

    public function index() {
        //pagination settings
        $data = array();
        $config['base_url'] = site_url('backend/c_reg_user/index');
        $config['total_rows'] = $this->db->count_all('user');
        $config['per_page'] = "2";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        //call the model function to get the department data
        $data['start'] = $this->uri->segment(4, 0);
        $data['listRegisterUser'] = $this->m_register_user->list_dataRegisterUser($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $this->doview('list_RegUser', $data);
    }

    public function v_registerUser($id = '') {
        $data = array();
        $data['getDetail'] = array();
        $data['type_form'] = 'add';
        if (!empty($id)) {
            $detailRegisterUser = $this->m_register_user->detailRegisterUser($id);
            $data['getDetail'] = $detailRegisterUser;
            $data['type_form'] = 'edit';
        }
        $this->doview('v_register_user', $data);
    }

    public function register_user() {
        $data = array();
        $post = $this->input->post();
        if (!isset($post['user_id'])) {
            $this->form_validation->set_rules('fullname', 'fullname', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[Re_password]');
            $this->form_validation->set_rules('Re_password', 'Retype Password', 'required');
        } else {
            $this->form_validation->set_rules('fullname', 'fullname', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            if (!isset($post['user_id'])) {
                $this->doview('v_register_user', $data);
            }
        }
        $fullname = $post['fullname'];
        $email = $post['email'];
        $phone = $post['phone'];
        $role = $post['role'];
        $created_date = date('Y-m-d H:i:s');
        $username = $post['username'];
        $pass = encryptPass($post['password']);

        if (isset($post['user_id'])) {
            $detailRegisterUser = $this->m_register_user->detailRegisterUser($post['user_id']);
            $checkUsername = $this->m_register_user->check_username($username);
            if ($checkUsername && $detailRegisterUser->username != $username) {
                $this->session->set_flashdata('infoCheckUsername', 'Maaf username sudah di gunakan');
                redirect('register_user');
                exit;
            } else {
                $data = array(
                    'fullname' => $fullname,
                    'email' => $email,
                    'phone' => $phone,
                    'role' => $role,
                    'modified_date' => date('Y-m-d H:i:s'),
                    'username' => $username
                );
            }
        } else {
            $checkUsername = $this->m_register_user->check_username($username);
            if ($checkUsername) {
                $this->session->set_flashdata('infoCheckUsername', 'Maaf username sudah di gunakan');
                redirect('register_user');
                exit;
            } else {
                $data = array(
                    'fullname' => $fullname,
                    'email' => $email,
                    'phone' => $phone,
                    'role' => $role,
                    'created_date' => date('Y-m-d H:i:s'),
                    'username' => $username,
                    'password' => $pass
                );
            }
        }
        if (isset($post['user_id'])) {
            $key = array('user_id' => $post['user_id']);
            $res = $this->m_register_user->UpdateRegisterUser('user', $data, $key);
        } else {
            $res = $this->m_register_user->InsertRegisterUser('user', $data);
        }

        if ($res) {
            if (isset($post['user_id'])) {
                $this->session->set_flashdata('infoRegisterUser', 'Data Berhasil Di Ubah');
            } else {
                $this->session->set_flashdata('infoRegisterUser', 'Data Berhasil Di Tambah');
            }
            redirect('register_user');
        } else {
            echo "<h2>Insert Data Gagal</h2>";
        }
    }

    public function do_delete($id = '') {
        $session_user_id = $this->session->userdata('CMS_logged_in')['user_id'];
        $id = $this->input->post('id');
        
        if($id == $session_user_id){
            $alert = 'User sendiri tidak bisa di hapus !';
            $returnVal = '';
            echo json_encode((object) array('alert' => $alert, 'returnVal' => $returnVal));
            return false;
        }
        
        $delete_user = $this->m_register_user->deleteData('user', array('user_id' => $id));
        if ($delete_user) {
            $alert = 'Data Berhasil Di Hapus';
            $returnVal = 'success';
        } else {
            $alert = 'Gagal , silahkan hubungi IT';
            $returnVal = '';
        }

        echo json_encode((object) array('alert' => $alert, 'returnVal' => $returnVal));
    }

}

?>
