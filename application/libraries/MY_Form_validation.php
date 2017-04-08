<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {
		function __construct() {
			parent::__construct() ;
		}

		function run( $module = '' , $group = '' ) {
			(is_object($module)) AND $this->CI = &$module ;
			return parent::run( $group ) ;
		}

		function format_date( $str_date ) {
			if ( preg_match('/^\d{4}-\d{2}-\d{2}$/i' , $str_date) ) {
				$arr_date = date_parse( $str_date ) ;
				if ( checkdate( $arr_date['month'], $arr_date['day'], $arr_date['year'] ) ) {
					return true ;
				} else {
					$this->set_message('format_date' , 'Date %s salah') ;
					return false ;
				}
			} else {
				$this->set_message('format_date' , 'Format Date %s salah') ;
				return false ;
			}
		}

		function valid_paxname( $paxname ) {
			if ( preg_match('/^[A-Za-z\s]+$/' , $paxname) ) {
				return true ;
			} else {
				$this->set_message('valid_paxname' , '%s harus alphabet') ;
				return false ;
			}
		}

		function valid_phone( $phone ) {
			//if ( preg_match('/^[\d\+\s\(\)]+$/' , $phone) ) {
			if ( preg_match('/^\d+$/' , $phone) ) {
				return true ;
			} else {
				$this->set_message('valid_phone' , 'Format Telepon salah') ;
				return false ;
			}
		}

		function infant_month_diff( $str_date ) {
			if ( $str_date >= date('Y-m-d' , strtotime('-1 day')) ) {
				$this->set_message('infant_month_diff' , 'Umur bayi harus lebih dari 1 hari') ;
			} else if ( month_diff( $str_date , date() ) > 23 ) {
				$this->set_message('infant_month_diff' , 'Umur Bayi harus dibawah 2 tahun') ;
				return false ;
			}

			return true ;
		}
		
}
?>