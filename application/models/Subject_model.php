<?php

class Subject_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_num_rows() {
        $query = $this->db->get('subjects');
        return $query->num_rows();
    }

    function search($sort_by, $sort_order, $per_page, $offset) {
        $this->db->order_by($sort_by, $sort_order);
        $this->db->limit($per_page, $offset);
        $q = $this->db->get('subjects');
        return $q->result_array();
    }

    function match($subject_name) {

        $this->db->where('subject_name', $subject_name);
        $this->db->get('subjects');

        if ($this->db->affected_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    function create($subject_name, $lectures, $exercises) {
        $data = array(
            'subject_id' => 'subject_id',
            'subject_name' => $subject_name,
            'subject_workload_lectures' => $lectures,
            'subject_workload_exercises' => $exercises
        );
        $this->db->set($data);
        $this->db->insert('subjects', $data);

        return $this->db->insert_id();
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function edit_subject($subject_id, $new_subject_name, $new_lectures, $new_exercises) {

        $data = array(
            'subject_name' => $new_subject_name,
            'subject_workload_lectures' => $new_lectures,
            'subject_workload_exercises' => $new_exercises
        );

        $this->db->where('subject_id', $subject_id);
        $this->db->update('subjects', $data);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function selected_subject($subject_id) {

        $this->db->where('subject_id', $subject_id);
        $query = $this->db->get('subjects');

        return $query->result_array();
    }

    function deleted($subject_id) {

        $this->db->where('subject_id', $subject_id);
        $this->db->delete('subjects');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

}
