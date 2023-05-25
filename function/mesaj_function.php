<?php

include '../vt/vt_baglantisi.php';

if (isset($_POST['ileti_fun'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $message = $_POST['message'];
    $gmail = $_POST['gmail'];

    if ($baglanti->query("INSERT INTO `mesaj`(`ad`,`soyad`,`email`,`mesaj`) VALUES('$name','$surname','$gmail','$message' )")) {
        echo "oldu";
    } else {
        echo "olmadı";
    }
}
