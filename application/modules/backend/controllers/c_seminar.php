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
        $data['listFakultas'] = array();
        $session_searchMahasiswa = $this->session->userdata('pencarian_seminar');
        if (isset($session_searchMahasiswa)) {
            $this->session->unset_userdata('pencarian_seminar');
        }
        $config['base_url'] = site_url('backend/c_seminar/index');
        $config['total_rows'] = $this->db->count_all('seminar');
        $config['per_page'] = "1";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        //$config['use_page_numbers']  = TRUE;
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
        $data['listSeminar'] = $this->m_seminar->list_dataSeminar($config["per_page"], $data['page']);
        foreach ($data['listSeminar'] as $key => $value) {
            $data['listSeminar'][$key]['list_peserta'] = $this->m_seminar->list_Peserta($value['id_seminar']);
        }
        //echo '<pre>',print_r($data);die();
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
        $data['listfakultas'] = $this->m_seminar->getAllDataFakultas();
        foreach ($data['listfakultas'] as $key => $value) {
            $data['listfakultas'][$key]['listjurusan'] = $this->m_seminar->getAllDataJurusan($value['id_fakultas']);
        }
        $data['type_form'] = 'add';
        if (!empty($id)) {
            $detail = $this->m_seminar->detailSeminar($id);
            $data['getDetail'] = $detail;
            $data['type_form'] = 'edit';
        }

        //echo '<pre>',print_r($data);die();
        $this->doview('v_seminar', $data);
    }

    public function listPeserta($id_seminar = '') {
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

        $config['base_url'] = base_url() . 'backend/c_seminar/listPeserta/' . $id_seminar;
        $config['total_rows'] = $this->m_seminar->jumlah_dataPesertaSeminar($search_peserta, $id_seminar);
        //echo $config['total_rows'];die();
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
        //$this->doview('list_seminar', $data);
        //$data['listSeminar'] = $this->m_seminar->list_dataSeminar($batas,$offset,$search_seminar);
        $data['list_peserta'] = $this->m_seminar->list_PesertaSeminar($batas, $offset, $search_peserta, $id_seminar);

        $this->doview('list_PesertaSeminar', $data);
    }

    public function submit_seminar() {
        $data = array();
        $data['listfakultas'] = $this->m_seminar->getAllDataFakultas();
        foreach ($data['listfakultas'] as $key => $value) {
            $data['listfakultas'][$key]['listjurusan'] = $this->m_seminar->getAllDataJurusan($value['id_fakultas']);
        }
        $post = $this->input->post();
        //echo '<pre>',print_r($post);die();
        $id = $post['id'];
        if (isset($id)) {
            $this->form_validation->set_rules('tema_seminar', 'Tema Fakultas', 'required');
            $this->form_validation->set_rules('jadwal_seminar', 'Jadwal Seminar', 'required');
            $this->form_validation->set_rules('pembicara_seminar', 'Pembicara Seminar', 'required');
            $this->form_validation->set_rules('tempat_seminar', 'Tempat Seminar', 'required');
            $this->form_validation->set_rules('kelas_seminar', 'Kelas Seminar', 'required');
            $this->form_validation->set_rules('semester_seminar', 'Semester Seminar', 'required');
            //$this->form_validation->set_rules('nama_jurusan', 'Jurusan Seminar', 'required');
            //$this->form_validation->set_rules('poster_seminar', 'Poster Seminar', 'required');
            //$this->form_validation->set_rules('sertifikat_seminar', 'Poster Seminar', 'required');
        } else {
            $this->form_validation->set_rules('tema_seminar', 'Tema Fakultas', 'required');
            $this->form_validation->set_rules('jadwal_seminar', 'Jadwal Seminar', 'required');
            $this->form_validation->set_rules('pembicara_seminar', 'Pembicara Seminar', 'required');
            $this->form_validation->set_rules('tempat_seminar', 'Tempat Seminar', 'required');
            $this->form_validation->set_rules('kuota_seminar', 'Kuota Seminar', 'required');
            $this->form_validation->set_rules('kelas_seminar', 'Kelas Seminar', 'required');
            $this->form_validation->set_rules('semester_seminar', 'Semester Seminar', 'required');
            //$this->form_validation->set_rules('nama_jurusan', 'Jurusan Seminar', 'required');
            //$this->form_validation->set_rules('poster_seminar', 'Poster Seminar', 'required');
            //$this->form_validation->set_rules('sertifikat_seminar', 'Poster Seminar', 'required');
        }


        if ($this->form_validation->run() == FALSE) {
            if (isset($id)) {
                $detail = $this->m_seminar->detailSeminar($id);
                $data['getDetail'] = $detail;
                $data['type_form'] = 'edit';
                //echo '<pre>',print_r($data);die();
                $this->doview('v_seminar', $data);
            }
        } else {
            $tema_seminar = trim(strtoupper($post['tema_seminar']));
            $jadwal_seminar = $post['jadwal_seminar']; /*
              $originalDate 				= $jadwal_seminar ;
              $newDate 					= date("Y-m-d H:i:s", strtotime($originalDate));
              $jadwal_seminar             = date_create($post['jadwal_seminar']);
              $jadwal_seminar             = date_format($jadwal_seminar,"Y-m-d H:i:s"); */
            $pembicara_seminar = trim(strtoupper($post['pembicara_seminar']));
            $tempat_seminar = trim(strtoupper($post['tempat_seminar']));
            $kuota_seminar = trim(strtoupper($post['kuota_seminar']));
            $sisa_kuota = trim(strtoupper($post['kuota_seminar']));
            $untuk_kelas = $post['kelas_seminar'];
            foreach ($untuk_kelas as $key => $value) {
                $untuk_kelas .= $value . ',';
            }
            $untuk_kelas = rtrim(trim($untuk_kelas, "Array"), ",");

            $semester_seminar = $post['semester_seminar'];
            foreach ($semester_seminar as $key => $value) {
                $semester_seminar .= $value . ',';
            }
            $arr_semester_seminar = explode(",", $semester_seminar);
            if (in_array('Arrayall', $arr_semester_seminar)) {
                $semester_seminar = 'all';
            } else {
                $semester_seminar = rtrim(trim($semester_seminar, "Array"), ",");
            }

            if (isset($id)) {
                $data_seminar = array(
                    'tema_seminar' => $tema_seminar,
                    'jadwal_seminar' => $jadwal_seminar,
                    'pembicara_seminar' => $pembicara_seminar,
                    'tempat_seminar' => $tempat_seminar,
                    'untuk_kelas' => $untuk_kelas,
                    'semester_seminar' => $semester_seminar,
                    //'jurusan_seminar'         => $jurusan_seminar,
                    'update_date_seminar' => date('Y-m-d H:i:s')
                );

                if (!empty($_FILES['poster_seminar']['name'])) {
                    $filename_poster = $this->upload_image_poster($_FILES['poster_seminar']);
                    $poster_seminar = base_url('/assets/uploads/poster_seminar/display/250/400/' . $filename_poster);
                    $data_seminar = array_merge($data_seminar, array('poster_seminar' => $poster_seminar));
                }
                //echo '<pre>',print_r($data_seminar);die();
            } else {
                $data_seminar = array(
                    'tema_seminar' => $tema_seminar,
                    'jadwal_seminar' => $jadwal_seminar,
                    'pembicara_seminar' => $pembicara_seminar,
                    'tempat_seminar' => $tempat_seminar,
                    'kuota_seminar' => $kuota_seminar,
                    'sisa_kuota' => $kuota_seminar,
                    'untuk_kelas' => $untuk_kelas,
                    'semester_seminar' => $semester_seminar,
                    //'jurusan_seminar' 		=> $jurusan_seminar,
                    'poster_seminar' => $poster_seminar,
                    'sertifikat_seminar' => $sertifikat_seminar,
                    'create_date_seminar' => date('Y-m-d H:i:s')
                );
                $poster_seminar = base_url('/assets/uploads/noimage.png');
                if (!empty($_FILES['poster_seminar']['name'])) {
                    $filename_poster = $this->upload_image_poster($_FILES['poster_seminar']);
                    $poster_seminar = base_url('/assets/uploads/poster_seminar/display/250/400/' . $filename_poster);
                    $data_seminar = array_merge($data_seminar, array('poster_seminar' => $poster_seminar));
                }
                //echo '<pre>',print_r($data_seminar);die();
            }
            if (isset($id)) {
                $key = array('id_seminar' => $id);
                $res = $this->m_seminar->UpdateSeminar('seminar', $data_seminar, $key);
            } else {
                $res = $this->m_seminar->InsertSeminar('seminar', $data_seminar);
                $seminar_id = $this->db->insert_id();
                //echo $seminar_id;die();
                // Generate TIcket (Ticket manual)
                $this->m_seminar->manual_ticket($seminar_id, $kuota_seminar, $this->input->post());
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
    }

    public function do_delete($id = '') {
        $id = $this->input->post('id');
        $data = array('status_seminar' => 2);
        $where = array('id_seminar' => $id);

        $delete_seminar = $this->m_seminar->UpdateSeminar('seminar', $data, $where);
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
        $id = $this->input->post('id');
        $chk = $this->input->post('chk');
        $status = "";

        switch ($chk) {
            case 1 :
                $this->general_model->updateData('order', array('used_sertifikat' => $chk), array('id_order' => $id));
                $status = "success";
                break;

            case 0 :
                $this->general_model->updateData('order', array('used_sertifikat' => $chk), array('id_order' => $id));
                $status = "failed";
                break;
        }
        echo json_encode(array('status' => $status));
    }

    function print_pesertaSeminar($id_seminar = '') {
        @set_time_limit(0);
        ob_clean();


        $data_peserta = $this->m_seminar->list_Peserta($id_seminar);
        //echo '<pre>',print_r($data_peserta);die();
        //echo $this->db->last_query();
        //echo '<pre>',print_r($data_Point);die();
        //name the worksheet
        //echo $data_peserta[0]['tema_seminar'];die();
        $nama_seminar = $data_peserta[0]['tema_seminar'];
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

        /* $this->excel->getActiveSheet()->setCellValue('A3', 'Start Date : '.$from_date);
          //$this->excel->getActiveSheet()->getStyle("A3")->getFont()->setSize(12);
          $this->excel->getActiveSheet()->mergeCells('A3:C3');
          $this->excel->getActiveSheet()->getStyle('A3:C3')->getFont()->setBold(true);

          $this->excel->getActiveSheet()->setCellValue('A4', 'End Date : '.$to_date);
          //$this->excel->getActiveSheet()->getStyle("A4")->getFont()->setSize(12);
          $this->excel->getActiveSheet()->mergeCells('A4:C4');
          $this->excel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true); */


        $this->excel->setActiveSheetIndex(0);



        // Field names in the first row
        // set cell A1 content with some text
        $fields = array('No', 'NIM', 'Nama Mahasiswa', 'No Ticket', 'Tema Seminar', 'Keterangan');

        $col = 0;
        foreach ($fields as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 6, $field);
            $col++;
        }

        // Fetching the table data
        /* $dataReportClaimed  = $this->report_model->report_claimed($tanggalClaimed); */
        //echo '<pre>',print_r($dataReportClaimed->result());
        $row = 7;
        $no = 1;
        $noCol = 0;
        foreach ($data_peserta as $data) {
            //echo $data['nim_mahasiswa'];die();
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($noCol, $row, $no);
            $arrItem = array('nim_mahasiswa', 'nama_depan', 'serial', 'tema_seminar');

            $col = 1;
            foreach ($arrItem as $field) {
                /* if($field == 'value'){
                  $data->$field = str_replace('.',',',$data->$field);
                  } */
                /* if ($field == 'status_req') {
                  $data->$field = $data->$field.' by '.$data->username_admin ;
                  } */
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data[$field]);
                $col++;
            }
            //make border
            $this->excel->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->applyFromArray($styleArray);
            $no++;
            $row++;
        }
        //make auto size        
        for ($col = 'A'; $col !== 'L'; $col++) {
            $this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }
        //make border
        $this->excel->getActiveSheet()->getStyle('A6:F6')->applyFromArray($styleArray);

        //change the font size
        $this->excel->getActiveSheet()->getStyle()->getFont()->setSize(10);

        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1:F3')->getFont()->setBold(true);

        //merge cell
        $this->excel->getActiveSheet()->mergeCells('A1:F1');

        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1:F3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $this->excel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $filename = "peserta-seminar-" . $data_peserta[0]['tema_seminar'] . ".xls";
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

}

?>
