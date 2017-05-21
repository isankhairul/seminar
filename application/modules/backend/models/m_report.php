<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_report extends CI_Model {

    function report_seminar($from_date = '', $to_date = '') {
        $this->db->select('smr.tema, smr.jadwal, ord.seminar_id, SUM(ord.attended) AS total');
        $this->db->from('seminar_order ord');
        $this->db->join('member m', 'ord.member_id = m.member_id');
        $this->db->join('seminar smr', 'ord.seminar_id = smr.seminar_id');
        $this->db->where('DATE_FORMAT(smr.jadwal, "%Y-%m-%d") >=', $from_date);
        $this->db->where('DATE_FORMAT(smr.jadwal, "%Y-%m-%d") <=', $to_date);
        $this->db->where('ord.attended', 1);
        $this->db->order_by('smr.jadwal', 'asc');
        $this->db->group_by('smr.seminar_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

}

?>