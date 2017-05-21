<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_report extends MY_Controller {
    protected $sessionData; 
    function __construct(){
	parent::__construct();
	$this->load->model(array('m_report'));
    $this->load->library('excel');
	$this->sessionData = $this->session->userdata('CMS_logged_in');
	if(!$this->sessionData){
	    redirect('backend/c_login');
	}

	$this->arr_dimension_poster = array();
        $this->arr_dimension_poster['display']['width'] = 250;
        $this->arr_dimension_poster['display']['height'] = 400; 

        $this->arr_dimension_sertifikat = array();
        $this->arr_dimension_sertifikat['display']['width'] = 400;
        $this->arr_dimension_sertifikat['display']['height'] = 150;
    }
	
    public function index(){
        //pagination settings
        $session_searchReport = $this->session->userdata('pencarian_report');
        if(isset($session_searchReport)){
            $this->session->unset_userdata('pencarian_report');
        }
        $data['report_seminar']   = array();
        $this->doview('v_report_seminar', $data);
    }
    
    function show_report(){
        //echo '<pre>',print_r($this->input->post());die();
        if($this->input->post()){
            $post_periode   = $this->input->post('periode_report');
            $show_report    = $this->input->post('show_report');
            $print_report   = $this->input->post('print_report');
            
            if(!empty($post_periode)){

                $periode    = $this->input->post('periode_report');
                $getDate    = explode(" - ", $periode);
                $startDate  = $getDate[0];
                $endDate    = $getDate[1];
                
                //echo '<pre>',print_r(date('Ymd', strtotime($getDate[0])));die();
                
                $data['report_seminar'] = array();
                $data['report_seminar'] = $this->m_report->report_seminar($startDate, $endDate);

                if(!empty($post_periode)){
                    $search_report = $this->input->post('periode_report');
                    $this->session->set_userdata('pencarian_report', $search_report);
                }
                else
                {
                    $search_report = $this->session->userdata('pencarian_report');
                }


                if(!empty($show_report) && isset($show_report)){
                    $this->doview('v_report_seminar', $data);
                }else if(!empty($print_report) && isset($print_report)){
                    @set_time_limit(0);
                    ob_clean();
                    
                    $this->excel->getActiveSheet()->setTitle('List Report Seminar');
                
                    $styleArray = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
                    );

                    $this->excel->getActiveSheet()->setCellValue('A1', 'List Report Seminar');
                    $this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);

                    $this->excel->getActiveSheet()->setCellValue('A3', 'Start Date : '.$startDate);
                    $this->excel->getActiveSheet()->mergeCells('A3:C3');
                    $this->excel->getActiveSheet()->getStyle('A3:C3')->getFont()->setBold(true);
                    
                    $this->excel->getActiveSheet()->setCellValue('A4', 'End Date : '.$endDate);
                    $this->excel->getActiveSheet()->mergeCells('A4:C4');
                    $this->excel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);
                    
                    $this->excel->setActiveSheetIndex(0);
                    
                    $fields = array('No', 'Tema Seminar', 'Jadwal Seminar', 'Jumlah Peserta Seminar');
                    
                    $col = 0;
                    foreach ($fields as $field)
                    {
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 6, $field);
                        $col++;
                    }
                    
                    // Fetching the table data
                    /*$dataReportClaimed  = $this->report_model->report_claimed($tanggalClaimed);*/
                    //echo '<pre>',print_r($dataReportClaimed->result());
                    $row = 7;
                    $no = 1 ;
                    $noCol = 0 ;
                    foreach($data['report_seminar'] as $data)
                    {
                        //echo $data['nim_mahasiswa'];die();
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($noCol, $row, $no); 
                        $arrItem = array('tema', 'jadwal', 'total');
                        
                        $col = 1;
                        foreach ($arrItem as $field)
                        {
                            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data[$field]);               
                            $col++;
                        }
                        //make border
                        $this->excel->getActiveSheet()->getStyle('A'.$row.':D'.$row)->applyFromArray($styleArray);
                        $no++;
                        $row++;
                        
                    }
                    //make auto size        
                    for($col = 'A'; $col !== 'L'; $col++) {
                        $this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
                    }
                    //make border
                    $this->excel->getActiveSheet()->getStyle('A6:D6')->applyFromArray($styleArray);
                    
                    //change the font size
                    $this->excel->getActiveSheet()->getStyle()->getFont()->setSize(10);
                    
                    //make the font become bold
                    $this->excel->getActiveSheet()->getStyle('A1:D3')->getFont()->setBold(true);
                    
                    //merge cell
                    $this->excel->getActiveSheet()->mergeCells('A1:D1');
                    
                    //set aligment to center for that merged cell 
                    $this->excel->getActiveSheet()->getStyle('A1:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('A1:D3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                    $this->excel->getActiveSheet()->getStyle('A3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $this->excel->getActiveSheet()->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    
                    $this->excel->setActiveSheetIndex(0);
                    
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                    $filename = "ReportSeminar-" . date('Ymd', strtotime($getDate[0])) . '-'. date('Ymd', strtotime($getDate[1])) . ".xls" ;
                    // Sending headers to force the user to download the file
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename='.$filename);
                    header('Cache-Control: max-age=0');
             
                    $objWriter->save('php://output');
                }
            }else{
                $this->session->set_flashdata('info_Report', 'Mohon Masukkan tanggal');
                redirect('report'); 
            }
            
        }
        
    }

    function print_pesertaSeminar($id_seminar = ''){
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

        /*$this->excel->getActiveSheet()->setCellValue('A3', 'Start Date : '.$from_date);
        //$this->excel->getActiveSheet()->getStyle("A3")->getFont()->setSize(12);
        $this->excel->getActiveSheet()->mergeCells('A3:C3');
        $this->excel->getActiveSheet()->getStyle('A3:C3')->getFont()->setBold(true);
        
        $this->excel->getActiveSheet()->setCellValue('A4', 'End Date : '.$to_date);
        //$this->excel->getActiveSheet()->getStyle("A4")->getFont()->setSize(12);
        $this->excel->getActiveSheet()->mergeCells('A4:C4');
        $this->excel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);*/

        
        $this->excel->setActiveSheetIndex(0);
        
        
        
        // Field names in the first row
        // set cell A1 content with some text
        $fields = array('No', 'NIM', 'Nama Mahasiswa', 'No Ticket', 'Tema Seminar', 'Keterangan');
        
        $col = 0;
        foreach ($fields as $field)
        {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 6, $field);
            $col++;
        }
        
        // Fetching the table data
        /*$dataReportClaimed  = $this->report_model->report_claimed($tanggalClaimed);*/
        //echo '<pre>',print_r($dataReportClaimed->result());
        $row = 7;
        $no = 1 ;
        $noCol = 0 ;
        foreach($data_peserta as $data)
        {
            //echo $data['nim_mahasiswa'];die();
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($noCol, $row, $no); 
            $arrItem = array('nim_mahasiswa', 'nama_depan', 'serial', 'tema_seminar');
            
            $col = 1;
            foreach ($arrItem as $field)
            {
                /*if($field == 'value'){
                    $data->$field = str_replace('.',',',$data->$field);
                }*/
                /*if ($field == 'status_req') {
                    $data->$field = $data->$field.' by '.$data->username_admin ;
                }*/
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data[$field]);               
                $col++;
            }
            //make border
            $this->excel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($styleArray);
            $no++;
            $row++;
            
        }
        //make auto size        
        for($col = 'A'; $col !== 'L'; $col++) {
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
        $filename = "peserta-seminar-".$data_peserta[0]['tema_seminar'].".xls" ;
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
    }

}
?>
