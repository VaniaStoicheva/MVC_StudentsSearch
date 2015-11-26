<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    function index() {
        $this->do_login();
    }

    function do_login() {       //зарежда логин формата
        $data['main_view'] = 'login/login_form';
        $this->load->view('login/login_form', $data);
    }

    function validate() {       //валидиране на данните
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Име', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('user_password', 'Парола', 'trim|required');

        if ($this->form_validation->run() == TRUE) {       //при успешна валидация прави заявката
            $this->load->model('Users_model');
            if ($this->Users_model->validate_login()) {
                //зарежда данните в бисквитка
                $data = array(
                    'logged_in' => TRUE,
                    'user_name' => $this->input->post('user_name')
                );

                $this->session->set_userdata($data);
                redirect('members');
            } else {
                //неуспешна валидация генерира грешка
                //set_flashdata()сетваме ст-ти в сесията на потребителя достъпна само
                // до следващия рекуест на сървъра след което се изтрива автомaтично
                // така хвърляме съобщения на потребителя
                $this->session->set_flashdata('errmsg', 'Грешно име или парола');
                redirect('login/index', 'refresh');
            }
        } else {

            $this->index();
        }
    }

    function register() {
        $data['main_view'] = 'login/register_form';
        $this->load->view('login/register_form', $data);
    }

    function validate_register() {
        $this->load->library('form_validation');


        $this->form_validation->set_rules('user_name', 'Username', 'trim|required|alpha_numeric|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[3]|max_length[40]|matches[passconf]|md5');
        $this->form_validation->set_rules('passconf', 'Confirm password', 'trim|required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('user_fname', 'First name', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('user_lname', 'Last name', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|max_length[64]');

        //всички грешки ще излизат в параграф от класа validation_err
        $this->form_validation->set_error_delimiters('<div class="validation_err">', '</div>');


        if ($this->form_validation->run() == TRUE) {
            $this->load->model('users_model');
            if ($this->users_model->check_username()) {
                if ($this->users_model->check_email()) {
                    if ($this->users_model->insert_user()) {
                        $data = array(
                            'user_name' => $this->input->post('user_name'),
                            'user_email' => $this->input->post('user_email'),
                            'is_insert' => TRUE
                        );
                        $this->session->set_userdata($data);
                        redirect('members');
                    } else {
                        echo 'error insert db';
                    }
                } else {
                    echo 'The email is taken';
                    $this->register();
                }
            } else {
                $this->session->set_flashdata('errmsg', ' името е заето');
                $this->register();
            }
        } else {
            $this->register();
        }
    }

    function _send_email($activation_code) {
        $code = $activation_code;
        $username = $this->input->post('user_name');
        $email_to = $this->input->post('user_email');


        /* $config['protocol'] = 'sendmail';
          $config['mailtype'] = 'html';
          $config['charset']  = 'utf-8';
          $config['newline']  = "\r\n"; */
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.abv.bg',
            'smtp_port' => 465,
            'smtp_user' => 'wanias@abv.bg',
            'smtp_pass' => '1690248'
        );
        //$this->email->initialize();
//ini_set("smtp_port","25");
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('wanias@abv.bg', 'Sys admin');
        $this->email->to($email_to);
        $this->email->subject('Activate Your account');

        $message = 'Your registration is almost complete.
            Click on the link below to activate your account:'
                . site_url('login/activate') . '/' . $username . '/' . $code . '';
        $this->email->message($message);

        if ($this->email->send()) {
            return TRUE;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function _gen_pass($len) {
        $pool = '123456789abcdefjkrlmnoprstuvwxhyzABCDEFJKRLMNHOPUVWXYZ';

        $str = '';
        for ($i = 0; $i < $len; $i++) {
            $str .=substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }
        return $str;
    }

    function logout() {
        //унишожаваме бисквитката
        $this->session->sess_destroy();
        redirect('login');
    }

}
