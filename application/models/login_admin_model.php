<?php
/////////////// ---PSB Online---//////////////
//											//
//   Tugas Akhir SMK TELKOM SP Malang 2012  //
//		Cindy Adistya A		: Mojokerto		//
//		Nurul Huda Mustaqim : Trenggalek	//
//		Susi Octalana 		: Malang		//
//		----------------------------------	//
//		Pembimbing : Rahmat D. Djatmiko     //
//////////////////////////////////////////////
?>
<?php
class Login_admin_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    var $table='admin';
    function check_user($username,$password){
        $query=$this->db->get_where($this->table,array('username'=>$username,'password'=>$password),1,0);
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
