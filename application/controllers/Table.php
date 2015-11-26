<?php
class Table extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('table','session'));
        $this->load->helper(array('url','html','form'));
        $this->load->model('Table_model');
        $this->load->library('table');
        $this->load->library('pagination');
    }
    function index()
    {
        $this->load->view('table1');
        redirect('Table/display');
    }
    function display()
    {
        $data['specialities']=$this->Table_model->get_specialities();
       // echo '<pre>' . print_r($data['specialities'], true) . '</pre>';
        $data['course']=$this->Table_model->get_course();
       // echo '<pre>' . print_r($data['course'], true) . '</pre>';
//exit();
        
        $student_name=$this->input->post('student_name');
        $speciality_id=$this->input->post('speciality[options][value]');
        $course_id=$this->input->post('course[options][value]');
        echo '<pre>' . print_r($_POST, true) . '</pre>';
        
//            if($this->input->post('student_name')){
//                    if( $this->input->post('speciality')){ 
//                    if($this->input->post('course')){ 
//                    if($this->input->post('mysubmit')){
//               
                        //if($this->input->post('mysubmit')){
$data['students']=$this->Table_model->get_student($student_name,$speciality_id,$course_id);
                       
                        
                    
//                }
//                    }
//                    }
//            }
             //echo '<pre>' . print_r($data['students'], true) . '</pre>'; 
 $this->load->view('table1',$data);
    }
}

?>
