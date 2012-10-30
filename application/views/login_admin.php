<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Halaman Login</title>

<?php $this->load->helper('html');
echo link_tag('assets/css/login_admin.css')?>

    </head>
    <body>

   
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="loginform">
                    <tr>
                        <th>LOGIN ADMIN<br/><br/></th>
                    </tr>
                    <tr>
                        <td>
                        <?php
                            $attributes = array('name'=>'login_form','id'=>'login_form');
                            echo form_open('login_admin/proses_login',$attributes);
                        ?>
                           
                            <label for="username">Username
                                <input type="text" name="username" required='required' autofocus="autofocus" class="form_field" value="<?php echo set_value('username');?>"/>
                            </label>
                            <label for="password">Password
                                <input type="password" name="password"  required='required' class="form_field" style="margin-top:5px" value="<?php echo set_value('password');?>" />
                            </label>
                            
                                                         
                                <input type="submit" name="button" value="login" />
                                
                            
                                <?php $message = $this->session->flashdata('message'); echo $message == ''?'':$message; ?>
                            
                            </td>                               
                    </tr>
                </table>
    </body>
</html>