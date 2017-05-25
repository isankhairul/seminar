<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_register extends CI_Model {

    function getDataKey($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function getDetailMember($member_id) {
        $this->db->select('m.*');
        $this->db->from('member m');
        $this->db->where('m.member_id', $member_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function check_data_where($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_to_password($id, $password) {
        $this->db->where('member_id', $id);
        $this->db->where('password', $password);
        $query = $this->db->get('member');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function insertData($table, $data) {
        $query = $this->db->insert($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function updateData($table, $data, $where) {
        $this->db->where($where);
        $query = $this->db->update($table, $data);

        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function do_login_member($email, $password) {
        $this->db->select('m.*');
        $this->db->from('member m');
        $this->db->where('m.email', $email);
        $this->db->where('m.password', encryptPass($password));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function count_seminar($member_id) {
        $this->db->select('ord.order_id');
        $this->db->from('seminar_order ord');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->where('ord.member_id', $member_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return FALSE;
        }
    }

    function count_sertifikat($member_id) {
        $this->db->select('ord.order_id');
        $this->db->from('order ord');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->where('ord.member_id', $member_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return FALSE;
        }
    }

    function list_seminar_member($limit, $start, $member_id) {
        $this->db->select('ord.*, m.*, smr.*');
        $this->db->from('seminar_order ord');
        $this->db->join('member m', 'ord.member_id = m.member_id');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->where('ord.member_id', $member_id);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function list_sertifikat_member($limit, $start, $member_id) {
        $this->db->select('ord.*, m.*, smr.*,tk.*');
        $this->db->from('seminar_order ord');
        $this->db->join('member m', 'ord.member_id = m.member_id');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->where('ord.member_id', $member_id);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function ticket_seminar($order_id) {
        $this->db->select('ord.*, m.*, smr.*');
        $this->db->from('seminar_order ord');
        $this->db->join('member m', 'ord.member_id = m.member_id');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->where('ord.order_id', $order_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function all_seminar($member_id) {
        $this->db->select('ord.*, m.*, smr.*,');
        $this->db->from('seminar_order ord');
        $this->db->join('member m', 'ord.member_id = m.member_id');
        $this->db->where('ord.member_id', $member_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

}

?>