<?php

class data_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function data_list($table_name,$limit = array()) {            
        if($limit == null){
            return $this->db->get($table_name)->result_array();
        }else{
            return $this->db->limit($limit['perpage'],$limit['offset'])->get($table_name)->result_array();
        }
    }

    function data_list_filter($table_name, $filters) {
        $where = array();
        foreach ($filters as $k => $v)
            if ($v != "") {
                $where[$v[0]] = $v[1];
                $this->load->database();
                $query = $this->db->like($where)->get($table_name);
            }
        return $query->result_array();
    }

    function advance_Search($table_name, $awal, $akhir) {        
        $query = $this->db->query("select * from $table_name where Date between  '$awal' and  '$akhir'");
        return $query->result_array();
    }

}

?>