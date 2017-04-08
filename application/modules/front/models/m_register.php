<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_register extends CI_Model {
	function getDataKey($table, $where){
		$this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function getDetailMahasiswa($where){
        $this->db->select('m.*, jf.nama_jurusan, f.nama_fakultas');
        $this->db->from('mahasiswa m');
        $this->db->join('jurusan_fakultas jf', 'm.id_jurusan_fak = jf.id_jurusan_fakultas');
        $this->db->join('fakultas f', 'jf.id_fakultas = f.id_fakultas');
        $this->db->where('m.id_mahasiswa', $where);
        $query =  $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
        	return false;
        }
    }
    function CheckNIM($table, $where){ 
		$this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_To_password($id, $password) {
        $this->db->where('id_mahasiswa', $id);
        $this->db->where('password_mahasiswa',$password);
        $query = $this->db->get('mahasiswa');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
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

    function updateData($table, $data, $where){
        
        $this->db->where($where);
        $query = $this->db->update($table, $data);

        if($query){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }

    function do_login_mahasiswa($nim, $password) { 
        $this->db->select('m.*, jf.nama_jurusan, f.nama_fakultas');
        $this->db->from('mahasiswa m');
        $this->db->join('jurusan_fakultas jf', 'm.id_jurusan_fak = jf.id_jurusan_fakultas');
        $this->db->join('fakultas f', 'jf.id_fakultas = f.id_fakultas');
        $this->db->where('m.nim_mahasiswa', $nim);
        $this->db->where('m.password_mahasiswa', encryptPass($password));
        $query =  $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    function check_nim($nim) {
        $this->db->select('*');
        $this->db->where('nim_mahasiswa', $nim);
        $query = $this->db->get('mahasiswa');
        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function check_password($nim, $password) {
        $this->db->select('*');
        $this->db->where('nim_mahasiswa', $nim);
        $this->db->where('password_mahasiswa', encryptPass($password));
        $query = $this->db->get('mahasiswa');
        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function count_seminar($id_mahasiswa){
        $this->db->select('ord.id_order');
        $this->db->from('order ord');
        $this->db->join('seminar smr', 'ord.id_seminar = smr.id_seminar');
        $this->db->where('ord.id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }else{
            return FALSE;
        }
    }

    function count_sertifikat($id_mahasiswa){
        $this->db->select('ord.id_order');
        $this->db->from('order ord');
        $this->db->join('seminar smr', 'ord.id_seminar = smr.id_seminar');
        $this->db->where('ord.id_mahasiswa', $id_mahasiswa);
        $this->db->where('ord.used_sertifikat', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }else{
            return FALSE;
        }
    }

    function list_seminarMHS($limit, $start , $id_mahasiswa ){
        $this->db->select('ord.*, m.*, smr.*,tk.*');
        $this->db->from('order ord');
        $this->db->join('mahasiswa m', 'ord.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('seminar smr', 'ord.id_seminar = smr.id_seminar');
        $this->db->join('ticket_manual tk', 'ord.id_ticket = tk.id_ticket');
        $this->db->where('m.id_mahasiswa', $id_mahasiswa);
        $this->db->limit($limit , $start);
        $query =  $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return array();
        }
    }

    function list_sertifikatMHS($limit, $start , $id_mahasiswa ){
        $this->db->select('ord.*, m.*, smr.*,tk.*');
        $this->db->from('order ord');
        $this->db->join('mahasiswa m', 'ord.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('seminar smr', 'ord.id_seminar = smr.id_seminar');
        $this->db->join('ticket_manual tk', 'ord.id_ticket = tk.id_ticket');
        $this->db->where('m.id_mahasiswa', $id_mahasiswa);
        $this->db->where('ord.used_sertifikat', 1);
        $this->db->limit($limit , $start);
        $query =  $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return array();
        }
    }

    function ticket_seminar($id_order){
         $this->db->select('ord.*, m.*, smr.*,tk.*');
        $this->db->from('order ord');
        $this->db->join('mahasiswa m', 'ord.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('seminar smr', 'ord.id_seminar = smr.id_seminar');
        $this->db->join('ticket_manual tk', 'ord.id_ticket = tk.id_ticket');
        $this->db->where('ord.id_order', $id_order);
        $query =  $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    function all_seminar($id_mahasiswa){
         $this->db->select('ord.*, m.*, smr.*,tk.*,jrf.nama_jurusan, f.nama_fakultas');
        $this->db->from('order ord');
        $this->db->join('mahasiswa m', 'ord.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('jurusan_fakultas jrf', 'm.id_jurusan_fak = jrf.id_jurusan_fakultas');
        $this->db->join('fakultas f', 'f.id_fakultas = jrf.id_fakultas');
        $this->db->join('seminar smr', 'ord.id_seminar = smr.id_seminar');
        $this->db->join('ticket_manual tk', 'ord.id_ticket = tk.id_ticket');
        $this->db->where('ord.id_mahasiswa', $id_mahasiswa);
        $this->db->where('ord.used_sertifikat', 1);
        $query =  $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return array();
        }
    }
	
}	

?>