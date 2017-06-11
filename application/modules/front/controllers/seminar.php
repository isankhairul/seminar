<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seminar extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_seminar'));
    }

    public function submit_order() {

        $post = $this->input->post();
        $seminar_id = $post['seminar_id'];
        $email_member = $post['email_member'];

        $detail_seminar = $this->m_seminar->getDetData('seminar', array('seminar_id' => $seminar_id));
        $detail_member = $this->m_seminar->getDetData('member', array('email' => $email_member));
        $member_id = $detail_member->member_id;
        
        $serial = $this->m_seminar->generate_serial_order($seminar_id);
        
        if(empty($seminar_id) || empty($email_member)){
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf, email dan seminar_id harus diisi.'));
            return false;
        }
        
        if(empty($member_id)){
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf, email yang diinput tidak terdaftar.'));
            return false;
        }
        
        if($detail_member->status != 1){
            echo json_encode(array('status' => 'error', 'alert' => 'Silakan konfirmasi akun anda melalui email.'));
            return false;
        }

        // check member daftar seminar;
        $check_order_seminar = $this->m_seminar->getDetData('seminar_order', array('member_id' => $member_id, 'seminar_id' => $seminar_id));
        
        $diff_time = time() - strtotime($detail_seminar->jadwal);
        if ($diff_time > 0) {
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf, seminar tidak bisa diorder karena tidak aktif.'));
            return false;
        }
        
        if ($detail_seminar->status == 0) {
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf, seminar tidak bisa diorder karena tidak aktif.'));
            return false;
        }
        
        if ($check_order_seminar) {
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf, anda sudah pernah mengikuti seminar ini.'));
            return false;
        }
        
        if ($detail_seminar->sisa_kuota <= 0) {
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf, kuota seminar sudah habis.'));
            return false;
        }
        
        $data['seminar_order'] = array('seminar_id' => $seminar_id,
            'member_id' => $detail_member->member_id,
            'serial' => $serial,
            'created_date' => date("Y-m-d H:i:s")
        );
        
        $insert_seminar_order = $this->m_seminar->insertData("seminar_order", $data['seminar_order']);
        
        if(!$insert_seminar_order){
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf, ada kesalahan, silahkan check ke bagian IT.'));
            return false;
        }
        
        $sisa_kuota = ($detail_seminar->sisa_kuota - 1);
        $this->m_seminar->updateData("seminar", array("sisa_kuota" => $sisa_kuota), array('seminar_id' => $seminar_id));
        echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
        
    }
    
    public function cetak_ticket($order_id = '') {
        $data['ticket_seminar'] = array();
        $data['ticket_seminar'] = $this->m_seminar->ticket_seminar($order_id);
        $this->load->library('Barcode39');
        $bc = new Barcode39($data['ticket_seminar']->serial);
        $bc->draw(trim($data['ticket_seminar']->serial . ".gif"));
        include_once APPPATH . '/third_party/mpdf/mpdf.php';
        $html = $this->load->view('ticket', $data, true);
        $this->mpdf = new mPDF('utf-8', array(250, 100));
        $file_name = $data['ticket_seminar']->tema . '-' . $data['ticket_seminar']->email;

        $stylesheet = file_get_contents(base_url('assets/frontend/css/print_ticket.css')); // external css
        $this->mpdf->WriteHTML($stylesheet, 1);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($file_name . '.pdf', 'D'); // download force
        $this->mpdf->Output($file_name . '.pdf', 'I'); // view in the explorer
    }

}

/* End of file users.php */
    /* Location: ./application/modules/users/controllers/users.php */    