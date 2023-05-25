<?php

session_start();

include '../vt/vt_baglantisi.php';


if (isset($_POST['deneme'])) {
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$school_num = $_POST['school_num'];
	$password = $_POST['password'];
	$true_password = md5($password);
	$email_login = $_POST['email_login'];

	$degerim = $baglanti->query("SELECT * FROM `login_ogrenci` WHERE sifre='$true_password' AND okul_no='$school_num' AND name='$name' AND surname='$surname' AND email='$email_login'");
	$veri = $degerim->num_rows;

	if ($veri > 0) {

		session_regenerate_id(true); #onceki seccionlardan iliskisini keser yeni bir sesin olusturmaya yarar oturum sabitleme hacker larini engellemek icin
		$_SESSION['LogedIn'] = true;

		$_SESSION['LoginIP'] = $_SERVER['REMOTE_ADDR']; #OTURUM (IP)
		$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT']; #BROVZER
		$_SESSION['email'] = $email_login;

		$gelen_kisi_ip = $_SERVER['REMOTE_ADDR']; #OTURUM (IP)  veri tabani icin 
		$gelen_kisi_brovzer = $_SERVER['HTTP_USER_AGENT']; #BROVZER  veri tabani icin

		if ($baglanti->query("UPDATE `login_ogrenci` SET admin_IP='$gelen_kisi_ip',admin_Brovser='$gelen_kisi_brovzer' where okul_no='$school_num'")) {
			echo "yes";
		} else {
			echo "no";
		}
	}
}


// yeni şifre için email kontrolu
if (isset($_POST['emailkontrolu'])) {
	$yazEmail=$_POST['yazEmail']; 
	$al = $baglanti->query("SELECT * FROM `login_ogrenci` WHERE email='$yazEmail'");
	$veri = $al->num_rows; 
	if ($veri > 0) {
		echo "var";
	}else{
		echo "yok";
	}
}


// şifre aktısleftırılıyor
if (isset($_POST['aktifles'])) {
	$creatpas=$_POST['creatpas']; 
	$seecreat=md5($creatpas);
	$guncelEmail=$_POST['guncelEmail'];

	if ($baglanti->query("UPDATE `login_ogrenci` SET sifre='$seecreat' where email='$guncelEmail'")) {
		echo "yes";
	} else {
		echo "no";
	}

}

