<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_member extends CI_Model {

    function list_dataMember($limit, $start, $search = '') {
        $this->db->select('m.*');
        $this->db->from('member m');
        $this->db->where("m.email LIKE '%$search%'");
        $this->db->or_where("m.firstname LIKE '%$search%'");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function jumlah_dataMember($search = '') {
        $this->db->select('m.*');
        $this->db->from('member m');
        $this->db->where("m.email LIKE '%$search%'");
        $this->db->or_where("m.firstname LIKE '%$search%'");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function getDetailMember($where) {
        $this->db->select('m.*');
        $this->db->from('member m');
        $this->db->where('m.member_id', $where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function UpdateData($tabelName, $data, $where) {
        $res = $this->db->update($tabelName, $data, $where);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function deleteData($table, $key) {
        $query = $this->db->delete($table, $key);
        if ($query) {
            return true;
        } else
            return false;
    }

}

?>