<?php

include '../vt/vt_baglantisi.php';

if (isset($_POST['yorum_fun'])) {
  
	$isim = $_POST['isim'];
	$soyad = $_POST['soyad'];
	$okul_num = $_POST['okul_num'];
	$yorumum = $_POST['yorumum']; 
	$hangi_ders = $_POST['hangi_ders'];

	if ($baglanti->query("INSERT INTO `chat_page`(`name`, `surname`, `okul_no`, `yorum`, `yorum_yapilan_ders_id`, `yorum_like`, `kime_yorum`) VALUES ('$isim','$soyad','$okul_num','$yorumum','$hangi_ders','0','0')")) {
		echo "oldu";
	}else{
		echo "olmadı";
	}
 
}
 
 
if (isset($_POST['like_point'])) {
	$like_sayisi = $_POST['like_number'];
	$yorum_id = $_POST['yorum_number']; 
	$veri=$like_sayisi+1; 

	if ($baglanti->query("UPDATE `chat_page` SET `yorum_like`='$veri' WHERE id='$yorum_id'")) {
		echo "oldu";
	} else {
		echo "olmadı";
	} 
}


// yorumun yorum ları gosterılecek  
if (isset($_POST['yorumayorum_yap'])) {
	$yorumyapacagi_id = $_POST['yorumyapacagi_id']; 
	$veriler=$baglanti->query("SELECT * FROM `chat_page` WHERE kime_yorum='$yorumyapacagi_id'");
	$yaz = $veriler->fetch_assoc(); 
	$json=array( 
		"name"=>$yaz['name'],  
		"surname"=>$yaz['surname'],   
		"yorum"=>$yaz['yorum'], 
		"yorum_like"=>$yaz['yorum_like'] 
	); 
	echo json_encode($json,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  
}


// yoruma yorum yap kısmı 

if (isset($_POST['yoruma_yorum_yap_hadi'])) {
   
	$isim = $_POST['isim'];
	$soyad = $_POST['soyad'];
	$okul_num = $_POST['okul_num'];
	$yorumum = $_POST['yorumum']; 
	$kime_yorum = $_POST['kime_yorum'];
	$hangi_ders_kat = $_POST['hangi_ders_kat'];
   
	if ($baglanti->query("INSERT INTO `chat_page`(`name`,`surname`,`okul_no`,`yorum`,`yorum_yapilan_ders_id`,`yorum_like`,`kime_yorum`) VALUES('$isim','$soyad','$okul_num','$yorumum','$hangi_ders_kat','0','$kime_yorum')")) {
		echo "oldu";
	}else{
		echo "olmadı";
	}
 
}

// yorumun yorumlarına lıke ıslemılerını yapıyorum 

if (isset($_POST['yor_yor_id'])) {
	$id_sayisi = $_POST['yorumun_yorumu_id'];
	$yor_yor_like = $_POST['yor_yor_like'];
	$veri=$yor_yor_like+1; 
	
	if ($baglanti->query("UPDATE `chat_page` SET `yorum_like`='$veri' WHERE id='$id_sayisi'")) {
		echo "oldu";
	} else {
		echo "olmadı";
	} 
}



?>