<?php

class Search_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_num_rows() {
        $query = $this->db->get('students');
        return $query->num_rows();
    }

    function search($sort_by, $sort_order, $per_page, $offset,$match,$course_id,$speciality_id) {
       
        $this->db->select('student_id,
            student_fname,student_lname,
            course_name,
            speciality_name_short,
            sa_subject_id,
            GROUP_CONCAT(subject_workload_lectures,"(",sa_workload_lectures,")") as lectures,
            GROUP_CONCAT(subject_workload_exercises,"(",sa_workload_exercises,")") as exercises,
            group_concat(sa_assesment) as sa_assesment,
            sum(subject_workload_lectures),
	sum(sa_workload_lectures),
	sum(subject_workload_exercises),
	sum(sa_workload_exercises),
	avg(sa_assesment) as assesment');
        $this->db->distinct('student_fname');
        $this->db->from('students');
        $this->db->join('courses','courses.course_id=students.student_course_id');
        $this->db->join('specialities','specialities.speciality_id=students.student_speciality_id');
        $this->db->join('students_assessments','students_assessments.sa_student_id=students.student_id');
        $this->db->join('subjects','subjects.subject_id=students_assessments.sa_subject_id');
        $this->db->like('student_fname',$match);
        $this->db->where('speciality_id',$speciality_id);
        $this->db->where('course_id',$course_id);
        $this->db->group_by('student_id'); 
         $this->db->order_by($sort_by, $sort_order);
        $this->db->limit($per_page, $offset);
        $query=$this->db->get();
        return $query->result_array();
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