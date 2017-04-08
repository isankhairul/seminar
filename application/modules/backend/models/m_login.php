<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {
	public function GetMahasiswa(){
		$data = $this->db->query('select * from mahasiswa');
		return $data->result_array();
		
		
	}
	
	function select_user($username, $password){
		$this->db->where('u.username_user',$username);
		$this->db->where('u.password',$password);
		$this->db->from('user u');

		$query = $this->db->get();
		if($query){
			return $query->result_array();
		}else{
			return false ;
		}
	}
	
	function do_login($username, $password) {
        $this->db->select('*');
        $this->db->where('username_user', $username);
        $this->db->where('password', encryptPass($password));
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $item) {
                $cms['id_user']      	= $item->id_user;
                $cms['username_user']	= $item->username_user;
		$cms['email_user']    	= $item->email_user;
                $cms['web']    		= 'CMS-seminar' ;
            }
            //$sess_array = array('admin' => $username, 'id' => $id, 'password' => $password, 'web' => 'MG');
            $this->session->set_userdata('CMS_logged_in', $cms);
        }
    }
	
	function check_user($user) {
	    $this->db->select('*');
	    $this->db->where('username_user', $user);
	    $query = $this->db->get('user');
	    if ($query->num_rows() > 0) {
		return TRUE;
	    }else{
		return FALSE;
	    }
	}
	function check_password($user, $password) {
		$this->db->select('*');
		$this->db->where('username_user', $user);
		$this->db->where('password', encryptPass($password));
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
		    return TRUE;
		}else{
		    return FALSE;
		}
	    }
	public function InsertData($tabelName,$data){
			$res = $this->db->insert($tabelName,$data);	
			return $res;
	}
	public function UpdateData($tabelName,$data,$where){
			$res = $this->db->update($tabelName,$data,$where);	
			return $res;
				
	}
	
	public function DeleteData($tabelName,$where){
			$res = $this->db->delete($tabelName,$where);	
			return $res;
			
	}
}

