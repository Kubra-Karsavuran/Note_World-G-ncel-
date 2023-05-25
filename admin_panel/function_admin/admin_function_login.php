<?php 

session_start();

include '../../vt/vt_baglantisi.php';

// ADMİN PANEL ŞİFRESİ : çankırı dır

if (isset($_POST['admin_login'])) {

	$admin_name=$_POST['admin_name'];
	$admin_surname=$_POST['admin_surname'];
	$admin_password=$_POST['admin_password']; 
	$login_new_sifre=md5($admin_password); 


	$degerim = $baglanti->query("SELECT * FROM `login_admin` WHERE sifre='$login_new_sifre' AND name='$admin_name' AND surname='$admin_surname'");
	$veri = $degerim->num_rows;

	if ($veri>0) {
		session_regenerate_id(true);

		$_SESSION['Ip'] = $_SERVER['REMOTE_ADDR']; #OTURUM (IP)
		$_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT']; #BROVZER


		$oturum_admin = $_SERVER['REMOTE_ADDR']; #OTURUM (IP) vt için
		$browser_admin = $_SERVER['HTTP_USER_AGENT']; #BROVZER vt için

		if ($baglanti->query("UPDATE `login_admin` SET admin_ip='$oturum_admin',admin_browser='$browser_admin' where sifre='$login_new_sifre'")) {
			echo "yes";
		} else {
			echo "no";
		}
 
	} else {
		echo "no";
	} 	
}







?>