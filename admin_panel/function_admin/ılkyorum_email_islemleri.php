<?php 

include '../../vt/vt_baglantisi.php';

// formdan gelıyor yoruma cevap ver kısmı

if (isset($_POST['email_islemi'])) {
	$yorum_id=$_POST['yorum_id'];

	$veriler=$baglanti->query("SELECT * FROM `chat_page` WHERE id='$yorum_id'");
	$yaz = $veriler->fetch_assoc();
	$okul_no=$yaz['okul_no'];

	$mail_bul=$baglanti->query("SELECT * FROM `login_ogrenci` WHERE okul_no='$okul_no'");
	$mail_write = $mail_bul->fetch_assoc();

	// bu bulunan emaile mesaj atılacak
	
	echo $mail_write['email'];
}
?>