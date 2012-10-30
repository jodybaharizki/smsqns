<?php

if (!defined('BASEPATH'))
    exit('Script ini tidak diizinkan');

class common extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("data_model");
        //===================CEK LOGIN ADMIN===========================
        if ($this->session->userdata('admin')) {
            return true;
        } else {
            echo "<script type:text/javascript>location='..'</script>";
            return false;
        }
        //=======================================================
    }

    function index() {
        
    }

    function filter() {
        $params = json_decode($this->input->post('param'));
        $table_name = $_POST['table'] ;
        $this->load->model('data_model');       
        
        $results = $this->data_model->data_list_filter($table_name, $params);
        
        echo json_encode($results);
    }
    function rangeSearch() {
        $table_name = $_POST['table'] ;
        $awal = $_POST['awal'];
        $akhir = $_POST['akhir'];
        $this->load->model('data_model');
        
        $results = $this->data_model->advance_Search($table_name,$awal,$akhir);
        
        echo json_encode($results);
    }

}
