<?php

class Course extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('table', 'form_validation', 'session', 'Javascript'));
        $this->load->helper(array('url', 'html'));
        $this->load->model('course_model');
        $this->load->helper('security');
        $this->load->library('pagination');
    }

    function index() {
        $this->load->view('course/view_course');
        redirect('Course/display');
    }

    function display($sort_by = 'course_name', $sort_order = 'asc') {

        $total_rows = $this->course_model->get_num_rows();


        $config['base_url'] = site_url("Course/display") . '/' . $sort_by . '/' . $sort_order . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = '4';
        $config['uri_segment'] = '6';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['courses'] = $this->course_model->search($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']));
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;

        $this->load->view('course/view_course', $data);
    }

    function delete() {
        $course_id = $this->uri->segment(3);

        $this->course_model->deleted($course_id);

        $this->session->set_flashdata('flashconfirm', 'Курс със ID: ' . $course_id . ' беше изтрит успешно');
        redirect('Course/display', 'refresh');
    }

    function edit() {
        $course_id = $this->uri->segment(3);
        $data['courses'] = $this->course_model->selected_course($course_id);
        $this->load->view('course/edit_course', $data);

        if ($this->input->post('submit')) {
            $new_name = $this->input->post('new_name');
            //validation
            $this->form_validation->set_rules('new_name', 'new_name', 'trim|required|min_length[3]|is_unique[courses.course_name]');
            if ($this->form_validation->run() == TRUE) {

                if ($this->course_model->match($new_name)) {
                    if ($this->course_model->edit_course($new_name)) {
                        $this->session->set_flashdata('flashconfirm', 'Успешно променихте името на курса');
                        redirect('Course/edit');
                    } else {
                        $this->session->set_flashdata('flasherror', 'Името не е променено в БД');
                        redirect('Course/edit');
                    }
                } else {
                    $this->session->set_flashdata('flasherror', 'Вече съществува курс с такова име');
                    redirect('Course/edit');
                }
            } else {
                $this->session->set_flashdata('flasherror', 'Въвели сте грешно име на курс');
                redirect('Course/edit');
            }
        }
        if ($this->input->post('cancel')) {
            redirect('Course/display');
        }
    }

    function add() {
        $this->load->view('course/add_course');
        //validation
        $this->form_validation->set_rules('course_name', 'course_name', 'trim|required|min_length[3]|is_unique[courses.course_name]');

        $course = $this->input->post('course_name');

        if ($this->input->post('add')) {

            if ($this->form_validation->run() == TRUE) {
                if ($this->course_model->match($course)) {
                    if ($this->course_model->create($course)) {
                        $this->session->set_flashdata('flashconfirm', 'Курса <b>' . $course . '</b> е въведен успешно');
                        redirect('Course/add');
                    } else {
                        $this->session->set_flashdata('flashconfirm', 'Курсът <b>' . $course . '</b> не беше въведен');
                        redirect('Course/add');
                    }
                } else {
                    $this->session->set_flashdata('flasherror', 'Името <b>' . $course . '</b> вече съществува в бд');
                    redirect('Course/add');
                }
            } else {
                $this->session->set_flashdata('flasherror', 'Въвели сте грешно име на курс');
                redirect('Course/add');
            }
        }
        if ($this->input->post('update')) {
            redirect('Course/display');
        }
        if ($this->input->post('cancel')) {
            redirect('Course/display');
        }
    }

}

?>
