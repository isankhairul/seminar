<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seminar extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_seminar'));
    }

    public function index() {
        /* $today = date('Y-m-d H:i:s');
          $data['seminar'] = $this->m_seminar->getDataSeminar('seminar', array('status_seminar' => 1, 'DATE_FORMAT(jadwal_seminar, "%Y-%m-%d %H:%i:%s") >=' => $today), 'jadwal_seminar desc');
          $this->frview('v_allSeminar',$data); */
    }

    

    public function submit_order() {

        $post = $this->input->post();
        $seminar_id = $post['seminar_id'];
        $email_member = $post['email_member'];

        $detail_seminar = $this->m_seminar->getDetData('seminar', array('seminar_id' => $seminar_id));
        $detail_member = $this->m_seminar->getDetData('member', array('email' => $email_member));
        $member_id = $detail_member->member_id;
        
        $serial = $this->m_seminar->generate_serial_order($seminar_id);
        
//        echo '<pre>';
//        print_r($detail_seminar);
//        die('');

        // check member daftar seminar;
        $check_order_seminar = $this->m_seminar->getDetData('seminar_order', array('member_id' => $member_id, 'seminar_id' => $seminar_id));
        if ($check_order_seminar) {
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf , anda sudah pernah mengikuti seminar ini.'));
            return false;
        }

        if ($detail_seminar->sisa_kuota <= 0) {
            echo json_encode(array('status' => 'error', 'alert' => 'maaf kuota seminar sudah habis'));
            return false;
        }
        
        $data['seminar_order'] = array('seminar_id' => $seminar_id,
            'member_id' => $detail_member->member_id,
            'serial' => $serial,
            'created_date' => date("Y-m-d H:i:s")
        );
        
        $insert_seminar_order = $this->m_seminar->insertData("seminar_order", $data['seminar_order']);
        
        if(!$insert_seminar_order){
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf ada kesalahan, silahkan check ke bagian IT'));
            return false;
        }
        
        $sisa_kuota = ($detail_seminar->sisa_kuota - 1);
        $this->m_seminar->updateData("seminar", array("sisa_kuota" => $sisa_kuota), array('seminar_id' => $seminar_id));
        echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
        
    }

}

/* End of file users.php */
    /* Location: ./application/modules/users/controllers/users.php */    