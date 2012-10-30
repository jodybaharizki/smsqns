<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class est_msc_onn_pr extends CI_Controller {

    function __construct() {
        parent::__construct();
        //===================CEK LOGIN ADMIN===========================
        if ($this->session->userdata('admin')) {
            return true;
        } else {
            echo "<script type:text/javascript>location='..'</script>";
            return false;
        }
        //=======================================================
        
    }

    public function index() {

        $this->data_grafik();
    }

    function data_grafik($offset=1) {
        

        $region = array();
        $data_1 = array();
        $data_2 = array();
        $data_3 = array();
        $data_4 = array();

        $table_name = 'est_msc_onn_pr';

         //                KONFIGURASI Pagination
        $this->load->model('data_model');
        $perpage = 3;
        $config = array(
            'base_url' => base_url() . 'est_msc_all_pr/data_grafik/',
            'total_rows' => count($this->data_model->data_list($table_name)),
            'per_page' => $perpage//jumlah data yang ditampilkan per baris
        );
        $this->pagination->initialize($config);
        $row['query'] = $this->data_model->data_list($table_name, array('perpage' => $perpage, 'offset' => $offset));
//                =============================== nurul huda

        foreach ($row ['query'] as $data) {
            $region[] = $data['Region'];

            $data_1[] = (integer) $data['Attempt'];
            $data_2[] = (integer) $data['Delivered (total)'];
            $data_3[] = (integer) $data['Delivered (<10s)'];
        }


        $y_axis = array(0, 300000000, 50000000);

        $default_dot = new dot();
        $default_dot->size(5)->colour('#72A0C1');

        $line_1 = new line();
        $line_1->set_default_dot_style($default_dot);
        $line_1->set_width(3);
        $line_1->set_colour('#72A0C1');
        $line_1->set_values($data_1);
        $line_1->set_key("Attempt", 10);


        $default_hollow_dot = new hollow_dot();
        $default_hollow_dot->size(5)->colour('#841B2D');

        $line_2 = new line();
        $line_2->set_default_dot_style($default_hollow_dot);
        $line_2->set_width(2);
        $line_2->set_colour('#841B2D');
        $line_2->set_values($data_2);
        $line_2->set_key("Delivered Total", 10);

        $star_1 = new star();
        $star_1->size(5)->colour('#568203');

        $line_3 = new line();
        $line_3->set_default_dot_style($star_1);
        $line_3->set_width(1);
        $line_3->set_colour('#568203');
        $line_3->set_values($data_3);
        $line_3->set_key("Delivered <10s", 10);

        $y = new y_axis();
        $y->set_range($y_axis[0], $y_axis[1], $y_axis[2]);

        $x = new x_axis();

        $x_labels = new x_axis_labels();
        $x_labels->rotate(45);
        $x_labels->set_size(12);
        $x_labels->set_labels($region);
        $x->set_labels($x_labels);

        $chart = new open_flash_chart();
        $chart->set_title(new title('Data Graphs'));
        $chart->set_y_axis($y);
        $chart->set_x_axis($x);
        //
        // here we add our data sets to the chart:
        //
		$chart->add_element($line_1);
        $chart->add_element($line_2);
        $chart->add_element($line_3);

        $tes = array(
            'graph' => $chart,
            'query' => $row['query'],
            'table' => $table_name,
        );
        $this->load->view('view_est_msc', $tes);
    }

}