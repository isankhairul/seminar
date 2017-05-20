<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_seminar extends MY_Controller {

    protected $sessionData;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_seminar'));
        $this->load->library('excel');
        $this->sessionData = $this->session->userdata('CMS_logged_in');
        if (!$this->sessionData) {
            redirect('backend/c_login');
        }

        $this->arr_dimension_poster = array();
        $this->arr_dimension_poster['display']['width'] = 250;
        $this->arr_dimension_poster['display']['height'] = 400;

        $this->arr_dimension_sertifikat = array();
        $this->arr_dimension_sertifikat['display']['width'] = 400;
        $this->arr_dimension_sertifikat['display']['height'] = 150;
    }

    public function index() {
        //pagination settings
        $session_searchMahasiswa = $this->session->userdata('pencarian_seminar');
        if (isset($session_searchMahasiswa)) {
            $this->session->unset_userdata('pencarian_seminar');
        }
        $config['base_url'] = site_url('backend/c_seminar/index');
        $config['total_rows'] = $this->db->count_all('seminar');
        $config['per_page'] = "5";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 2;
        //$config['use_page_numbers']  = TRUE;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = true;
        $config['last_link'] = $this->db->count_all('seminar');
        ;
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
        $data['listSeminar'] = $this->m_seminar->list_dataSeminar($config["per_page"], $data['page']);
        foreach ($data['listSeminar'] as $key => $value) {
            $data['listSeminar'][$key]['list_peserta'] = $this->m_seminar->list_Peserta($value['seminar_id']);
        }
        $data['pagination'] = $this->pagination->create_links();
        $this->doview('list_seminar', $data);
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

        $search_seminar = "";
        $postkata = $this->input->post('search_seminar');
        if (!empty($postkata)) {
            $search_seminar = $this->input->post('search_seminar');
            $this->session->set_userdata('pencarian_seminar', $search_seminar);
        } else {
            $search_seminar = $this->session->userdata('pencarian_seminar');
        }
        //$data['listMahasiswa'] = $this->search_model->cari_dosen($batas,$offset,$data['nama']);
        $data['listSeminar'] = $this->m_seminar->list_dataSeminar($batas, $offset, $search_seminar);
        //$tot_hal = $this->search_model->tot_hal('ja_mst_dosen','nama_dosen',$data['nama']);

        $config['base_url'] = base_url() . 'backend/c_seminar/cari/';
        $config['total_rows'] = $this->m_seminar->jumlah_dataSeminar($search_seminar);
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

        //call the model function to get the Mahasiswa data
        $data['start'] = $this->uri->segment(4, 0);

        $data["pagination"] = $this->pagination->create_links();
        $this->doview('list_seminar', $data);

        //$this->load->view('search/hasil',$data);
    }

    public function v_seminar($id = '') {
        $data = array();
        $data['getDetail'] = array();
        $data['type_form'] = 'add';
        if (!empty($id)) {
            $data['getDetail'] = $this->m_seminar->detailSeminar($id);
            $data['type_form'] = 'edit';
        }

        $this->doview('v_seminar', $data);
    }

    public function listPeserta($seminar_id = '') {
        $data = array();
        $session_searchPesertaMahasiswa = $this->session->userdata('pencarian_peserta_seminar');
        if (isset($session_searchPesertaMahasiswa)) {
            $this->session->unset_userdata('pencarian_peserta_seminar');
        }
        $page = $this->uri->segment(5);
        //echo $page;die();
        $batas = 20;
        if (!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;

        $search_peserta = "";
        $postkata = $this->input->post('search_peserta');
        if (!empty($postkata)) {
            $search_peserta = $this->input->post('search_peserta');
            $this->session->set_userdata('pencarian_peserta_seminar', $search_peserta);
        } else {
            $search_peserta = $this->session->userdata('pencarian_peserta_seminar');
        }

        $config['base_url'] = base_url() . 'backend/c_seminar/listPeserta/' . $seminar_id;
        $config['total_rows'] = $this->m_seminar->jumlah_dataPesertaSeminar($search_peserta, $seminar_id);
        $config['per_page'] = $batas;
        $config['uri_segment'] = 5;


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
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        //call the model function to get the Mahasiswa data
        $data['start'] = $this->uri->segment(5, 0);

        $data["pagination"] = $this->pagination->create_links();
        $data['list_peserta'] = $this->m_seminar->list_PesertaSeminar($batas, $offset, $search_peserta, $seminar_id);
        
        //echo '<pre>';
//        print_r($data); die();
        
        $this->doview('list_PesertaSeminar', $data);
    }

    public function submit_seminar() {
        $data = array();
        $post = $this->input->post();
        $id = $post['id'];
        $user_id = $this->session->userdata('CMS_logged_in')['user_id'];

        $this->form_validation->set_rules('tema_seminar', 'Tema Seminar', 'required');
        $this->form_validation->set_rules('desc_seminar', 'Deskripsi Seminar', 'required');
        $this->form_validation->set_rules('jadwal_seminar', 'Jadwal Seminar', 'required');
        $this->form_validation->set_rules('pembicara_seminar', 'Pembicara Seminar', 'required');
        $this->form_validation->set_rules('tempat_seminar', 'Tempat Seminar', 'required');
        $this->form_validation->set_rules('kuota_seminar', 'Kuota Seminar', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            if (isset($id)) {
                $detail = $this->m_seminar->detailSeminar($id);
                $data['getDetail'] = $detail;
                $data['type_form'] = 'edit';
                $this->doview('v_seminar', $data);
                return false;
            }
            $this->doview('v_seminar');
            return false;
        }

        $data_seminar = array(
            'user_id' => $user_id,
            'tema' => trim($post['tema_seminar']),
            'description' => trim($post['desc_seminar']),
            'jadwal' => $post['jadwal_seminar'],
            'pembicara' => trim($post['pembicara_seminar']),
            'tempat' => trim($post['tempat_seminar']),
            'kuota' => trim($post['kuota_seminar']),
            'status' => trim($post['status_seminar'])
        );
        $poster_seminar = base_url('/assets/uploads/noimage.png');
        if (!empty($_FILES['poster_seminar']['name'])) {
            $filename_poster = $this->upload_image_poster($_FILES['poster_seminar']);
            $poster_seminar = base_url('/assets/uploads/poster_seminar/display/250/400/' . $filename_poster);
            $data_seminar = array_merge($data_seminar, array('poster' => $poster_seminar));
        }

        if (isset($id) && !empty($id)) {
            $data_seminar = array_merge($data_seminar, 
                                        array('modified_date' => date('Y-m-d H:i:s'),));
        } else {
            $data_seminar = array_merge($data_seminar, 
                                        array('created_date' => date('Y-m-d H:i:s'),
                                                'sisa_kuota' => trim($post['kuota_seminar'])));
        }

        if (isset($id)) {
            $key = array('seminar_id' => $id);
            $res = $this->m_seminar->UpdateSeminar('seminar', $data_seminar, $key);
        } else {
            $res = $this->m_seminar->InsertSeminar('seminar', $data_seminar);
        }

        if ($res) {
            if (isset($id)) {
                $this->session->set_flashdata('infoSeminar', 'Data Berhasil Di Ubah');
            } else {
                $this->session->set_flashdata('infoSeminar', 'Data Berhasil Di Tambah');
            }
            redirect('seminar-admin');
        } else {
            echo "<h2>INsert Data Gagal</h2>";
        }
    }

    public function do_delete($id = '') {
        $id = $this->input->post('id');
        $where = array('seminar_id' => $id);

        $delete_seminar = $this->m_seminar->deleteData('seminar', $where);
        if ($delete_seminar) {
            $alert = 'Data Berhasil Di Hapus';
            $returnVal = 'success';
        } else {
            $alert = 'Gagal , silahkan hubungi IT';
            $returnVal = '';
        }

        echo json_encode((object) array('alert' => $alert, 'returnVal' => $returnVal));
    }

    private function upload_image_poster($image) {
        $data = array();
        $config['upload_path'] = FCPATH . 'assets/uploads/poster_seminar';
        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path']);
        }
        $info = pathinfo($image['name']);

        $url_title = url_title($info['filename'], '_', TRUE);
        $file_name = generateRandomString(10) . '.' . $info['extension'];
        $config['file_name'] = $file_name;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        //$this->upload->initialize($config);
        $upload = $this->upload->do_upload('poster_seminar');

        if (!$upload) {
            $invalid = $this->upload->display_errors();
            $this->session->set_flashdata('infoErrorsPhoto', $invalid);
            $this->frview('v_seminar', $data);
        } else {
            /* First size */
            $configSize1['image_library'] = 'gd2';
            $configSize1['source_image'] = FCPATH . 'assets/uploads/poster_seminar/' . $file_name;
            $configSize1['create_thumb'] = false;
            $configSize1['maintain_ratio'] = true;
            $configSize1['width'] = $this->arr_dimension_poster['display']['width'];
            $configSize1['height'] = $this->arr_dimension_poster['display']['height'];

            $path1['display'] = FCPATH . 'assets/uploads/poster_seminar/display';
            if (!is_dir($path1['display'])) {
                mkdir($path1['display'], 0775);
            }
            $path2['250'] = FCPATH . 'assets/uploads/poster_seminar/display/' . $this->arr_dimension_poster['display']['width'];
            if (!is_dir($path2['250'])) {
                mkdir($path2['250'], 0775);
            }
            $path3['400'] = FCPATH . 'assets/uploads/poster_seminar/display/' . $this->arr_dimension_poster['display']['width'] . '/' . $this->arr_dimension_poster['display']['height'];
            if (!is_dir($path3['400'])) {
                mkdir($path3['400'], 0775);
            }

            $configSize1['new_image'] = FCPATH . 'assets/uploads/poster_seminar/display/' . $this->arr_dimension_poster['display']['width'] . '/' . $this->arr_dimension_poster['display']['height'] . '/' . $file_name;
            $this->image_lib->initialize($configSize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return $file_name;
        }
    }

    private function upload_image_sertifikat($image) {
        $data = array();
        $config['upload_path'] = FCPATH . 'assets/uploads/sertifikat_seminar';
        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path']);
        }

        $info = pathinfo($image['name']);

        $url_title = url_title($info['filename'], '_', TRUE);
        $file_name = generateRandomString(10) . '.' . $info['extension'];
        $config['file_name'] = $file_name;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        //$this->load->library('upload', $config);
        $this->upload->initialize($config);
        $upload = $this->upload->do_upload('sertifikat_seminar');

        if (!$upload) {
            $invalid = $this->upload->display_errors();

            $this->session->set_flashdata('infoErrorsPhoto', $invalid);
            $this->frview('v_seminar', $data);
        } else {
            /* First size */
            $configSize1['image_library'] = 'gd2';
            $configSize1['source_image'] = FCPATH . 'assets/uploads/sertifikat_seminar/' . $file_name;
            $configSize1['create_thumb'] = false;
            $configSize1['maintain_ratio'] = true;
            $configSize1['width'] = $this->arr_dimension_sertifikat['display']['width'];
            $configSize1['height'] = $this->arr_dimension_sertifikat['display']['height'];

            $path1['display'] = FCPATH . 'assets/uploads/sertifikat_seminar/display';
            if (!is_dir($path1['display'])) {
                mkdir($path1['display'], 0775, true);
            }
            $path2['400'] = FCPATH . 'assets/uploads/sertifikat_seminar/display/' . $this->arr_dimension_sertifikat['display']['width'];
            if (!is_dir($path2['400'])) {
                mkdir($path2['400'], 0775, true);
            }
            $path3['150'] = FCPATH . 'assets/uploads/sertifikat_seminar/display/' . $this->arr_dimension_sertifikat['display']['width'] . '/' . $this->arr_dimension_sertifikat['display']['height'];
            if (!is_dir($path3['150'])) {
                mkdir($path3['150'], 0775, true);
            }

            $configSize1['new_image'] = FCPATH . 'assets/uploads/sertifikat_seminar/display/' . $this->arr_dimension_sertifikat['display']['width'] . '/' . $this->arr_dimension_sertifikat['display']['height'] . '/' . $file_name;
            $this->image_lib->initialize($configSize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return $file_name;
        }
    }

    function change_kehadiran_peserta_seminar() {
        $post = $this->input->post();
        $status = "";
        $where = array('order_id' => $post['id'],
                       'member_id' => $post['member_id']);

        switch ($post['chk']) {
            case 1 :
                $this->general_model->updateData('seminar_order', array('attended' => $post['chk']), $where);
                $status = "success";
                break;

            case 0 :
                $this->general_model->updateData('seminar_order', array('attended' => $post['chk']), $where);
                $status = "failed";
                break;
        }
        echo json_encode(array('status' => $status));
    }

    function print_pesertaSeminar($seminar_id = '') {
        @set_time_limit(0);
        ob_clean();

        $data_peserta = $this->m_seminar->list_Peserta($seminar_id);
        $date_now = date('Ymd');
        //echo '<pre>';
        //print_r($data_peserta); die();
        
        $nama_seminar = $data_peserta[0]['tema'];
        $this->excel->getActiveSheet()->setTitle('List Peserta Seminar');

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue('A1', 'List Peserta Seminar');
        $this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);

        $this->excel->setActiveSheetIndex(0);

        // Field names in the first row
        // set cell A1 content with some text
        $fields = array('No', 'Tema Seminar', 'Email', 'Nama Depan', 'Nama Belakang', 'Serial', 'Attended');

        $col = 0;
        foreach ($fields as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 6, $field);
            $col++;
        }

        $row = 7;
        $no = 1;
        $noCol = 0;
        foreach ($data_peserta as $data) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($noCol, $row, $no);
            $arrItem = array('tema', 'email', 'firstname', 'lastname', 'serial', 'attended');

            $col = 1;
            foreach ($arrItem as $field) {
                $data_field = $data[$field];
                
                if($field == 'attended'){
                    $data_field = 'Tidak Hadir';
                    if($data_field == 1){
                        $data_field = 'Hadir';
                    }
                }
                
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data_field);
                $col++;
            }
            //make border
            $this->excel->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($styleArray);
            $no++;
            $row++;
        }
        //make auto size        
        for ($col = 'A'; $col !== 'L'; $col++) {
            $this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }
        //make border
        $this->excel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleArray);

        //change the font size
        $this->excel->getActiveSheet()->getStyle()->getFont()->setSize(10);

        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1:G3')->getFont()->setBold(true);

        //merge cell
        $this->excel->getActiveSheet()->mergeCells('A1:G1');

        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1:G3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $this->excel->setActiveSheetIndex(0);
        
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $filename = "peserta-seminar-" . url_title($data_peserta[0]['tema']) . '-' . $date_now . ".xls";
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

}
?>
