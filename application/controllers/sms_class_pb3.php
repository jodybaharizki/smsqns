<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class sms_class_pb3 extends CI_Controller {

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
        $tanggal = array();
        $data_1 = array();
        $data_2 = array();
        $data_3 = array();
        $data_4 = array();
        $data_5 = array();

        $table_name = 'sms_class_pb_3';

//                KONFIGURASI Pagination
        $this->load->model('data_model');
        $perpage = 10;
        $config = array(
            'base_url' => base_url() . 'sms_class_pb3/data_grafik/',
            'total_rows' => count($this->data_model->data_list($table_name)),
            'per_page' => $perpage//jumlah data yang ditampilkan per baris
        );
                $this->pagination->initialize($config);
        $row['query'] = $this->data_model->data_list($table_name,array('perpage' => $perpage, 'offset' => $offset));
//                =============================== nurul huda

        foreach ($row ['query'] as $data) {
            $tanggal[] = $data['Date'];

            $data_1[] = (integer) $data['Attempt_2'];
            $data_2[] = (integer) $data['Delivered'];
            $data_3[] = (integer) $data['Delivered <10s'];
            $data_4[] = (float) $data['Delivery Rate'];
            $data_5[] = (float) $data['Delivery <10s rate'];
        }


        $y_axis = array(0, 80000000, 10000000);

        $default_dot = new dot();
        $default_dot->size(5)->colour('#A32638');

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
        $line_2->set_width(1);
        $line_2->set_colour('#841B2D');
        $line_2->set_values($data_2);
        $line_2->set_key("Delivered", 10);

        $star_1 = new star();
        $star_1->size(5)->colour('#568203');

        $line_3 = new line();
        $line_3->set_default_dot_style($star_1);
        $line_3->set_width(1);
        $line_3->set_colour('#568203');
        $line_3->set_values($data_3);
        $line_3->set_key("< 10s", 10);

        $y = new y_axis();
        $y->set_range($y_axis[0], $y_axis[1], $y_axis[2]);

        $x = new x_axis();

        $x_labels = new x_axis_labels();
        $x_labels->rotate(45);
        $x_labels->set_size(12);
        $x_labels->set_labels($tanggal);
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

        $bar1 = new Bar_filled();
        $bar1->set_colour('#841B2D');
        $bar1->set_values($data_4);
        $bar1->set_tooltip('#val# %');
        $bar1->set_key("Delivered Rate", 10);


        $bar2 = new Bar_filled();
        $bar2->set_colour('#00CD66');
        $bar2->set_values($data_5);
        $bar2->set_tooltip('#val# %');
        $bar2->set_key("Delivered <10s Rate", 10);


        $y2 = new y_axis();
        $y2->set_range(0, 100, 20);

        $x2 = new x_axis();

        $x_labels2 = new x_axis_labels();
        $x_labels2->rotate(45);
        $x_labels2->set_size(12);
        $x_labels2->set_labels($tanggal);
        $x2->set_labels($x_labels2);

        $chart2 = new open_flash_chart();
        $chart2->set_title(new title('Data Graphs in %'));
        $chart2->set_y_axis($y2);
        $chart2->set_x_axis($x2);

        $chart2->add_element($bar1);
        $chart2->add_element($bar2);

        $tes = array(
            'graph' => $chart,
            'graph2' => $chart2,
            'query' => $row['query'],
            'table' => $table_name,
        );
        $this->load->view('view_sms_pb', $tes);
    }

}