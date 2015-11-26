<?php
class Users_model extends CI_Model {
    function validate_login() {
        $username=$this->input->post('user_name');
        $password=$this->input->post('user_password');
        //заявка към БД
        $this->db->where('user_name',$username);
        $this->db->where('user_password',$password);
        $query=$this->db->get('users');
        //ако резултата е 1 ред вярно
        if($query->num_rows() == 1) {
           return  TRUE;
        }
        else{
            return FALSE;
        }
    }
    function check_username() {
        $username=$this->input->post('user_name');

        $this->db->select('user_name');
        $this->db->where('user_name',$username);
        $query=$this->db->get('users');

        if($query->num_rows()!=0) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
    function check_email() {
        $email=$this->input->post('user_email');

        $this->db->select('user_email');
        $this->db->where('user_email',$email);
        $query=$this->db->get('users');

        if($query->num_rows()!=0) {
            return FALSE;
        }
        else {
            return TRUE;
        }

    }
    function insert_user() {
        $data=array(
                'user_name'=>$this->input->post('user_name'),
                'user_password'=>$this->input->post('user_password'),
                'user_fname'=>$this->input->post('user_fname'),
                'user_lname'=>$this->input->post('user_lname'),
                'user_email'=>$this->input->post('user_email')
                 );
        
        $query=$this->db->insert('users',$data);

        if($this->db->affected_rows() == 1) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}
?>
