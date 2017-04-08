<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends MX_Controller {
    
    protected $sessionData; 
     
    function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        date_default_timezone_set('Asia/Jakarta');
        
        $this->sessionData = $this->session->userdata('CMS_logged_in');
        
    }

    public function index() {
        if ($this->sessionData) {
            redirect('dashboard');
        }
        $this->load->view('v_login');
    }

    function proses() {
        $post = $this->input->post();
        $username = $post['username'];
        $password = encryptPass($post['password']);

        $select_user = $this->login_m->select_user($username, $password);
        if ($select_user) {
            echo '<pre>', print_r($select_user);
        } else {
            echo 'Data kosong';
        }
    }

    public function do_login() {
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_user');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_check_password');
        if ($this->form_validation->run($this) == FALSE) {
            $this->load->view('v_login');
        } else {
            $post = $this->input->post();
            $username = $post['username'];
            $password = $post['password'];
            $this->m_login->do_login($username, $password);
            redirect('dashboard');
        }
    }

    function check_user($str) {
        $this->form_validation->set_message('check_user', 'Username is invalid.');
        if ($this->m_login->check_user($str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_password($str) {
        $this->form_validation->set_message('check_password', 'Password is invalid.');
        $user = $this->input->post('username');
        if (($this->m_login->check_user($user)) && ($this->m_login->check_password($user, $str))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('CMS_logged_in');
        redirect(base_url('admin-login'));
    }

}

?>
