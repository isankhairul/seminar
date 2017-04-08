<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_jurusan_fak extends CI_Model {
    
    function check_jurusan_fakultas($jur_fakultas, $status_jur_fak = '') {
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
    
    public function InsertJurusanFakultas($tabelName,$data){
	$res = $this->db->insert($tabelName,$data);	
	return $res;    
    }
    function list_dataJurusanFakultas($limit, $start){
	    $this->db->select('f.*, jf.*');
	    $this->db->from('fakultas f');
        $this->db->join('jurusan_fakultas jf', 'f.id_fakultas = jf.id_fakultas');
        $this->db->limit($limit , $start);
        $query =  $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
        	return array() ;
        }
    }
    
    function detailJurusanFakultas($idJurusanFakultas){
	$this->db->where('id_jurusan_fakultas', $idJurusanFakultas); 
	$query = $this->db->get('jurusan_fakultas');
	if($query->num_rows() > 0){
		return $query->row();
	}else{
		return false ;
	}
    }
    
    public function UpdateJurusanFakultas($tabelName,$data,$where){
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

	function getAllDataFakultas(){
		$this->db->where('status_fakultas', '1');
        $query = $this->db->get('fakultas');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	
}	

?>