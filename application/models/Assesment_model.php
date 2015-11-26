<?php

class Assesment_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_num_rows() {
        $query = $this->db->get('students_assessments');
        return $query->num_rows();
    }

    function search($sort_by, $sort_order, $per_page, $offset) {
        $this->db->order_by($sort_by, $sort_order);
        $this->db->limit($per_page, $offset);
        $this->db->join('subjects', 'subjects.subject_id=students_assessments.sa_subject_id');
        $this->db->join('students', 'students.student_id=students_assessments.sa_student_id');
        $q = $this->db->get('students_assessments');
        return $q->result_array();
    }

    function edit_subject($student_id, $subject_id, $lectures, $exercises, $assesment) {

        $data = array(
            'sa_assesment' => $assesment,
            'sa_workload_lectures' => $lectures,
            'sa_workload_exercises' => $exercises
        );
        $this->db->where('sa_subject_id', $subject_id);
        $this->db->where('sa_student_id', $student_id);
        $this->db->update('students_assessments', $data);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function get_students($student_id) {
        $this->db->select('student_id,student_fname,student_lname');
        $this->db->from('students');
        $this->db->where('student_id', $student_id);
        $q = $this->db->get();
        return $q->result_array();
    }

    function get_subjects($subject_id) {
        $this->db->select('subject_id,subject_name');
        $this->db->from('subjects');
        $this->db->where('subject_id', $subject_id);
        $q = $this->db->get();
        return $q->result_array();
    }

}
