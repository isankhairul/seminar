<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_member extends MY_Controller {

    protected $sessionData;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_member'));
        $this->load->library('file_excel');
        $this->sessionData = $this->session->userdata('CMS_logged_in');
        if (!$this->sessionData) {
            redirect('backend/c_login');
        }
        $this->arr_dimension = array();
        $this->arr_dimension['display']['width'] = 100;
        $this->arr_dimension['display']['height'] = 150;
    }

    public function index() {
        $session_searchMember = $this->session->userdata('pencarian_member');
        if (isset($session_searchMember)) {
            $this->session->unset_userdata('pencarian_member');
        }
        $data['listMember'] = array();

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("backend/c_member/index/");



        $config['total_rows'] = $this->m_member->jumlah_dataMember($search);
        //echo $config['total_rows'];die();
        $config['per_page'] = "20";
        $config["uri_segment"] = 4;
        //$choice 				= $config["total_rows"] / $config["per_page"];
        //$config["num_links"] 	= floor($choice);
        $config["num_links"] = 10;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
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

        //call the model function to get the Member data
        $data['start'] = $this->uri->segment(4, 0);

        $data['listMember'] = $this->m_member->list_dataMember($config["per_page"], $data['page'], $search);
        //echo $this->db->last_query();die();
        $data['pagination'] = $this->pagination->create_links();
        //echo '<pre>',print_r($data);die();
        $this->doview('list_member_b', $data);
    }

    function cari() {
        $page = $this->uri->segment(4);
        //echo $page;die();
        $batas = 20;
        if (!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;

        $search_member = "";
        $postkata = $this->input->post('search_member');
        if (!empty($postkata)) {
            $search_member = $this->input->post('search_member');
            $this->session->set_userdata('pencarian_member', $search_member);
        } else {
            $search_member = $this->session->userdata('pencarian_member');
        }
        //$data['listMember'] = $this->search_model->cari_dosen($batas,$offset,$data['nama']);
        $data['listMember'] = $this->m_member->list_dataMember($batas, $offset, $search_member);
        //$tot_hal = $this->search_model->tot_hal('ja_mst_dosen','nama_dosen',$data['nama']);

        $config['base_url'] = base_url() . 'backend/c_member/cari/';
        $config['total_rows'] = $this->m_member->jumlah_dataMember($search_member);
        $config['per_page'] = $batas;
        $config['uri_segment'] = 4;


        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
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

        //call the model function to get the Member data
        $data['start'] = $this->uri->segment(4, 0);

        $data["pagination"] = $this->pagination->create_links();
        $this->doview('list_member_b', $data);

        //$this->load->view('search/hasil',$data);
    }

    public function v_member($id = '') {
        $data = array();
        $data['getDetail'] = array();
        $data['type_form'] = 'add';
        if (!empty($id)) {
            $detail = $this->m_member->getDetailMember($id);
            $data['getDetail'] = $detail;
            $data['type_form'] = 'edit';
        }
        //echo '<pre>',print_r($data);die();
        $this->doview('v_member_b', $data);
    }

    public function edit_member() {
        $post = $this->input->post();
        $data = array();
        $id = $post['id'];

        $dataUpdate = array(
            'firstname' => $post['firstname'],
            'lastname' => $post['lastname'],
            'email' => $post['email'],
            'phone' => $post['phone']
        );
        if (!empty($_FILES['photo']['name'])) {
            $filename = $this->upload_image($_FILES['photo']);
            $file_name = base_url('/assets/uploads/member/display/100/150/' . $filename);
            $dataUpdate = array_merge($dataUpdate, array('photo' => $file_name));
        }
        $updateMhs = $this->m_member->UpdateData('member', $dataUpdate, array('id_member' => $id));
        if ($updateMhs) {
            $this->session->set_flashdata('infoUpdateMember', 'Data Member Berhasil Di Update');
            redirect('member');
        } else {
            $this->session->set_flashdata('infoUpdateMember', 'Data Member Gagal Di Update');
            redirect('member');
        }
    }

    public function do_delete($id = '') {
        $id = $this->input->post('id');
        $data = array('status_member' => 2);
        $where = array('id_member' => $id);

        $delete_member = $this->m_member->UpdateData('member', $data, $where);
        if ($delete_member) {
            $alert = 'Data Berhasil Di Hapus';
            $returnVal = 'success';
        } else {
            $alert = 'Gagal , silahkan hubungi IT';
            $returnVal = '';
        }

        echo json_encode((object) array('alert' => $alert, 'returnVal' => $returnVal));
    }

    public function change_password_mhs() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[retype_password]');
        $this->form_validation->set_rules('retype_password', 'Retype Password', 'required');
        $data = array();
        $data['getDetail'] = array();
        $data['type_form'] = 'add';
        if (!empty($id)) {
            $detail = $this->m_member->getDetailMember($id);
            $data['getDetail'] = $detail;
            $data['type_form'] = 'edit';
        }

        if ($this->form_validation->run() == FALSE) {
            $this->doview('v_member_b', $data);
        } else {
            $post = $this->input->post();
            $updatePassMhs = $this->m_member->UpdateData('member', array('password_member' => encryptPass($post['password'])), array('id_member' => $id));
            if ($updatePassMhs) {
                $this->session->set_flashdata('infoChangePasswordMhs', 'Data Password Berhasil Di Update');
                redirect('member');
            } else {
                $this->session->set_flashdata('infoChangePasswordMhs', 'Data Password Gagal Di Update');
                redirect('member');
            }
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
        $upload = $this->upload->do_upload('photo_mhs');

        if (!$upload) {
            $invalid = $this->upload->display_errors();
            $this->session->set_flashdata('infoErrorsPhoto', $invalid);
            $this->frview('v_register_mhs', $data);
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

?>
