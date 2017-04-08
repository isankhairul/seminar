<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_seminar extends CI_Model {

	function getDataSeminar($table, $where, $order_by = "", $like, $start = '', $limit = ''){

		$this->db->where($where);
        $this->db->like("tema_seminar", $like);
        if($order_by){
            $this->db->order_by($order_by); 
        } 
        if(is_numeric($limit)){
            $this->db->limit($start, $limit);    
        }
        
        $query = $this->db->get($table); 
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getDataKey($table, $where, $order_by = '', $limit = ''){

        $this->db->where($where);
        if($order_by){
            $this->db->order_by($order_by); 
        }
        ($limit) ? $this->db->limit($limit) : "";
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
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
            return true ;
        }else{
            return false ;
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

}	

?>