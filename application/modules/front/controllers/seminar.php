<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seminar extends MY_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model(array('m_seminar'));
	
    }
    
    
    public function index(){
        /*$today = date('Y-m-d H:i:s');
    	$data['seminar'] = $this->m_seminar->getDataSeminar('seminar', array('status_seminar' => 1, 'DATE_FORMAT(jadwal_seminar, "%Y-%m-%d %H:%i:%s") >=' => $today), 'jadwal_seminar desc');
	   	$this->frview('v_allSeminar',$data);*/
    }

    public function submit_order(){
    	$id_seminar		= $this->input->post('id_seminar');
    	$id_mahasiswa	= $this->input->post('id_mhs');
        //check ketentuan ticket

        $detail_seminar     = $this->m_seminar->getDetData('seminar',array('id_seminar' => $id_seminar));
        //echo '<pre>',print_r($detail_seminar);die();
        $detail_mahasiswa   = $this->m_seminar->getDetData('mahasiswa',array('id_mahasiswa' => $id_mahasiswa));



        /*$tahun_masuk    = $detail_mahasiswa->tahun_masuk ;
        $now            = date('Y');
        $bulan          = date('m');
        $intervalThn    = $now - $tahun_masuk + 1;

        if($detail_mahasiswa->semester_mahasiswa == 'ganjil'){
            if(($bulan) <= 6){
                $intervalThn = ($intervalThn * 2 ) - 1;
            }else{
                $intervalThn = ($intervalThn * 2 );
            }                                       
        }else{
            if(($bulan) <= 6){
                $intervalThn = ($intervalThn * 2 ) - 2;
            }else{
                $intervalThn = ($intervalThn * 2 ) - 1;
            }
        }*/

        $tahun_masuk    = $detail_mahasiswa->tahun_masuk ;
        $now            = date('Y');
        $bulan          = date('m');
        $intervalThn    = $now - $tahun_masuk;

        if($detail_mahasiswa->semester_mahasiswa == 'ganjil'){
            if(($bulan) <= 6){
                $intervalThn = ($intervalThn * 2 );
            }else{
                $intervalThn = ($intervalThn * 2 ) + 1;
            }                                       
        }else{
            if(($bulan) <= 6){
                $intervalThn = ($intervalThn * 2 ) - 1;
            }else{
                $intervalThn = ($intervalThn * 2 );
            }
        }

        
        // check mahasiswa daftar seminar;
        $checkOrderSeminar = $this->m_seminar->getDetData('order', array('id_mahasiswa' => $id_mahasiswa, 'id_seminar' => $id_seminar));
        $arr_seminar = explode(",", $detail_seminar->semester_seminar);
        if($detail_seminar->sisa_kuota > 0){
            if($checkOrderSeminar){
            echo json_encode(array('status' => 'error', 'alert' => 'Maaf , anda sudah pernah mengikuti seminar berikut'));
        }else{
            switch ($detail_seminar->untuk_kelas) {
                case '1' :
                    if ($detail_mahasiswa->tipe_mahasiswa == $detail_seminar->untuk_kelas && in_array($intervalThn, $arr_seminar)) {
                        $id_ticket = $this->m_seminar->getDataKey('ticket_manual', array('id_seminar' => $id_seminar, 'consume' => 0), 'id_ticket asc', 1);

                        if($id_ticket){
                            $data = array(
                                    'id_seminar'    => $id_seminar,
                                    'id_mahasiswa'  => $id_mahasiswa,
                                    'id_ticket'     => $id_ticket[0]['id_ticket'],
                                    'create_date'   => date("Y-m-d H:i:s")

                                );

                            if($this->m_seminar->insertData("order", $data)){

                                $this->m_seminar->updateData("ticket_manual", array("consume" => 1), array('id_ticket' => $id_ticket[0]['id_ticket']));
                                $this->m_seminar->updateData("seminar", array("sisa_kuota" => ($detail_seminar->sisa_kuota - 1)), array('id_seminar' => $id_seminar));
                                echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
                            }
                            
                        
                        }else{

                            echo json_encode(array('status' => 'error', 'alert' => 'Maaf ada kesalahan, silahkan check ke bagian IT'));   

                        }
                    }else if($detail_seminar->semester_seminar == 'all'  && $detail_mahasiswa->tipe_mahasiswa == 1){
                        $id_ticket = $this->m_seminar->getDataKey('ticket_manual', array('id_seminar' => $id_seminar, 'consume' => 0), 'id_ticket asc', 1);

                        if($id_ticket){
                            $data = array(
                                    'id_seminar'    => $id_seminar,
                                    'id_mahasiswa'  => $id_mahasiswa,
                                    'id_ticket'     => $id_ticket[0]['id_ticket'],
                                    'create_date'   => date("Y-m-d H:i:s")

                                );

                            if($this->m_seminar->insertData("order", $data)){

                                $this->m_seminar->updateData("ticket_manual", array("consume" => 1), array('id_ticket' => $id_ticket[0]['id_ticket']));
                                $this->m_seminar->updateData("seminar", array("sisa_kuota" => ($detail_seminar->sisa_kuota - 1)), array('id_seminar' => $id_seminar));
                                echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
                            }
                            
                        
                        }else{

                            echo json_encode(array('status' => 'error', 'alert' => 'Maaf ada kesalahan, silahkan check ke bagian IT'));   

                        }
                    }else{
                        if($detail_seminar->untuk_kelas == 1){
                            $kelas = 'Reguler' ;
                        }/*else{
                            $kelas = 'Paralel' ;
                        }*/
                        echo json_encode(array('status' => 'error', 'alert' => 'Maaf seminar untuk semester '.$detail_seminar->semester_seminar. ' dan kelas '. $kelas));   
                    }
                break;
                
                case '2' :
                    if ($detail_mahasiswa->tipe_mahasiswa == $detail_seminar->untuk_kelas && in_array($intervalThn, $arr_seminar)) {
                        $id_ticket = $this->m_seminar->getDataKey('ticket_manual', array('id_seminar' => $id_seminar, 'consume' => 0), 'id_ticket asc', 1);

                        if($id_ticket){
                            $data = array(
                                    'id_seminar'    => $id_seminar,
                                    'id_mahasiswa'  => $id_mahasiswa,
                                    'id_ticket'     => $id_ticket[0]['id_ticket'],
                                    'create_date'   => date("Y-m-d H:i:s")

                                );

                            if($this->m_seminar->insertData("order", $data)){

                                $this->m_seminar->updateData("ticket_manual", array("consume" => 1), array('id_ticket' => $id_ticket[0]['id_ticket']));
                                $this->m_seminar->updateData("seminar", array("sisa_kuota" => ($detail_seminar->sisa_kuota - 1)), array('id_seminar' => $id_seminar));
                                echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
                            }
                            
                        
                        }else{

                            echo json_encode(array('status' => 'error', 'alert' => 'Maaf ada kesalahan, silahkan check ke bagian IT'));   

                        }
                    }else if($detail_seminar->semester_seminar == 'all' && $detail_mahasiswa->tipe_mahasiswa == 2){
                        $id_ticket = $this->m_seminar->getDataKey('ticket_manual', array('id_seminar' => $id_seminar, 'consume' => 0), 'id_ticket asc', 1);

                        if($id_ticket){
                            $data = array(
                                    'id_seminar'    => $id_seminar,
                                    'id_mahasiswa'  => $id_mahasiswa,
                                    'id_ticket'     => $id_ticket[0]['id_ticket'],
                                    'create_date'   => date("Y-m-d H:i:s")

                                );

                            if($this->m_seminar->insertData("order", $data)){

                                $this->m_seminar->updateData("ticket_manual", array("consume" => 1), array('id_ticket' => $id_ticket[0]['id_ticket']));
                                $this->m_seminar->updateData("seminar", array("sisa_kuota" => ($detail_seminar->sisa_kuota - 1)), array('id_seminar' => $id_seminar));
                                echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
                            }
                            
                        
                        }else{
                            echo json_encode(array('status' => 'error', 'alert' => 'Maaf ada kesalahan, silahkan check ke bagian IT'));   
                        }
                    }else{
                        if($detail_seminar->untuk_kelas == 2){
                            $kelas = 'Paralel' ;
                        }/*else{
                            $kelas = 'Reguler' ;
                        }*/
                        echo json_encode(array('status' => 'error', 'alert' => 'Maaf seminar untuk semester '.$detail_seminar->semester_seminar. ' dan kelas '. $kelas));   
                    }

                break;

                default:
                    if (in_array($intervalThn, $arr_seminar)) {
                        $id_ticket = $this->m_seminar->getDataKey('ticket_manual', array('id_seminar' => $id_seminar, 'consume' => 0), 'id_ticket asc', 1);

                        if($id_ticket){
                            $data = array(
                                    'id_seminar'    => $id_seminar,
                                    'id_mahasiswa'  => $id_mahasiswa,
                                    'id_ticket'     => $id_ticket[0]['id_ticket'],
                                    'create_date'   => date("Y-m-d H:i:s")

                                );

                            if($this->m_seminar->insertData("order", $data)){

                                $this->m_seminar->updateData("ticket_manual", array("consume" => 1), array('id_ticket' => $id_ticket[0]['id_ticket']));
                                $this->m_seminar->updateData("seminar", array("sisa_kuota" => ($detail_seminar->sisa_kuota - 1)), array('id_seminar' => $id_seminar));
                                echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
                            }
                            
                        
                        }else{

                            echo json_encode(array('status' => 'error', 'alert' => 'Maaf ada kesalahan, silahkan check ke bagian IT'));   

                        }
                    }else if($detail_seminar->semester_seminar == 'all'){
                        $id_ticket = $this->m_seminar->getDataKey('ticket_manual', array('id_seminar' => $id_seminar, 'consume' => 0), 'id_ticket asc', 1);

                        if($id_ticket){
                            $data = array(
                                    'id_seminar'    => $id_seminar,
                                    'id_mahasiswa'  => $id_mahasiswa,
                                    'id_ticket'     => $id_ticket[0]['id_ticket'],
                                    'create_date'   => date("Y-m-d H:i:s")

                                );

                            if($this->m_seminar->insertData("order", $data)){

                                $this->m_seminar->updateData("ticket_manual", array("consume" => 1), array('id_ticket' => $id_ticket[0]['id_ticket']));
                                $this->m_seminar->updateData("seminar", array("sisa_kuota" => ($detail_seminar->sisa_kuota - 1)), array('id_seminar' => $id_seminar));
                                echo json_encode(array('status' => 'success', 'location' => base_url(), $data));
                            }
                            
                        
                        }else{
                            echo json_encode(array('status' => 'error', 'alert' => 'Maaf ada kesalahan, silahkan check ke bagian IT'));   
                        }
                    }else{
                        if($detail_seminar->untuk_kelas == 2){
                            $kelas = 'paralel' ;
                        }else if($detail_seminar->untuk_kelas == 1){
                            $kelas = 'Reguler' ;
                        }else{
                            $kelas = 'Reguler dan Paralel' ;
                        }
                        echo json_encode(array('status' => 'error', 'alert' => 'Maaf seminar untuk semester '.$detail_seminar->semester_seminar. ' dan kelas '. $kelas));   
        
                    }
            }
        }
    }else{
        echo json_encode(array('status' => 'error', 'alert' => 'maaf kuota seminar sudah habis'));   
    }
        

            	
    	
    }
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */