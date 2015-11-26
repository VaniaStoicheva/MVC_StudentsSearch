<?php

class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_num_rows() {
        $query = $this->db->get('students');
        return $query->num_rows();
    }

    function search($sort_by, $sort_order, $per_page, $offset) {
        $this->db->order_by($sort_by, $sort_order);
        $this->db->limit($per_page, $offset);
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('courses', 'courses.course_id=students.student_course_id');
        $this->db->join('specialities', 'specialities.speciality_id=students.student_speciality_id');
        $q = $this->db->get();
        return $q->result_array();
    }

    function match($student_fnumber) {

        $this->db->where('student_fnumber', $student_fnumber);
        $this->db->get('students');

        if ($this->db->affected_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    function get_course_name($course_id) {
        $this->db->select('course_name');
        $this->db->where('course_id', $course_id);
        $q = $this->db->get('courses');
        return $q->result_array();
    }

    function create($student_fname, $student_lname, $student_email, $student_fnumber, $student_course_id, $student_speciality_id, $student_education_form) {
        $datas = array(
            'student_id' => 'student_id',
            'student_fname' => $student_fname,
            'student_lname' => $student_lname,
            'student_fnumber' => $student_fnumber,
            'student_email' => $student_email,
            'student_course_id' => $student_course_id,
            'student_speciality_id' => $student_speciality_id,
            'student_education_form' => $student_education_form
        );

        $this->db->set($datas);
        $this->db->insert('students', $datas);

        return $this->db->insert_id();
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function edit_student($student_id, $student_fname, $student_lname, $student_email, $student_fnumber, $student_course_id, $student_speciality_id, $student_education_form) {

        $datas = array(
            'student_fname' => $student_fname,
            'student_lname' => $student_lname,
            'student_fnumber' => $student_fnumber,
            'student_email' => $student_email,
            'student_course_id' => $student_course_id,
            'student_speciality_id' => $student_speciality_id,
            'student_education_form' => $student_education_form
        );

        $this->db->where('student_id', $student_id);
        //$this->db->set($datas);
        $this->db->update('students', $datas);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function selected_student($student_id) {

        $this->db->where('student_id', $student_id);
        $query = $this->db->get('students');

        return $query->result_array();
    }

    function deleted($student_id) {

        $this->db->where('student_id', $student_id);
        $this->db->delete('students');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function get_courses() {
        $q = $this->db->get('courses');
        return $q->result_array();
    }

    function get_speciality() {
        $q = $this->db->get('specialities');
        return $q->result_array();
    }

}
