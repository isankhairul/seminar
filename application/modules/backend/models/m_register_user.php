<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_register_user extends CI_Model {
    function check_username($user) {
	$this->db->select('*');
	$this->db->where('username_user', $user);
	$query = $this->db->get('user');
	if ($query->num_rows() > 0) {
	    return TRUE;
	}else{
	    return FALSE;
	}
    }
    
    public function InsertRegisterUser($tabelName,$data){
	$res = $this->db->insert($tabelName,$data);	
	return $res;    
    }
    function list_dataRegisterUser($limit, $start){
	$this->db->limit($limit , $start);
	$list = $this->db->get('user');
	if($list->num_rows() > 0){
		return $list->result_array();
	}else{
		return array() ;
	}
    }
    
    function detailRegisterUser($idRegUser){
	$this->db->where('id_user', $idRegUser); 
	$query = $this->db->get('user');
	if($query->num_rows() > 0){
		return $query->row();
	}else{
		return false ;
	}
    }
    
    public function UpdateRegisterUser($tabelName,$data,$where){
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