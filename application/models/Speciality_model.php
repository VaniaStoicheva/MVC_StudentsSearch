<?php

class Speciality_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_num_rows() {
        $query = $this->db->get('specialities');
        return $query->num_rows();
    }

    function search($sort_by, $sort_order, $per_page, $offset) {
        $this->db->order_by($sort_by, $sort_order);
        $this->db->limit($per_page, $offset);
        $q = $this->db->get('specialities');
        return $q->result_array();
    }

    function match($long_name, $short_name) {
        $this->db->where('speciality_name_long', $long_name);
        $this->db->where('speciality_name_short', $short_name);
        $this->db->get('specialities');

        if ($this->db->affected_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    function create($long_name, $short_name) {
        $data = array(
            'speciality_id' => 'speciality_id',
            'speciality_name_long' => $long_name,
            'speciality_name_short' => $short_name
        );
        $this->db->set($data);
        $this->db->insert('specialities', $data);

        return $this->db->insert_id();
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function edit_speciality($speciality_id, $new_long_name, $new_short_name) {

        $data = array(
            'speciality_name_long' => $new_long_name,
            'speciality_name_short' => $new_short_name
        );

        $this->db->where('speciality_id', $speciality_id);
        $this->db->update('specialities', $data);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function selected_speciality($speciality_id) {

        $this->db->where('speciality_id', $speciality_id);
        $query = $this->db->get('specialities');

        return $query->result_array();
    }

    function deleted($speciality_id) {

        $this->db->where('speciality_id', $speciality_id);
        $this->db->delete('specialities');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

}
