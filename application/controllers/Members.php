<?php

class Members extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    function index() {
        $this->home();
    }

    function home() { //успешен вход
        $data['main_view'] = 'members/members_area';
        $this->load->view('members/members_area', $data);

        if ($this->input->post('course')) {
            redirect('Course', 'index');
        }
        if ($this->input->post('students')) {
            redirect('Student', 'index');
        }
        if ($this->input->post('specialities')) {
            redirect('Speciality', 'index');
        }
        if ($this->input->post('subject')) {
            redirect('Subject', 'index');
        }
        if ($this->input->post('search')) {
            redirect('Search', 'index');
        }
        if ($this->input->post('assesments')) {
            redirect('Assesment', 'index');
        }
    }

    function is_logged() { //неуспешен вход ->логин форма
        $is_logged = $this->session->userdata('is_logged');
        if (!isset($is_logged) || $is_logged !== TRUE) {
            echo 'Restricted area!<a href="Login">Login</a>';
            die();
        }
    }

}

?>
