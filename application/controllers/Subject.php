<?php
class Subject extends CI_Controller {

function __construct() {
parent::__construct();
$this->load->library(array('table', 'form_validation', 'session', 'Javascript', 'pagination'));
$this->load->helper(array('url', 'html'));
$this->load->model('subject_model');

}

function index() {
$this->load->view('subject/view_subject');
redirect('Subject/display');
}

function display($sort_by = 'subject_name', $sort_order = 'asc') {

$total_rows = $this->subject_model->get_num_rows();

$config['base_url'] = site_url("Subject/display") . '/' . $sort_by . '/' . $sort_order . '/page/';
$config['total_rows'] = $total_rows;
$config['per_page'] = '4';
$config['uri_segment'] = '6';

$this->pagination->initialize($config);

$data['pagination'] = $this->pagination->create_links();

$data['subjects'] = $this->subject_model->search($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']));
$data['sort_by'] = $sort_by;
$data['sort_order'] = $sort_order;

$this->load->view('subject/view_subject', $data);
}

function add() {
$this->load->view('subject/add_subject');
//validation
$this->form_validation->set_rules('subject_name', 'subject_name', 'trim|required|min_length[3]|is_unique[subjects.subject_name]');
$this->form_validation->set_rules('lectures', 'subject_workload_lectures', 'trim|htmlspecialchars|required');
$this->form_validation->set_rules('exercises', 'subject_workload_exercises', 'trim|htmlspecialchars|required');

$subject_name = $this->input->post('subject_name');
$lectures= $this->input->post('lectures');
$exercises= $this->input->post('exercises');

if ($this->input->post('add')) {

if ($this->form_validation->run() == TRUE) {
if ($this->subject_model->match($subject_name)) {
if ($this->subject_model->create($subject_name, $lectures,$exercises)) {
$this->session->set_flashdata('flashconfirm', 'Предмета <b>' . $subject_name . '</b> е въведенa успешно');
redirect('Subject/add');
} else {
$this->session->set_flashdata('flashconfirm', 'Предмета <b>' . $subject_name . '</b> не беше въведенa');
redirect('Subject/add');
}
} else {
$this->session->set_flashdata('flasherror', 'Името <b>' . $subject_name . '</b> вече съществува в бд');
redirect('Subject/add');
}
} else {
$this->session->set_flashdata('flasherror', 'Въвели сте грешно име на предмета');
redirect('Subject/add');
}
}
if ($this->input->post('update')) {
redirect('Subject/display');
}
if ($this->input->post('cancel')) {
redirect('Subject/display');
}
}

function delete() {
    $subject_id=$this->uri->segment(3);
    $this->subject_model->deleted($subject_id);
$this->session->set_flashdata('flashconfirm', 'Предмета  беше изтрит успешно');
        redirect('Subject/display', 'refresh');
}

function edit() {
    $subject_id = $this->uri->segment(3);
        $data['subjects'] = $this->subject_model->selected_subject($subject_id);
        $this->load->view('subject/edit_subject',$data);
        //echo '<pre>' . print_r($data, true) . '</pre>';
        if ($this->input->post('submit')) {
            $subject_name = $this->input->post('subject_name');
            $lectures = $this->input->post('lectures');
            $exercises= $this->input->post('exercises');
               //validation
            $this->form_validation->set_rules('subject_name', 'subject_name', 'trim|required|min_length[3]|is_unique[subjects.subject_name]');
            $this->form_validation->set_rules('lectures', 'subject_workload_lectures', 'trim|htmlspecialchars|required');
             $this->form_validation->set_rules('exercises', 'subject_workload_exercises', 'trim|htmlspecialchars|required');
            if ($this->form_validation->run() == true) {
                if ($this->subject_model->match($subject_name)) {
                    if ($this->subject_model->edit_subject($subject_id,$subject_name, $lectures,$exercises)) {
                        $this->session->set_flashdata('flashconfirm', 'Успешно променихте името на предмета');
                        redirect('Subject/edit');
                    } else {
                        $this->session->set_flashdata('flasherror', 'Името не е променено в БД');
                        redirect('Subject/edit');
                    }
                } else {
                    $this->session->set_flashdata('flasherror', 'Вече съществува предмет с такова име');
                    redirect('Subject/edit');
                }
            } else {
                $this->session->set_flashdata('flasherror', 'Въвели сте грешно име на предмет');
                redirect('Subject/edit');
            }
        }
        if ($this->input->post('cancel')) {
            redirect('Subject/display');
        }
    }

}

