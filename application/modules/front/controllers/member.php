<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_register'));

        $this->arr_dimension = array();
        $this->arr_dimension['display']['width'] = 100;
        $this->arr_dimension['display']['height'] = 150;
    }

    public function index() {
        if ($this->session->userdata('CMS_member')) {
            redirect('member-dashboard');
        }
        $data['tab_active'] = 'login';

        if ($this->input->get('tab') == 'register') {
            $data['tab_active'] = 'register';
        }

        $this->frview('v_register_member', $data);
    }

    function submit_register_member() {
        $data['tab_active'] = 'register';
        $post = $this->input->post();
        $fields = ["firstname", "lastname", "email", "phone"];
        $code_activation = generateRandomString(20);

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('dob', 'dob', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Retype Password', 'required');

        foreach ($fields as $field) {
            $this->session->set_flashdata($field, $post[$field]);
        }

        if ($this->form_validation->run() == FALSE) {
            $this->frview('v_register_member', $data);
            return false;
        }

        $checkEmail = $this->m_register->check_data_where('member', array('email' => $post['email']));
        if ($checkEmail) {
            $this->session->set_flashdata('infoEmailinvalid', 'Maaf Email sudah terpakai.');
            redirect(site_url('login' . '?tab=register'));
        }

        $file_name = base_url('/assets/uploads/no-photo.png');
        if (!empty($_FILES['photo_mhs']['name'])) {
            $filename = $this->upload_image($_FILES['photo_mhs']);
            $file_name = base_url('/assets/uploads/member/display/100/150/' . $filename);
        }

        $dataInsert = array(
            'firstname' => trim($post['firstname']),
            'lastname' => trim($post['lastname']),
            'email' => trim($post['email']),
            'phone' => trim($post['phone']),
            'gender' => trim($post['gender']),
            'dob' => trim($post['dob']),
            'password' => encryptPass(trim($post['password'])),
            'photo' => $file_name,
            'code_activation' => $code_activation,
            'created_date' => date('Y-m-d H:i:s')
        );

        //insert to table member ;
        $insert_member = $this->m_register->insertData('member', $dataInsert);
        if (!$insert_member) {
            $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
            $this->frview('v_register_member', $data);
        }
        $this->send_mail_confirmation(trim($post['email']), $code_activation);
        $this->session->set_flashdata('infoSuccessRegister', 'Sukses terdaftar, silakan cek email untuk konfirmasi.');
        redirect(site_url("login"));
    }

    public function member_login() {
        $data['tab_active'] = 'login';
        $post = $this->input->post();
        $email = $post['email'];
        $password = $post['password'];

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->frview('v_register_member', $data);
            return false;
        }
        $this->session->set_flashdata('email', $post['email']);

        $check_email = $this->m_register->check_data_where('member', array('email' => $email));
        if (!$check_email) {
            $this->session->set_flashdata('infoFailedLogin', 'Maaf email yang diinput belum terdaftar.');
            redirect(site_url('login'));
        }

        $check_status = $this->m_register->check_data_where('member', array('email' => $email,
            'status' => 1));
        if (!$check_status) {
            $this->session->set_flashdata('infoFailedLogin', 'Silakan konfirmasi akun anda melalui email. ' .
                    '<br>Apabila tidak mendapat email konfirmasi <a href="' . site_url('resend-confirmation') . '">' .
                    'klik disini </a> .');
            redirect(site_url('login'));
        }

        $member_login = $this->m_register->do_login_member($email, $password);

        if (!$member_login) {
            $this->session->set_flashdata('infoFailedLogin', 'Maaf password yang diinput salah.');
            redirect('login');
        }

        //buat session untuk masuk member
        $session_data = array(
            'member_id' => $member_login->member_id,
            'firstname' => $member_login->firstname,
            'lastname' => $member_login->lastname,
            'email' => $member_login->email,
            'phone' => $member_login->member_id,
            'photo' => $member_login->photo,
            'status' => $member_login->status
        );
        $this->session->set_userdata('CMS_member', $session_data);
        redirect('member-dashboard');
    }

    function resend_confirmation() {
        $post = $this->input->post();

        if (!empty($post['email'])) {
            $checkEmail = $this->m_register->check_data_where('member', array('email' => $post['email']));
            if (!$checkEmail) {
                $this->session->set_flashdata('info', 'Your email not registered.');
                redirect('resend-confirmation');
            }
            $code_activation = generateRandomString(20);
            $this->send_mail_confirmation($post['email'], $code_activation);
            
            $this->m_register->updateData('member', array('code_activation' => $code_activation), array('email' => $post['email']));
            
            $this->session->set_flashdata('info', 'Please check your email.');
            redirect('resend-confirmation');
        }

        $this->frview('resend_confirmation');
    }
    
    function confirmation(){
        $data['message'] = "Confirmation failed.";
        $code_activation = $this->input->get('hash');
        $where = array('code_activation' => $code_activation);
        $check_code = $this->m_register->check_data_where('member', $where);
        
        //echo '<pre>'; print_r($this->m_register->getDataKey('member', $where)); die();
        
        if($check_code){
            //update status member to active
            $this->m_register->updateData('member', array('status' => 1), $where);
            
            $data_member = $this->m_register->getDataKey('member', $where);
            $data['message'] = "Account <b>". $data_member[0]['email']. '</b> has been active.';
        }
        $this->frview('confirmation', $data);
    }

    function send_mail_confirmation($email, $random_string) {
        $link_confirmation = site_url('account-confirmations?hash='.$random_string);
        $message = "Please <a href='". $link_confirmation ."'>click here </a> for confirmation your account";
        
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pwd'),
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->config->item('smtp_user'), 'noreply@seminar.com');
        $this->email->to($email);
        $this->email->bcc('isankhairul@gmail.com');
        $this->email->subject('Konfirmasi akun semainar.com');
        $this->email->message($message);
        $this->email->send();
    }

    function logout() {
        $this->session->unset_userdata('CMS_member');
        redirect(base_url());
    }

    private function upload_image($image) {
        $data = array();
        $config['upload_path'] = FCPATH . 'assets/uploads/member';
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
            $this->frview('v_register_member', $data);
        } else {
            /* First size */
            $configSize1['image_library'] = 'gd2';
            $configSize1['source_image'] = FCPATH . 'assets/uploads/member/' . $file_name;
            $configSize1['create_thumb'] = false;
            $configSize1['maintain_ratio'] = true;
            $configSize1['width'] = $this->arr_dimension['display']['width'];
            $configSize1['height'] = $this->arr_dimension['display']['height'];

            $path1['display'] = FCPATH . 'assets/uploads/member/display';
            if (!is_dir($path1['display'])) {
                mkdir($path1['display'], 0775, true);
            }
            $path2['100'] = FCPATH . 'assets/uploads/member/display/' . $this->arr_dimension['display']['width'];
            if (!is_dir($path2['100'])) {
                mkdir($path2['100'], 0775, true);
            }
            $path3['150'] = FCPATH . 'assets/uploads/member/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'];
            if (!is_dir($path3['150'])) {
                mkdir($path3['150'], 0775, true);
            }

            $configSize1['new_image'] = FCPATH . 'assets/uploads/member/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'] . '/' . $file_name;
            $this->image_lib->initialize($configSize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return $file_name;
        }
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */