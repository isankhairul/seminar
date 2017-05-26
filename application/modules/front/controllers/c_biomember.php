<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_biomember extends MY_Controller {

    protected $sessionData;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_register'));
        $this->sessionData = $this->session->userdata('CMS_member');
        if (!$this->sessionData) {
            redirect(base_url());
        }
        $this->arr_dimension = array();
        $this->arr_dimension['display']['width'] = 100;
        $this->arr_dimension['display']['height'] = 150;
    }

    public function index() {
        $data = array();
        $this->frview('v_biomember', $data);
    }

    public function update_member() {
        $data['member'] = $this->m_register->getDetailMember($this->sessionData['member_id']);
        //echo '<pre>'; print_r($data); die();
        $this->frview('v_update_data_member', $data);
    }

    function submit_update_member() {

        $data['member'] = $this->m_register->getDetailMember($this->sessionData['member_id']);
        $post = $this->input->post();

        $dataUpdate = array(
            'firstname' => trim($post['firstname']),
            'lastname' => trim($post['lastname']),
            'phone' => trim($post['phone']),
            'modified_date' => date('Y-m-d H:i:s')
        );
        
        $file_name = base_url('/assets/uploads/no-photo.png');
        if (!empty($_FILES['photo']['name'])) {
            $filename = $this->upload_image($_FILES['photo']);
            $file_name = base_url('/assets/uploads/member/display/100/150/' . $filename);
            $dataUpdate = array_merge($dataUpdate, array('photo' => $file_name));
        }

        //insert to table member ;
        $update_member = $this->m_register->updateData('member', $dataUpdate, array("member_id" => $this->sessionData['member_id']));

        //echo '<pre>'; print_r($this->session->userdata('CMS_member')); die('');

        if (!$update_member) {
            die('gagal');
            $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
            redirect(site_url('update-member'));
        }

        $detail_member = $this->m_register->getDetailMember($this->sessionData['member_id']);
        if ($detail_member) {
            $session_data = array(
                'member_id' => $detail_member['member_id'],
                'firstname' => $detail_member['firstname'],
                'lastname' => $detail_member['lastname'],
                'email' => $detail_member['email'],
                'phone' => $detail_member['phone'],
                'photo' => $detail_member['photo'],
                'status' => $detail_member['status']
            );
            $this->session->set_userdata('CMS_member', $session_data);
            redirect('update-member');
        } else {
            $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
            redirect(site_url('update-member'));
        }
    }

    function ChangePassword() {
        $this->form_validation->set_rules('current_pass', 'Current Password', 'required');
        $this->form_validation->set_rules('new_pass', 'New Password', 'required|matches[re_new_pass]');
        $this->form_validation->set_rules('re_new_pass', 'Retype New Password', 'required');

        $data['member'] = $this->m_register->getDetailMember($this->sessionData['member_id']);

        if ($this->form_validation->run() == FALSE) {
            $this->frview('v_update_data_member', $data);
            return false;
        }
        if ($this->input->post()) {
            //echo 'selanjutnya';die();
            $NowPassword = encryptPass($this->input->post('current_pass'));
            $NewPassword = encryptPass($this->input->post('new_pass'));

            $result = $this->m_register->check_To_password($this->sessionData['member_id'], $NowPassword);
            if ($result) {
                $field_key['member_id'] = $this->sessionData['member_id'];
                $data_update['password'] = $NewPassword;
                $changePassword = $this->m_register->updateData('member', $data_update, $field_key);
                if ($changePassword) {

                    $this->session->set_flashdata('infoChangePassword', 'Password anda berhasil di ganti');
                    redirect('update-member');
                } else {
                    $this->session->set_flashdata('infoCheckcPassword', 'Ganti Password tidak berhasil');
                    redirect('update-member');
                }
            } else {
                $this->session->set_flashdata('infoCheckPassword', 'Ganti Password tidak berhasil');
                redirect('update-member');
            }
        } else {
            redirect('update-member');
        }
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
        $upload = $this->upload->do_upload('photo');

        if (!$upload) {
            $invalid = $this->upload->display_errors();
            $this->session->set_flashdata('infoErrorsPhoto', $invalid);
            $this->frview('v_register_member', $data);
            echo '<pre>', print_r($this->upload->display_errors());
            die();
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
                mkdir($path1['display'], 0775);
            }
            $path2['100'] = FCPATH . 'assets/uploads/member/display/' . $this->arr_dimension['display']['width'];
            if (!is_dir($path2['100'])) {
                mkdir($path2['100'], 0775);
            }
            $path3['150'] = FCPATH . 'assets/uploads/member/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'];
            if (!is_dir($path3['150'])) {
                mkdir($path3['150'], 0775);
            }

            $configSize1['new_image'] = FCPATH . 'assets/uploads/member/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'] . '/' . $file_name;
            $this->image_lib->initialize($configSize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return $file_name;
        }
    }

    public function list_seminar() {
        //pagination settings
        $member_id = $this->sessionData['member_id'];
        $data['list_seminar_member'] = array();
        $config['base_url'] = site_url('front/c_biomember/list_seminar');
        $config['total_rows'] = $this->m_register->count_seminar($member_id);
        $config['per_page'] = "5";
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
        $data['list_seminar_member'] = $this->m_register->list_seminar_member($config["per_page"], $data['page'], $member_id);
        
        $data['pagination'] = $this->pagination->create_links();

        $this->frview('v_list_seminar_member', $data);
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */