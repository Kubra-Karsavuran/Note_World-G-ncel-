<?php 

include '../../vt/vt_baglantisi.php';
 
// Yorum sılme ıslemı
if (isset($_POST['yorum_sil'])) { 
	$yorum_id=$_POST['yorum_id']; 
	if ($baglanti->query("DELETE FROM `chat_page` WHERE id='$yorum_id'")) {
		echo "yes";
	}else{
		echo "no";
	}  
}

// yorumun devamını sıleme ıslemı  
if (isset($_POST['devam_sil'])) { 
	$devam_id=$_POST['devam_id']; 
	if ($baglanti->query("DELETE FROM `chat_page` WHERE id='$devam_id'")) {
		echo "yes";
	}else{
		echo "no";
	}  
}
 
 

 

?>