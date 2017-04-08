<?php

class general_model extends CI_Model {

    function __construct() {
        
    }

    function updateData($table,$data,$key){

        $query = $this->db->update($table,$data,$key);

        if($query){
            return true ;
        }else{
        	return false ;
        }
                
    }

    function insertData($table, $data){

    	$query = $this->db->insert($table, $data);

    	if($query){
            return true ;
        }else{
        	return false ;
        }

    }
    function deleteData($table,$key)
    {
	$query = $this->db->delete($table,$key);
	if($query){
	    return true ;
	}else
	    return false ;
    }
    function getUser($table,$id){
	$this->db->where($id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    function getAllData($table){
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    function getDetData($table,$id){
        $this->db->from($table);
        $this->db->where($id);
        $query =  $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }
    
    function CheckDataRow($table,$FieldKey){
        $this->db->from($table);
        $this->db->where($FieldKey);
        $query =  $this->db->get();
        if($query->num_rows() > 0){
            return false ;
        }else{
            return true;
        }
    }
    
    function get_random_page($table,$limit,$field_by,$field_key = ''){
	$this->db->where($field_key);
	$this->db->order_by($field_by, 'RANDOM');
	$this->db->limit($limit);
	$query = $this->db->get($table);
	return $query->result_array();
    }
    
    function sumData($table,$field,$id){
        $this->db->select('count('.$field.') as num');
        $this->db->from($table);
        $this->db->where($id);
        $query =  $this->db->get();

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function generate_kode($format, $table, $field, $order_by){
            
        $get_last_id    = $this->db->query("SELECT ". $field ." FROM ".$table." where ".$field."!='' ORDER BY ".$order_by." DESC LIMIT 1")->row_array();
        $id         = substr($get_last_id[$field], -4) + 1;
        $get_last_date  = substr($get_last_id[$field], 2,7);

        if($format=="MGFS"){

            $kode   = $format.substr("0000".$id, -4);

        }else{

            $kode = "";

        }

        return $kode;

    }
}