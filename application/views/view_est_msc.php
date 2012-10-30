<html>
    <head>
        <link href="<?php echo base_url(); ?>assets/css/example.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/json/json2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/swfobject.js"></script>
        <script type="text/javascript">
            swfobject.embedSWF("<?php echo base_url(); ?>/assets/swf/open-flash-chart.swf", "my_chart", "100%", "700", "9.0.0");
        </script>
        <script type="text/javascript">
            function open_flash_chart_data()
            {
                return JSON.stringify(data);
            }
            function findSWF(movieName) {
                if (navigator.appName.indexOf("Microsoft")!= -1) {
                    return window[movieName];
                } else {
                    return document[movieName];
                }
            }
            var data = <?php echo $graph->toPrettyString(); ?>;
        </script>
        <style>
            .link {float:left; }

        </style>


    </head>
    <body>

        <div id="body">
            <?php $this->load->view('template/menu');?>

            <div id="my_chart"></div>

            <div class="middle_content">
                <table>
                    <caption>Est MSC</caption>
                    <thead><tr>
                            <th class="graph_id" width=100px title=region>Region</th>
                            <th class="graph_value" width=150px  title="1">Attemp 1</th>
                            <th class="graph_value" width=150px  title="2">Delivered Total</th>
                            <th class="graph_value" width=150px  title="3">Delivered < 10 s</th>

                        </tr>
                    </thead><tbody>

                        <?php
                        foreach ($query as $row) {
                            echo "<tr><td>" . $row['Region'] . "</td><td>" . $row['Attempt'] . "</td><td>"
                            . $row['Delivered (total)'] . "</td><td>" . $row['Delivered (<10s)'] . "</td></tr>";
                        }
                        ?>

                    </tbody></table>
            </div>
            <?php echo $this->pagination->create_links(); ?>
            <br/>

            <div id="footer">

                <div id="footer1"><h6>copyright totalindo.co.id 2012</h6></div>

            </div>

        </div>

    </body>
</html>