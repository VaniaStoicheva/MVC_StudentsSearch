<?php
class Table_model extends CI_Model
{
    function  __construct() {
        parent::__construct();
         $this->load->library('table');
    }
    function get_specialities()
    {
        $this->db->select('speciality_id');
        $this->db->select('speciality_name_long');
        $q=$this->db->get('specialities');
        return $q->result_array();
    }
    function get_course()
    {
        $this->db->select('course_id,course_name');
        $q=$this->db->get('courses');
        return $q->result_array();
    }
    function get_student($match,$speciality_id,$course_id)
    {
        $this->db->select('student_id,
            student_fname,student_lname,
            course_name,
            sa_subject_id,
            subject_workload_lectures,sa_workload_lectures,
            subject_workload_exercises,sa_workload_exercises,
            sa_assesment');
        $this->db->distinct('student_fname');
        $this->db->from('students');
        $this->db->join('courses','courses.course_id=students.student_course_id');
        $this->db->join('specialities','specialities.speciality_id=students.student_speciality_id');
        $this->db->join('students_assessments','students_assessments.sa_student_id=students.student_id');
        $this->db->join('subjects','subjects.subject_id=students_assessments.sa_subject_id');
        $this->db->like('student_fname',$match);
        $this->db->where('speciality_id',$speciality_id);
        $this->db->where('course_id',$course_id);
        $query=$this->db->get();
        return $query->result_array();
        
    }
}
?>
