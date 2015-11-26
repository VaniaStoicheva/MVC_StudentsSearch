<?php

class Speciality extends CI_Controller {

function __construct() {
parent::__construct();
$this->load->library(array('table', 'form_validation', 'session', 'Javascript', 'pagination'));
$this->load->helper(array('url', 'html'));
$this->load->model('speciality_model');

}

function index() {
$this->load->view('speciality/view_speciality');
redirect('Speciality/display');
}

function display($sort_by = 'speciality_name_long', $sort_order = 'asc') {

$total_rows = $this->speciality_model->get_num_rows();

$config['base_url'] = site_url("Speciality/display") . '/' . $sort_by . '/' . $sort_order . '/page/';
$config['total_rows'] = $total_rows;
$config['per_page'] = '4';
$config['uri_segment'] = '6';

$this->pagination->initialize($config);

$data['pagination'] = $this->pagination->create_links();

$data['specialities'] = $this->speciality_model->search($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']));
$data['sort_by'] = $sort_by;
$data['sort_order'] = $sort_order;

$this->load->view('speciality/view_speciality', $data);
}

function add() {
$this->load->view('speciality/add_speciality');
//validation
$this->form_validation->set_rules('long_name', 'speciality_name_long', 'trim|required|min_length[3]|is_unique[specialities.speciality_name_long]');
$this->form_validation->set_rules('short_name', 'speciality_name_short', 'trim|required|min_length[1]|max_length[3]|is_unique[specialities.speciality_name_short]');

$long_name = $this->input->post('long_name');
$short_name = $this->input->post('short_name');

if ($this->input->post('add')) {

if ($this->form_validation->run() == TRUE) {
if ($this->speciality_model->match($long_name, $short_name)) {
if ($this->speciality_model->create($long_name, $short_name)) {
$this->session->set_flashdata('flashconfirm', 'Специалността <b>' . $long_name . '</b> е въведенa успешно');
redirect('Speciality/add');
} else {
$this->session->set_flashdata('flashconfirm', 'Специалността <b>' . $long_name . '</b> не беше въведенa');
redirect('Speciality/add');
}
} else {
$this->session->set_flashdata('flasherror', 'Името <b>' . $long_name . '</b> вече съществува в бд');
redirect('Speciality/add');
}
} else {
$this->session->set_flashdata('flasherror', 'Въвели сте грешно име на специалност');
redirect('Speciality/add');
}
}
if ($this->input->post('update')) {
redirect('Speciality/display');
}
if ($this->input->post('cancel')) {
redirect('Speciality/display');
}
}

function delete() {
    $speciality_id=$this->uri->segment(3);
    $this->speciality_model->deleted($speciality_id);
$this->session->set_flashdata('flashconfirm', 'Специалността  беше изтритa успешно');
        redirect('Speciality/display', 'refresh');
}

function edit() {
    $speciality_id = $this->uri->segment(3);
        $data['specialitys'] = $this->speciality_model->selected_speciality($speciality_id);
        $this->load->view('speciality/edit_speciality',$data);
        //echo '<pre>' . print_r($data, true) . '</pre>';
        if ($this->input->post('submit')) {
            $long_name = $this->input->post('long_name');
            $short_name = $this->input->post('short_name');
                //validation
            $this->form_validation->set_rules('long_name', 'speciality_name_long', 'trim|required|min_length[3]|is_unique[specialities.speciality_name_long]');
            $this->form_validation->set_rules('short_name', 'speciality_name_short', 'trim|required|min_length[1]|max_length[3]|is_unique[specialities.speciality_name_short]');
            if ($this->form_validation->run() == true) {
                if ($this->speciality_model->match($long_name, $short_name)) {
                    if ($this->speciality_model->edit_speciality($speciality_id,$long_name, $short_name)) {
                        $this->session->set_flashdata('flashconfirm', 'Успешно променихте името на специалноста');
                        redirect('Speciality/edit');
                    } else {
                        $this->session->set_flashdata('flasherror', 'Името не е променено в БД');
                        redirect('Speciality/edit');
                    }
                } else {
                    $this->session->set_flashdata('flasherror', 'Вече съществува специалност с такова име');
                    redirect('Speciality/edit');
                }
            } else {
                $this->session->set_flashdata('flasherror', 'Въвели сте грешно име на курс');
                redirect('Speciality/edit');
            }
        }
        if ($this->input->post('cancel')) {
            redirect('Speciality/display');
        }
    }

}
