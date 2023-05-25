<?php
include '../vt/vt_baglantisi.php';

if (isset($_POST['number_deger'])) {
    $like_number = $_POST['like_number'];
    $deger = $like_number + 1;
    if ($baglanti->query("UPDATE `like_numbers` SET `like_number`='$deger' WHERE id='1'")) {
        echo "yes";
    } else {
        echo "no";
    }
}

 
