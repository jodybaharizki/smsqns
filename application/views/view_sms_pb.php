<html>
    <title>Data Grafik</title>
    <head>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".stripeMe tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
                $(".stripeMe tr:even").addClass("alt");
            });
        </script>

        <link href="<?php echo base_url(); ?>assets/css/example.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/JQueryUI/jquery.ui.all.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery.ui.core.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/json/json2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/swfobject.js"></script>
        <script type="text/javascript">
            swfobject.embedSWF("<?php echo base_url(); ?>assets/swf/open-flash-chart.swf", "my_chart", "100%", "700", "9.0.0");
        </script>
        <script type="text/javascript">
            
            $(function() {
                $( "#datepicker" ).datepicker({
                    buttonImage: "<?php echo base_url(); ?>assets/css/JQueryUI/images/calendar.gif",
                    buttonImageOnly: true,
                    dateFormat: "yy-mm-d"
                });
            });
            
            $(function(){
                
                function jsonToArray(users) {
                    var users_array = [];
                    for(var i in users) {
                        if(users.hasOwnProperty(i) && !isNaN(+i)) {
                            users_array[+i] = users[i];
                        }
                    }
                    return users_array;
                }
                
                $('#datepicker').live('change', function(e){
                    e.preventDefault();
                    var datParams = [];
                    var requiredParams = [];
                    $.each($('#datepicker'), function(e,v){
                        if ($(v).val() != "") {
                            datParams[e] = [$(v).attr('field-name'), $(v).val()];
                        }
                    });
                    datParams = JSON.stringify(datParams);
                    var templateTbody = $("#detail");
                    var pagination = $("#pagination");
                    var templateTr = $("<tr></tr>");
                    var templateTd = $("<td></td>");
                    if ($(this).val() != '') {
                        $.ajax({
                            url: "<?php echo site_url('common/filter') ?>",
                            type:'POST',
                            data: {param:datParams, required:requiredParams, table:"<?php echo $table; ?>"},
                            dataType:'json',
                            success:function(res){
                                templateTbody.html("");
                                pagination.html("");
                                $.each(res, function(e,v){
                                    var tr = templateTr.clone()
                                    .append(templateTd.clone().html(v["Date"]))
                                    .append(templateTd.clone().html(v["Brand"]))
                                    .append(templateTd.clone().html(v["Class"]))
                                    .append(templateTd.clone().html(v["Attempt_2"]))
                                    .append(templateTd.clone().html(v["Delivered"]))
                                    .append(templateTd.clone().html(v["Delivered <10s"]))
                                    .append(templateTd.clone().html(v["Delivery Rate"]))
                                    .append(templateTd.clone().html(v["Delivery <10s rate"]));
                                    templateTbody.append($(tr));
                                });
                            }
                        });
                    }else{
                    location.reload(true);
                    }
                });
                $('.filter').live('keyup', function(e){
                    e.preventDefault();
                    var datParams = [];
                    var requiredParams = [];
                    $.each($('.filter'), function(e,v){
                        if ($(v).val() != "") {
                            datParams[e] = [$(v).attr('field-name'), $(v).val()];
                        }
                    });
                    datParams = JSON.stringify(datParams);
                    var templateTbody = $("#detail");
                    var pagination = $("#pagination");
                    var templateTr = $("<tr></tr>");
                    var templateTd = $("<td></td>");
                    if ($(this).val() != '') {
                        $.ajax({
                            url: "<?php echo site_url('common/filter') ?>",
                            type:'POST',
                            data: {param:datParams, required:requiredParams, table:"<?php echo $table; ?>"},
                            dataType:'json',
                            success:function(res){
                                templateTbody.html("");
                                pagination.html("");
                                $.each(res, function(e,v){
                                    var tr = templateTr.clone()
                                    .append(templateTd.clone().html(v["Date"]))
                                    .append(templateTd.clone().html(v["Brand"]))
                                    .append(templateTd.clone().html(v["Class"]))
                                    .append(templateTd.clone().html(v["Attempt_2"]))
                                    .append(templateTd.clone().html(v["Delivered"]))
                                    .append(templateTd.clone().html(v["Delivered <10s"]))
                                    .append(templateTd.clone().html(v["Delivery Rate"]))
                                    .append(templateTd.clone().html(v["Delivery <10s rate"]));
                                    templateTbody.append($(tr));
                                });
                            }
                        });
                    }else{
                    location.reload(true);
                    }
                });
                
            });
		
            function open_flash_chart_data()
            {
                return JSON.stringify(data_1);
            }
		
            function load_1()
            {
                //                alert("Grafik data");
                tmp = findSWF("my_chart");
                x = tmp.load( JSON.stringify(data_1) );
            }
		
            function load_2()
            {
                //                alert("Grafik data dalam %");
                tmp = findSWF("my_chart");
                x = tmp.load( JSON.stringify(data_2) );
            }
	
            function findSWF(movieName) {
                if (navigator.appName.indexOf("Microsoft")!= -1) {
                    return window[movieName];
                } else {
                    return document[movieName];
                }
            }
		    
            var data_1 = <?php echo $graph->toPrettyString(); ?>;
            var data_2 = <?php echo $graph2->toPrettyString(); ?>;
            
            
            $('#rangeSearch').live('click', function(e){
                e.preventDefault();
                var templateTbody = $("#detail");
                var pagination = $("#pagination");
                var templateTr = $("<tr></tr>");
                var templateTd = $("<td></td>");
                if($('#awal').val()=='' ||$('#akhir').val()=='')alert("Anda Belum Memasukkan Tanggal");
                else{
                $.ajax({
                    url: "<?php echo site_url('common/rangeSearch') ?>",
                    type:'POST',
                    data: {awal:document.getElementById("awal").value,akhir:document.getElementById("akhir").value, table:"<?php echo $table; ?>"},
                    dataType:'json',
                    success:function(res){
                        templateTbody.html("");
                        pagination.html("");
                        $.each(res, function(e,v){
                            var tr = templateTr.clone()
                            .append(templateTd.clone().html(v["Date"]))
                            .append(templateTd.clone().html(v["Brand"]))
                            .append(templateTd.clone().html(v["Class"]))
                            .append(templateTd.clone().html(v["Attempt_2"]))
                            .append(templateTd.clone().html(v["Delivered"]))
                            .append(templateTd.clone().html(v["Delivered <10s"]))
                            .append(templateTd.clone().html(v["Delivery Rate"]))
                            .append(templateTd.clone().html(v["Delivery <10s rate"]));
                            templateTbody.append($(tr));
                        });
                    }
                });}
                    
            });
        </script>

        <style>
            .link {float:left; }

        </style>


    </head>
    <body>

        <div id="body">
            <?php $this->load->view('template/menu'); ?>
            <div id="garis"></div>
            <div id="my_chart"></div>
            <div id="link">

                <div id="hover">

                    <a href="javascript:load_1()"> <input type="button" class="button_menu" value="Grafik Data"></input></a>
                    <a href="javascript:load_2()"> <input type="button" class="button_menu" value="Grafik Data Dalam %"></input></a>
                </div>
            </div>
            <div class="middle_content">
                <table>
                    <caption>SMS Class Per Brand</caption>
                    <br/>

                    <input type="text" placeholder="Mulai Tanggal" id="awal" class="cari" style="margin-left: 55%;" /> -
                    <input type="text" placeholder="Tanggal Akhir" id="akhir" class="cari"/>
                    <input type="submit" id="rangeSearch" />

                    </br>
                    <thead><tr>
                            <th class="graph_id" width=100px title=hari>Date</th>
                            <th class="graph_id" width=70px title=tanggal>Brand</th>
                            <th class="graph_id" width=100px title=tanggal>Class</th>
                            <th class="graph_value" width=150px  title="1">Attemp 2</th>
                            <th class="graph_value" width=150px  title="2">Deliver</th>
                            <th class="graph_value" width=150px  title="3">Less 10 s</th>
                            <th class="graph_value" width=150px  title="4">Delivery Rate</th>
                            <th class="graph_value" width=150px  title="5">Delivery < 10s Rate</th>
                        </tr>
                    </thead>

                    <tr style="background-color: white;" >
                        <th  title=Date><input value="" id="datepicker" class="filter"  field-name="Date" type="text" style="width: 100px" /></th>
                        <th  title=Brand><input value="" id="box" class="filter" field-name="Brand" type="text" style="width: 90px"/></th>
                        <th  title=Class><input value="" id="box" class="filter" field-name="Class" type="text" style="width: 70px"/></th>
                        <th  title=Attempt_2><input value="" id="box" class="filter" field-name="Attempt_2" type="text" style="width: 100px"/></th>
                        <th  title=Delivered><input value="" id="box" class="filter" field-name="Delivered" type="text" style="width: 100px"/></th>
                        <th  title=Delivered_10s><input value="" id="box" class="filter" field-name="Delivered <10s" type="text" style="width: 120px"/></th>
                        <th  title=Delivery_Rate><input value="" id="box" class="filter" field-name="Delivery Rate" type="text" style="width: 80px"/></th>
                        <th  title=Delivery_10s_rate><input value="" id="box" class="filter" field-name="Delivery <10s rate" type="text" style="width: 100px"/></th>
                    </tr>
                    <table>
                        <tbody id="detail">

                            <?php
                            foreach ($query as $row) {
                                echo "<tr><td>" . $row['Date'] . "</td><td>" . $row['Brand'] . "</td><td>" . $row['Class'] . "</td><td>"
                                . $row['Attempt_2'] . "</td><td>" . $row['Delivered'] . "</td><td>" . $row['Delivered <10s'] . "</td><td>"
                                . $row['Delivery Rate'] . "%" . "</td><td>" . $row['Delivery <10s rate'] . "%" . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
            <div id="pagination">
                <?php echo $this->pagination->create_links(); ?>
            </div>
            <br/>

            <div id="footer">

                <div id="footer1"><h6>copyright totalindo.co.id 2012</h6></div>

            </div>

        </div>

    </body>
</html>