<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_seminar extends CI_Model {

    public function InsertSeminar($tabelName, $data) {
        $res = $this->db->insert($tabelName, $data);
        return $res;
    }

    function list_dataSeminar($limit, $start, $search = '') {
        $this->db->select('s.*');
        $this->db->from('seminar s');
        $this->db->limit($limit, $start);
        $this->db->where("s.tema LIKE '%$search%'");
        $this->db->order_by('seminar_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function jumlah_dataSeminar($search = '') {
        $this->db->select('s.*');
        $this->db->from('seminar s');
        $this->db->where("s.tema LIKE '%$search%'");
        $this->db->order_by('seminar_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function list_Peserta($seminar_id) {
        $this->db->select('ord.*, smr.tema, smr.description, smr.jadwal, smr.tempat, m.firstname, m.lastname, m.email');
        $this->db->from('seminar_order ord');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->join('member m', 'ord.member_id = m.member_id');
        $this->db->where('smr.seminar_id', $seminar_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function list_PesertaSeminar($limit, $start, $search = '', $seminar_id) {
        $this->db->select('ord.*, m.*, smr.*');
        $this->db->from('seminar_order ord');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->join('member m', 'm.member_id = ord.member_id');
        $this->db->limit($limit, $start);
        $this->db->where("m.firstname LIKE '%$search%'");
        $this->db->where('smr.seminar_id', $seminar_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function jumlah_dataPesertaSeminar($search = '', $seminar_id) {
        $this->db->select('ord.*, m.*, smr.*');
        $this->db->from('seminar_order ord');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->join('member m', 'm.member_id = ord.member_id');
        $this->db->where("m.firstname LIKE '%$search%'");
        $this->db->where('smr.seminar_id', $seminar_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function detailSeminar($seminar_id) {
        $this->db->where('seminar_id', $seminar_id);
        $query = $this->db->get('seminar');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function UpdateSeminar($tabelName, $data, $where) {
        $res = $this->db->update($tabelName, $data, $where);
        return $res;
    }

    function deleteData($table, $key) {
        $query = $this->db->delete($table, $key);
        if ($query) {
            return true;
        } else
            return false;
    }



    function seminar_order($seminar_id = '', $quantity = '', $member_id = '') {
        $last_voucher_num = $this->db->query("SELECT COUNT(*) AS coupon_num FROM `ticket_manual` WHERE seminar_id = '" . $seminar_id . "'");
        $last_voucher = $last_voucher_num->row_array();

        $v_num = isset($last_voucher['coupon_num']) ? $last_voucher['coupon_num'] : 0;

        for ($i = 0; $i < $quantity; $i++) {

            $sequenz = str_pad($seminar_id, 4, '0', STR_PAD_LEFT);
            $ticket_sequenz = str_pad($v_num, 4, '0', STR_PAD_LEFT);

            $data_post = array(
                'serial' => 'SEMINAR' . $sequenz . $ticket_sequenz,
                'seminar_id' => $seminar_id,
                'member_id' => $member_id,
                'created_date' => time(),
            );
            $this->db->insert('seminar_order', $data_post);
            $v_num++;
        }
    }

}

?>