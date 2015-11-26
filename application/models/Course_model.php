<?php

class Course_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get() {
        $q = $this->db->get('courses');
        return $q->result_array();
    }

    function create($course_name) {
        $data = array(
            'course_id' => 'course_id',
            'course_name' => $course_name
        );

        $this->db->set($data);
        $this->db->insert('courses', $data);
        return $this->db->insert_id();

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleted($course_id) {

        $this->db->where('course_id', $course_id);
        $this->db->delete('courses');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function selected_course($course_id) {

        $this->db->select('course_name');
        $this->db->where('course_id', $course_id);
        $q = $this->db->get('courses');
        return $q->result_array();
    }

    function edit_course($new_name) {
        $course_id = $this->uri->segment(3);

        $this->db->set('course_name', $new_name);
        $this->db->where('course_id', $course_id);
        $this->db->update('courses');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function match($course_name) {

        $this->db->where('course_name', $course_name);
        $this->db->get('courses');
        if ($this->db->affected_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_num_rows() {
        $q = $this->db->get('courses');
        return $q->num_rows();
    }

    function search($sort_by, $sort_order, $per_page, $offset) {
        $this->db->order_by($sort_by, $sort_order);
        $this->db->limit($per_page, $offset);
        $q = $this->db->get('courses');
        return $q->result_array();
    }

}

?>
