<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mahasiswa extends CI_Model {
    
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
    
    function list_dataMahasiswa($limit, $start, $search = ''){ 
    $this->db->select('m.*, jf.nama_jurusan, f.nama_fakultas');
    $this->db->from('mahasiswa m');
    $this->db->join('jurusan_fakultas jf', 'm.id_jurusan_fak = jf.id_jurusan_fakultas');
    $this->db->join('fakultas f', 'jf.id_fakultas = f.id_fakultas');
    $this->db->where("m.nim_mahasiswa LIKE '%$search%'");
    $this->db->or_where("m.nama_depan LIKE '%$search%'");
    $this->db->limit($limit , $start);
    $query =  $this->db->get();
	    if ($query->num_rows() > 0) {
	        return $query->result_array();
	    }else{
	        return array();
	    }
    }
    
    function jumlah_dataMahasiswa($search = ''){
    $this->db->select('m.*, jf.nama_jurusan, f.nama_fakultas');
    $this->db->from('mahasiswa m');
    $this->db->join('jurusan_fakultas jf', 'm.id_jurusan_fak = jf.id_jurusan_fakultas');
    $this->db->join('fakultas f', 'jf.id_fakultas = f.id_fakultas');
    $this->db->where("m.nim_mahasiswa LIKE '%$search%'");
    $this->db->or_where("m.nama_depan LIKE '%$search%'");
    $query =  $this->db->get();
	    if ($query->num_rows() > 0) {
	        return $query->num_rows();
	    }else{
	        return false;
	    }
    }

    function getDetailMahasiswa($where){
        $this->db->select('m.*, jf.nama_jurusan, f.nama_fakultas');
        $this->db->from('mahasiswa m');
        $this->db->join('jurusan_fakultas jf', 'm.id_jurusan_fak = jf.id_jurusan_fakultas');
        $this->db->join('fakultas f', 'jf.id_jurusan_fakultas = f.id_fakultas');
        $this->db->where('m.id_mahasiswa', $where);
        $query =  $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
        	return false;
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
    
    public function UpdateData($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);	
		if($res){
            return true ;
        }else{
        	return false ;
        }			    
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