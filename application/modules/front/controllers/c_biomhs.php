<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_biomhs extends MY_Controller {

    protected $sessionData;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_register'));
        $this->sessionData = $this->session->userdata('CMS_mahasiswa');
        if (!$this->sessionData) {
            redirect(base_url());
        }
        $this->arr_dimension = array();
        $this->arr_dimension['display']['width'] = 100;
        $this->arr_dimension['display']['height'] = 150;
    }

    public function index() {
        $data = array();
        $this->frview('v_biomhs', $data);
    }

    public function update_mahasiswa() {

        $data['mahasiswa'] = $this->m_register->getDetailMahasiswa($this->sessionData['id_mahasiswa']);
        $data['fakultas'] = $this->m_register->getDataKey('fakultas', array('status_fakultas' => 1));
        $this->frview('v_update_data_mhs', $data);
    }

    function submit_update_mhs() {

        $data['mahasiswa'] = $this->m_register->getDetailMahasiswa($this->sessionData['id_mahasiswa']);
        $data['fakultas'] = $this->m_register->getDataKey('fakultas', array('status_fakultas' => 1));

        $this->form_validation->set_rules('emailmhs', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->frview('v_update_data_mhs', $data);
        } else {
            $post = $this->input->post();
            //check to NIM valid ;
            $checkNIM = $this->m_register->checkNIM('mahasiswa', array('nim_mahasiswa' => $post['NIMmhs']));
            if ($checkNIM) {
                $this->session->set_flashdata('infoNIMinvalid', 'Maaf NIM tidak valid / sudah terpakai');
                $this->frview('v_update_data_mhs', $data);
            } else {
                $emailmhs = trim($post['emailmhs']);
                $alamat_mhs = trim($post['alamat_mhs']);
                $telp_mhs = trim($post['telp_mhs']);
                $file_name = base_url('/assets/uploads/mahasiswa/display/100/150/no-photo.png');
                if (!empty($_FILES['photo_mhs']['name'])) {
                    $filename = $this->upload_image($_FILES['photo_mhs']);
                    $file_name = base_url('/assets/uploads/mahasiswa/display/100/150/' . $filename);
                }

                $dataUpdate = array(
                    'email_mahasiswa' => $emailmhs,
                    'alamat_mahasiswa' => $alamat_mhs,
                    'telp_mahasiswa' => $telp_mhs,
                    'photo_mahasiswa' => $file_name,
                    'date_update' => date('Y-m-d H:i:s')
                );

                //insert to table mahasiswa ;
                $update_mhs = $this->m_register->updateData('mahasiswa', $dataUpdate, array("id_mahasiswa" => $this->sessionData['id_mahasiswa']));
                if ($update_mhs) {
                    $last_id = $this->sessionData['id_mahasiswa'];
                    $getLastIdMhs = $this->m_register->getDetailMahasiswa($last_id);
                    if ($getLastIdMhs) {
                        //buat session untuk masuk mahasiswa
                        $sessionMHS = array(
                            'id_mahasiswa' => $getLastIdMhs['id_mahasiswa'],
                            'nama_depan' => $getLastIdMhs['nama_depan'],
                            'nama_belakang' => $getLastIdMhs['nama_belakang'],
                            'nim_mahasiswa' => $getLastIdMhs['nim_mahasiswa'],
                            'nama_fakultas' => $getLastIdMhs['nama_fakultas'],
                            'nama_jurusan' => $getLastIdMhs['nama_jurusan'],
                            'email_mahasiswa' => $getLastIdMhs['email_mahasiswa'],
                            'alamat_mahasiswa' => $getLastIdMhs['alamat_mahasiswa'],
                            'telp_mahasiswa' => $getLastIdMhs['telp_mahasiswa'],
                            'tahun_masuk' => $getLastIdMhs['tahun_masuk'],
                            'semester_mahasiswa' => $getLastIdMhs['semester_mahasiswa'],
                            'photo_mahasiswa' => $getLastIdMhs['photo_mahasiswa'],
                            'nama_fakultas' => $getLastIdMhs['nama_fakultas']
                        );
                        $this->session->set_userdata('CMS_mahasiswa', $sessionMHS);
                        redirect('update-mahasiswa');
                    } else {
                        $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
                        $this->frview('', $data);
                    }
                } else {
                    die('gagal');
                    $this->session->set_flashdata('infoInsertFailed', 'Maaf register anda gagal , silahkan hubungi IT');
                    $this->frview('v_update_data_mhs', $data);
                }
            }
        }
    }

    function ChangePassword() {
        $this->form_validation->set_rules('current_pass', 'Current Password', 'required');
        $this->form_validation->set_rules('new_pass', 'New Password', 'required|matches[re_new_pass]');
        $this->form_validation->set_rules('re_new_pass', 'Retype New Password', 'required');

        $data['mahasiswa'] = $this->m_register->getDetailMahasiswa($this->sessionData['id_mahasiswa']);
        $data['fakultas'] = $this->m_register->getDataKey('fakultas', array('status_fakultas' => 1));


        if ($this->form_validation->run() == FALSE) {
            $this->frview('v_update_data_mhs', $data);
        } else {
            if ($this->input->post()) {
                //echo 'selanjutnya';die();
                $NowPassword = encryptPass($this->input->post('current_pass'));
                $NewPassword = encryptPass($this->input->post('new_pass'));

                $result = $this->m_register->check_To_password($this->sessionData['id_mahasiswa'], $NowPassword);
                if ($result) {
                    $field_key['id_mahasiswa'] = $this->sessionData['id_mahasiswa'];
                    $data_update['password_mahasiswa'] = $NewPassword;
                    $changePassword = $this->m_register->updateData('mahasiswa', $data_update, $field_key);
                    if ($changePassword) {

                        $this->session->set_flashdata('infoChangePassword', 'Password anda berhasil di ganti');
                        redirect('update-mahasiswa');
                    } else {
                        $this->session->set_flashdata('infoCheckcPassword', 'Ganti Password tidak berhasil');
                        redirect('update-mahasiswa');
                    }
                } else {
                    $this->session->set_flashdata('infoCheckPassword', 'Ganti Password tidak berhasil');
                    redirect('update-mahasiswa');
                }
            } else {
                redirect('update-mahasiswa');
            }
        }
    }

    function list_sertifikat() {
        //pagination settings
        $id_mahasiswa = $this->sessionData['id_mahasiswa'];
        $data['listSeminar_mahasiswa'] = array();
        $config['base_url'] = site_url('front/c_biomhs/list_seminar');
        $config['total_rows'] = $this->m_register->count_sertifikat($id_mahasiswa);
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
        $data['listSeminar_mahasiswa'] = $this->m_register->list_sertifikatMHS($config["per_page"], $data['page'], $id_mahasiswa);
        //echo $this->db->last_query();
        $data['pagination'] = $this->pagination->create_links();
        //echo '<pre>',print_r($data);

        $this->frview('v_list_sertifikat_mhs', $data);
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
            echo '<pre>', print_r($this->upload->display_errors());
            die();
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
                mkdir($path1['display'], 0775);
            }
            $path2['100'] = FCPATH . 'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'];
            if (!is_dir($path2['100'])) {
                mkdir($path2['100'], 0775);
            }
            $path3['150'] = FCPATH . 'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'];
            if (!is_dir($path3['150'])) {
                mkdir($path3['150'], 0775);
            }

            $configSize1['new_image'] = FCPATH . 'assets/uploads/mahasiswa/display/' . $this->arr_dimension['display']['width'] . '/' . $this->arr_dimension['display']['height'] . '/' . $file_name;
            $this->image_lib->initialize($configSize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return $file_name;
        }
    }

    public function list_seminar() {
        //pagination settings
        $id_mahasiswa = $this->sessionData['id_mahasiswa'];
        $data['listSeminar_mahasiswa'] = array();
        $config['base_url'] = site_url('front/c_biomhs/list_seminar');
        $config['total_rows'] = $this->m_register->count_seminar($id_mahasiswa);
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
        $data['listSeminar_mahasiswa'] = $this->m_register->list_seminarMHS($config["per_page"], $data['page'], $id_mahasiswa);
        //echo $this->db->last_query();
        $data['pagination'] = $this->pagination->create_links();
        //echo '<pre>',print_r($data);

        $this->frview('v_list_seminar_mhs', $data);
    }

    public function cetak_ticket($id_order = '') {
        //$id_order = $this->input->get('id_order');
        $data['ticket_seminar'] = array();
        $data['ticket_seminar'] = $this->m_register->ticket_seminar($id_order);
        //echo $data['ticket_seminar']->serial;
        //echo '<pre>',print_r($data);
        $this->load->library('Barcode39');
        $bc = new Barcode39($data['ticket_seminar']->serial);
        $bc->draw(trim($data['ticket_seminar']->serial . ".gif"));
        //$this->load->view('print_test', $data);exit;
        include_once APPPATH . '/third_party/mpdf/mpdf.php';
        $html = $this->load->view('ticket', $data, true);
        $this->mpdf = new mPDF('utf-8', array(250, 100));
        $file_name = $data['ticket_seminar']->tema_seminar . '-' . $data['ticket_seminar']->nim_mahasiswa;

        $stylesheet = file_get_contents('http://localhost/seminar/assets/frontend/css/print_ticket.css'); // external css
        $this->mpdf->WriteHTML($stylesheet, 1);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($file_name . '.pdf', 'D'); // download force
        $this->mpdf->Output($file_name . '.pdf', 'I'); // view in the explorer
    }

    public function cetak_sertifikat($id_order = '') {
        //$id_order = $this->input->get('id_order');
        include_once APPPATH . '/third_party/mpdf/mpdf.php';
        $data['ticket_seminar'] = array();
        $data['ticket_seminar'] = $this->m_register->ticket_seminar($id_order);
        //echo $data['ticket_seminar']->serial;
        //echo '<pre>',print_r($data);
        $this->load->library('Barcode39');
        $bc = new Barcode39($data['ticket_seminar']->serial);
        $bc->draw(trim($data['ticket_seminar']->serial . ".gif"));
        //$this->load->view('sertifikat', $data);
        $file_name = 'SERTIFIKAT-' . $data['ticket_seminar']->tema_seminar . '-' . $data['ticket_seminar']->nim_mahasiswa . '.pdf';
        $html = $this->load->view('sertifikat', $data, true);
        $this->mpdf = new mPDF();
        $stylesheet = file_get_contents('http://localhost/seminar/assets/frontend/css/bootstrap.css'); // external css

        $this->mpdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                18, // margin header
                12); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($file_name, 'D'); // download force
        $this->mpdf->Output($file_name, 'I'); // view in the explorer
        // for more information rhonalejandro@gmail.com
    }

    public function cetak_all_info_seminar($id_mahasiswa = '') {
        //$id_order = $this->input->get('id_order');
        include_once APPPATH . '/third_party/mpdf/mpdf.php';
        $data['all_seminar'] = array();
        $data['all_seminar'] = $this->m_register->all_seminar($id_mahasiswa);
        //echo '<pre>',print_r($data);die;
        //$this->load->view('report_all_seminar', $data);
        $file_name = 'REPORT.pdf';
        $html = $this->load->view('report_all_seminar', $data, true);
        $this->mpdf = new mPDF();
        $stylesheet = file_get_contents('../assets/frontend/css/style_all_seminar.css'); // external css

        $this->mpdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                18, // margin header
                12); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($file_name, 'D'); // download force
        $this->mpdf->Output($file_name, 'I'); // view in the explorer*/
        // for more information rhonalejandro@gmail.com
    }

    public function Make_PDF($view, $data, $file_name) {
        include_once APPPATH . '/third_party/mpdf/mpdf.php';
        $html = $this->load->view($view, $data, true);
        $this->mpdf = new mPDF();
        $this->stylesheet = file_get_contents('css/style.css');
        $this->mpdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 70, // margin_left
                30, // margin right
                30, // margin top
                30, // margin bottom
                18, // margin header
                12); // margin footer
        $this->mpdf->WriteHTML($html);
        //$this->mpdf->Output($file_name, 'D'); // download force
        $this->mpdf->Output($file_name, 'I'); // view in the explorer
        // for more information rhonalejandro@gmail.com
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */