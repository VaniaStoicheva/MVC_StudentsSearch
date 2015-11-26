<?php

class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('table', 'form_validation', 'session', 'Javascript', 'pagination'));
        $this->load->helper(array('url', 'html'));
        $this->load->model('student_model');
    }

    function index() {
        $this->load->view('student/view_student');
        redirect('Student/display');
    }

    function display($sort_by = 'student_id', $sort_order = 'asc') {

        $total_rows = $this->student_model->get_num_rows();

        $config['base_url'] = site_url("Student/display") . '/' . $sort_by . '/' . $sort_order . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = '10';
        $config['uri_segment'] = '6';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['students'] = $this->student_model->search($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']));

        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
//echo '<pre>' . print_r($data, true) . '</pre>';
        $this->load->view('student/view_student', $data);
    }

    function add() {

        $data['courses'] = $this->student_model->get_courses();
        $data['specialities'] = $this->student_model->get_speciality();

        //echo '<pre>' . print_r($data, true) . '</pre>';
        $this->load->view('student/add_student', $data);
//validation
        $this->form_validation->set_rules('student_fname', 'student_fname', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('student_lname', 'student_lname', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'student_email', 'trim|required|valid_email');
        $this->form_validation->set_rules('fnumber', 'student_fnumber', 'trim|htmlspecialchars|required|is_unique[students.student_fnumber]');

        $student_fname = $this->input->post('student_fname');
        $student_lname = $this->input->post('student_lname');
        $student_fnumber = $this->input->post('fnumber');
        $student_email = $this->input->post('email');
        $student_course_id = $this->input->post('course');
        $student_speciality_id = $this->input->post('speciality');
        $student_education_form = $this->input->post('education');




        if ($this->input->post('add')) {

            if ($this->form_validation->run() == TRUE) {
                if ($this->student_model->match($student_fnumber)) {
                    if ($this->student_model->create($student_fname, $student_lname, $student_email, $student_fnumber, $student_course_id, $student_speciality_id, $student_education_form)) {
                        $this->session->set_flashdata('flashconfirm', 'Студента е въведенa успешно');
                        redirect('Student/add');
                    } else {
                        $this->session->set_flashdata('flashconfirm', 'Студента не беше въведен');
                        redirect('Student/add');
                    }
                } else {
                    $this->session->set_flashdata('flasherror', 'Факултетния номер вече съществува в бд');
                    redirect('Student/add');
                }
            } else {
                $this->session->set_flashdata('flasherror', 'Въвели сте грешно име на студента');
                redirect('Student/add');
            }
        }
        if ($this->input->post('update')) {
            redirect('Student/display');
        }
        if ($this->input->post('cancel')) {
            redirect('Student/display');
        }
    }

    function delete() {
        $student_id = $this->uri->segment(3);
        $this->student_model->deleted($student_id);
        $this->session->set_flashdata('flashconfirm', 'Студента  беше изтрит успешно');
        redirect('Student/display', 'refresh');
    }

    function edit() {
        $student_id = $this->uri->segment(3);
        $data['students'] = $this->student_model->selected_student($student_id);
        $data['courses'] = $this->student_model->get_courses();
        $data['specialities'] = $this->student_model->get_speciality();

        $this->load->view('student/edit_student', $data);

        if ($this->input->post('submit')) {
            $student_fname = $this->input->post('student_fname');
            $student_lname = $this->input->post('student_lname');
            $student_fnumber = $this->input->post('fnumber');
            $student_email = $this->input->post('email');
            $student_course_id = $this->input->post('course');
            $student_speciality_id = $this->input->post('speciality');
            $student_education_form = $this->input->post('education');
            //validation
            $this->form_validation->set_rules('student_fname', 'student_fname', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('student_lname', 'student_lname', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('email', 'student_email', 'trim|required|valid_email');
            $this->form_validation->set_rules('fnumber', 'student_fnumber', 'trim|htmlspecialchars|required|is_unique[students.student_fnumber]');
            if ($this->form_validation->run() == true) {
                if ($this->student_model->match($student_fnumber)) {
                    if ($this->student_model->
                                    edit_student($student_id, $student_fname, $student_lname, $student_email, $student_fnumber, $student_course_id, $student_speciality_id, $student_education_form)) {
                        $this->session->set_flashdata('flashconfirm', 'Успешно променихте данните за студента');
                        redirect('Student/edit');
                    } else {
                        $this->session->set_flashdata('flasherror', 'Името не е променено в БД');
                        redirect('Student/edit');
                    }
                } else {
                    $this->session->set_flashdata('flasherror', 'Вече съществува студент с този факултетен номер');
                    redirect('Student/edit');
                }
            } else {
                $this->session->set_flashdata('flasherror', 'Въвели сте грешни данни');
                redirect('Student/edit');
            }
        }
        if ($this->input->post('cancel')) {
            redirect('Student/display');
        }
    }

}
