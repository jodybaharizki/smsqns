<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_admin_model');
    }
    //=========================================================================
    function index() {
        if ($this->session->userdata('admin') == true) {
            $content['username'] = $this->session->userdata['username'];
            redirect('sms_class_pb1/index');
        }else {            
            $this->session->sess_destroy();
            $this->load->view('login_admin');
        }
    }
    //=========================================================================

    function proses_login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            if ($this->login_admin_model->check_user($username, $password) == true) {
                $data = array('username' => $username, 'admin' => true);
                $this->session->set_userdata($data);
                echo "<script type:text/javascript>location='..'</script>";
            } else {
                $this->session->set_flashdata('message', '<font size="1" color="blue"><blink>Username or Password incorrect</font></blink>');
                redirect('login_admin/index');
            }
        } else {
            $this->index();
        }
    }

    function proses_logout() {
        $this->session->sess_destroy();
        redirect('login_admin', 'refresh');
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
