<div id="header"><img src="<?php echo base_url(); ?>assets/css/images/header.jpg"></div>
<div id="search"><input type="text" class="inputan" placeholder="search"><img src="<?php echo base_url(); ?>assets/css/images/url.png" width="30px" height="30px"></div>
<div id="garis"></div>
<a href="<?php echo base_url()?>login_admin/proses_logout" style="margin-left: 96%;">Log Out</a>
<div id ="link">
    <table id="hover" >
        <tr><td id="hover"><?php echo anchor('sms_class_pb1/index/', 'SMS Class per Brand 1', array('class' => 'index')); ?></td>	
            <td><?php echo anchor('sms_class_pb2/index/', 'SMS Class per Brand 2', '', array('class' => 'index')); ?></td>
            <td><?php echo anchor('sms_class_pb3/index/', 'SMS Class per Brand 3', array('class' => 'index')); ?></td>	
            <td><?php echo anchor('sms_class_pb4/index/', 'SMS Class per Brand 4', array('class' => 'index')); ?></td></tr>
        <tr><td><?php echo anchor('sms_class_pb5/index/', 'SMS Class per Brand 5', array('class' => 'index')); ?></td>	
            <td><?php echo anchor('sms_class_pb6/index/', 'SMS Class per Brand 6', array('class' => 'index')); ?></td>
            <td><?php echo anchor('sms_class_pb7/index/', 'SMS Class per Brand 7', array('class' => 'index')); ?></td>	
            <td><?php echo anchor('sms_class_pb8/index/', 'SMS Class per Brand 8', array('class' => 'index')); ?></td></tr>
        <tr><td><?php echo anchor('est_msc_onn_pr/index/', 'Est MSC Onnet', array('class' => 'index')); ?></td>
            <td><?php echo anchor('est_msc_offn_pr/index/', 'Est MSC Offnet', array('class' => 'index')); ?></td>
            <td><?php echo anchor('est_msc_all_pr/index/', 'Est MSC All', array('class' => 'index')); ?></td>
            <td><?php echo anchor('est_msc_p2p_pr/index/', 'Est MSC P2P', array('class' => 'index')); ?></td></tr>		
    </table>


</div>
