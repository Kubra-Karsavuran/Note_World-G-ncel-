<?php 

include '../../vt/vt_baglantisi.php';


// yorumun yorum ları gosterılecek  
if (isset($_POST['guncel_veri_see'])) {
	$guncell_id = $_POST['guncell_id']; 
	$veriler=$baglanti->query("SELECT * FROM `login_ogrenci` WHERE id='$guncell_id'");
	$yaz = $veriler->fetch_assoc(); 
	$json=array( 
		"id"=>$yaz['id'], 
		"name"=>$yaz['name'],  
		"surname"=>$yaz['surname'],   
		"okul_no"=>$yaz['okul_no'], 
		"email"=>$yaz['email'] 
	); 
	echo json_encode($json,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  
}


// guncelleme ıslemı yapılacak sıte gırenlerın
if (isset($_POST['guncellenecek'])) { 
	$guncelle_veri=$_POST['guncelle_veri']; 

	$gun_ad=$_POST['gun_ad'];
	$gun_soy=$_POST['gun_soy'];
	$gun_okul=$_POST['gun_okul'];
	$gun_em=$_POST['gun_em'];

	if ($baglanti->query("UPDATE `login_ogrenci` SET `name`='$gun_ad', `surname`='$gun_soy', `okul_no`='$gun_okul', `email`='$gun_em', `sifre`='1', `admin_IP`='1', `admin_Brovser`='1' WHERE id='$guncelle_veri'")) {
		echo "yes";
	}else{
		echo "no";
	}  
}


// log guncelleme ıslemı
// guncelleme ıslemı yapılacak sıte gırenlerın
if (isset($_POST['log_ekle'])) { 

	$log_em=$_POST['log_em'];  
	$log_okul=$_POST['log_okul'];
	$log_so=$_POST['log_so'];
	$log_ad=$_POST['log_ad']; 

	if ($baglanti->query("INSERT INTO `login_ogrenci`(`name`,`surname`,`okul_no`,`email`,`sifre`,`admin_IP`,`admin_Brovser`) VALUES('$log_ad','$log_so','$log_okul','$log_em','1','1','1')")) {
		echo "yes";
	}else{
		echo "no";
	}  
}

// not sılme ıslemı 
if (isset($_POST['not_sil'])) {
	$sil_not=$_POST['sil_not']; 
 
	$dosya_bul = mysqli_query($baglanti, "SELECT * FROM `not_paylas` WHERE id='$sil_not'");
	$dosya_sil = mysqli_fetch_array($dosya_bul);

	$not_tur=$dosya_sil['not_tur'];
	if ($not_tur=='1') {           // RESİM
		$veri=$dosya_sil['dosya_name']; 
		$ol=array_map('unlink', glob("../../sisteme_atilacak_nots/resim/$veri"));
		if($ol){ 
			if ($baglanti->query("DELETE FROM `not_paylas` WHERE id='$sil_not'")) {
				echo "yes";
			}else{
				echo "no";
			} 
		}else{
			echo "gelmedi";
		}

	}
	if($not_tur=='2') {             //PDF
		$veri=$dosya_sil['dosya_name'];
		$sil_not=$_POST['sil_not'];
		//unlink("../../sisteme_atilacak_nots/pdf/$veri"); 
		$del = @unlink("../../sisteme_atilacak_nots/pdf/$veri");
		if($del){
			if ($baglanti->query("DELETE FROM `not_paylas` WHERE id='$sil_not'")) {
				echo "yes";
			}else{
				echo "no";
			} 
		}else{
			echo "gelmedi";
		}
	}
	if($not_tur=='3'){              //VİDEO
		$veri=$dosya_sil['dosya_name'];
		$sil_not=$_POST['sil_not'];
		///unlink("../../sisteme_atilacak_nots/video/$veri"); 
		$del = @unlink("../../sisteme_atilacak_nots/video/$veri");
		if($del){
			if ($baglanti->query("DELETE FROM `not_paylas` WHERE id='$sil_not'")) {
				echo "yes";
			}else{
				echo "no";
			} 
		}else{
			echo "gelmedi";
		}
	}

}


// ders silme işlemi
if (isset($_POST['ders_delete'])) {
	$ders_id_verisi=$_POST['ders_id_verisi'];
	if ($baglanti->query("DELETE FROM `dersler` WHERE id='$ders_id_verisi'")) {
		echo "yes";
	}else{
		echo "no";
	} 
}

// ders ekleme ıslemı 
if (isset($_POST['addclass'])) {
	$sinif_ekle=$_POST['sinif_ekle'];
	$ders_ad=$_POST['ders_ad'];
	if ($baglanti->query("INSERT INTO `dersler`(`ders_ad`,`ders_sinif`) VALUES('$ders_ad','$sinif_ekle')")) {
		echo "yes";
	}else{
		echo "no";
	}  
}

// hocaları silme işlemi
if (isset($_POST['silme_islemi'])) {
	$hoca_id=$_POST['hoca_id'];
	if ($baglanti->query("DELETE FROM `hoca_veri` WHERE id='$hoca_id'")) {
		echo "yes";
	}else{
		echo "no";
	} 
}


// iletisim silme islemleri

if (isset($_POST['iletisim_sil'])) {
	$iletisim_id=$_POST['iletisim_id'];
	if ($baglanti->query("DELETE FROM `iletisim_bilgileri` WHERE id='$iletisim_id'")) {
		echo "yes";
	}else{
		echo "no";
	} 
}

// iletisim guncelleme ıslemı yapacaz sımdı  
if (isset($_POST['iletisim_guncelle'])) { 

	$face=$_POST['face'];
	$google=$_POST['google']; 
	$linkedin=$_POST['linkedin'];
	$twit=$_POST['twit'];
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$footer_metin=$_POST['footer_metin']; 
	if ($baglanti->query("UPDATE `iletisim_bilgileri` SET `face`='$face', `google_site`='$google', `linkedin`='$linkedin', `twit`='$twit', `tel`='$tel', `email`='$email', `footer_metin`='$footer_metin' WHERE id='1'")) {
		echo "yes";
	}else{
		echo "no";
	}  

}


// hocaların guncelleme ıslemı  
if (isset($_POST['hoca_gunceleme'])) {  
	$hoca_veri=$_POST['hoca_veri'];
	$ad=$_POST['ad']; 
	$soyad=$_POST['soyad'];
	$gorev=$_POST['gorev'];
	$akademik=$_POST['akademik'];
	$mezun=$_POST['mezun'];
	$email=$_POST['email']; 
	$tel=$_POST['tel'];
	$ofis_yeri=$_POST['ofis_yeri'];
	$foto=$_POST['foto'];
	$web_site=$_POST['web_site']; 
	if ($baglanti->query("UPDATE `hoca_veri` SET `web_site`='$web_site', `foto`='$foto', `ad`='$ad', `soyad`='$soyad', `gorev`='$gorev', `akademik`='$akademik', `mezun`='$mezun', `email`='$email', `tel`='$tel', `ofis_yeri`='$ofis_yeri' WHERE id='$hoca_veri'")) {
		echo "yes";
	}else{
		echo "no";
	}   
}


// Hoca kaydetme işlemi 
if (isset($_POST['ogretmen_ekle'])) { 
	$yeni_ad=$_POST['yeni_ad']; 
	$yeni_soyad=$_POST['yeni_soyad'];
	$yeni_gorev=$_POST['yeni_gorev'];
	$yeni_akademik=$_POST['yeni_akademik'];
	$yeni_mezun=$_POST['yeni_mezun'];
	$yeni_email=$_POST['yeni_email']; 
	$yeni_tel=$_POST['yeni_tel'];
	$yeni_ofis_yeri=$_POST['yeni_ofis_yeri'];
	$yeni_foto=$_POST['yeni_foto'];
	$yeni_web_site=$_POST['yeni_web_site']; 

	if ($baglanti->query("INSERT INTO `hoca_veri`(`web_site`,`foto`,`ad`,`soyad`,`gorev`,`akademik`,`mezun`,`email`,`tel`,`ofis_yeri`) VALUES('$yeni_web_site','$yeni_foto','$yeni_ad','$yeni_soyad','$yeni_gorev','$yeni_akademik','$yeni_mezun','$yeni_email','$yeni_tel','$yeni_ofis_yeri')")) {
		echo "yes";
	}else{
		echo "no";
	}  
}

// siteden atılan mesajaların sılınme ıslemı
if (isset($_POST['mesaj_sil'])) {
	$sil_id=$_POST['sil_id'];
	if ($baglanti->query("DELETE FROM `mesaj` WHERE id='$sil_id'")) {
		echo "yes";
	}else{
		echo "no";
	} 
}


?>