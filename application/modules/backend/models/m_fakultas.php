<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_fakultas extends CI_Model {
    
    function check_fakultas($fakultas, $status_fak = '') {
	$this->db->select('*');
	$this->db->where('nama_fakultas', $fakultas);
	if(!empty($status_fak)){
		$this->db->where('status_fakultas', $status_fak);
	}
	$query = $this->db->get('fakultas');
	if ($query->num_rows() > 0) {
	    return TRUE;
	}else{
	    return FALSE;
	}
    }
    
    public function InsertFakultas($tabelName,$data){
	$res = $this->db->insert($tabelName,$data);	
	return $res;    
    }
    
    function list_dataFakultas($limit, $start){
	$this->db->limit($limit , $start);
	$list = $this->db->get('fakultas');
	if($list->num_rows() > 0){
		return $list->result_array();
	}else{
		return array() ;
	}
    }
    
    function detailFakultas($idFakultas){
	$this->db->where('id_fakultas', $idFakultas); 
	$query = $this->db->get('fakultas');
	if($query->num_rows() > 0){
		return $query->row();
	}else{
		return false ;
	}
    }
    
    public function UpdateFakultas($tabelName,$data,$where){
	$res = $this->db->update($tabelName,$data,$where);	
	return $res;			    
    }
    function deleteData($table,$key){
	$query = $this->db->delete($table,$key);
	if($query){
	    return true ;
	}else
	    return false ;
    }
	
	
}	

?>