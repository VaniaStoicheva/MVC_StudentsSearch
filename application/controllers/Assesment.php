<?php

class Assesment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('table', 'form_validation', 'session', 'Javascript', 'pagination'));
        $this->load->helper(array('url', 'html'));
        $this->load->model('assesment_model');
    }

    function index() {
        $this->load->view('assesment/view_assesment');
        redirect('Assesment/display');
    }

    function display($sort_by = 'sa_student_id', $sort_order = 'asc') {

        $total_rows = $this->assesment_model->get_num_rows();

        $config['base_url'] = site_url("Assesment/display") . '/' . $sort_by . '/' . $sort_order . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = '4';
        $config['uri_segment'] = '6';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();


        $data['assesments'] = $this->assesment_model->search($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']));
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
//echo '<pre>' . print_r($data, true) . '</pre>';
        $this->load->view('assesment/view_assesment', $data);
    }

    function edit() {
        $student_id = $this->uri->segment(3);
        $subject_id = $this->uri->segment(4);
        $data['subjects'] = $this->assesment_model->get_subjects($subject_id);
        $data['students'] = $this->assesment_model->get_students($student_id);
        $this->load->view('assesment/edit_assesment', $data);
        //echo '<pre>' . print_r($data, true) . '</pre>';



        $assesment = $this->input->post('assesment');
        $lectures = $this->input->post('lectures');
        $exercises = $this->input->post('exercises');
        //validation
        $this->form_validation->set_rules('assesment', 'sa_assesment', 'trim|required|htmlspecialchars');
        $this->form_validation->set_rules('lectures', 'sa_workload_lectures', 'trim|htmlspecialchars|required');
        $this->form_validation->set_rules('exercises', 'sa_workload_exercises', 'trim|htmlspecialchars|required');

        if ($this->form_validation->run() == true) {

            if ($this->assesment_model->edit_subject($student_id, $subject_id, $lectures, $exercises, $assesment)) {
                $this->session->set_flashdata('flashconfirm', 'Успешно променихте хорариума и оценката по предмета');
                redirect('Assesment/display');
            } else {
                $this->session->set_flashdata('flasherror', 'Неуспешна промяна');
                redirect('Assesment/display');
            }
        }


        if ($this->input->post('cancel')) {
            redirect('Assesment/display');
        }
        if ($this->input->post('update')) {
            redirect('Assesment/display');
        }
    }

}
