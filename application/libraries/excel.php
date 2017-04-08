<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel/Classes/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
    } 

    function setValueHorizontal($array, $num, $startAbj){
    
        $arrAbc     = array();
        $countField = count($array);
        
        for($alpha = $startAbj; $alpha < ($startAbj + $countField); $alpha++) {
            array_push($arrAbc, chr($alpha).$num);
        }

        return $arrAbc;
    }
}