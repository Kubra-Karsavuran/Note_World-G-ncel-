<?php

session_start(); // session baslatma kodu oluyor

session_unset(); // session silme kodlari
session_destroy();

echo "<h1>SİTEDEN ÇIKIŞ YAPIYORSUNUZ !!</h1>";

header("Refresh: 2; url=login.php");
