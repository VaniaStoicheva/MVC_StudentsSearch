<?php

class Search extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('table', 'form_validation', 'session', 'Javascript', 'pagination'));
        $this->load->helper(array('url', 'html'));
        $this->load->model('search_model');
    }

    function index() {
        $this->load->view('search/view_search');
        redirect('Search/display');
    }

    function display($sort_by = 'student_id', $sort_order = 'asc',$student_name='',$course_id='',$speciality_id='') {

        $total_rows = $this->search_model->get_num_rows();

        $config['base_url'] = site_url("Search/display") . '/' . $sort_by . '/' . $sort_order . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = '10';
        $config['uri_segment'] = '6';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        
        $data['course']=  $this->search_model->get_courses();
        $data['specialities']=  $this->search_model->get_speciality();
        
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;


    $student_name=  $this->input->post('student_name');
    $course_id=$this->input->post('courses');
    $speciality_id=$this->input->post('speciality');
//    $datas=array(
//        'student_name'=>$student_name,
//        'course_id'=>$course_id
//    );
//    $this->session->set_userdata($datas);
    //$data['session']=  $this->session->all_userdata();
    
    $data['students']=$this->search_model->search($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']),$student_name,$course_id,$speciality_id);

    //echo '<pre>' . print_r($data, true) . '</pre>';
  
        $this->load->view('search/view_search', $data);
    
    }
    
}
