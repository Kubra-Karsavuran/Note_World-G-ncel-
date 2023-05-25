<?php
// disaridan sisteme girmeye calisiliyor deneme 

include 'vt/vt_baglantisi.php';
session_start();

$kontrol = mysqli_query($baglanti, "SELECT * FROM `login_ogrenci`");
$kontrol_sonuc = mysqli_fetch_array($kontrol);

$vt_ip = $kontrol_sonuc['admin_IP'];  // veri tabanindan aldigim ip degeri 
$vt_brovser = $kontrol_sonuc['admin_Brovser'];  // veri tabanindan aldigim brovser 

if (isset($_SESSION['LoginIP']) && isset($_SESSION['userAgent'])) {

    $session_ip = $_SESSION['LoginIP']; // sessionda tutulan ip degeri
    $session_brovser = $_SESSION['userAgent']; // sessionda tutulan brovser degeri 

    if ($vt_ip == $session_ip && $vt_brovser == $session_brovser) {


        include 'vt/vt_baglantisi.php'; 
        $sonuc = mysqli_query($baglanti, "SELECT * FROM `like_numbers`");
        $satir = mysqli_fetch_array($sonuc);


        if (isset($_GET['dosya_adi'])) {
 
            $deneme=$_SESSION['email'];  

            $kontrol = mysqli_query($baglanti, "SELECT * FROM `not_paylas` WHERE email='$deneme'");
            $new = mysqli_fetch_array($kontrol); 
            if ($new>0) { 

               $tur=$_GET['veri'];  
               if ($tur=="res") {  
                $dosya_adi=$_GET['dosya_adi']; 
            $myPath="sisteme_atilacak_nots/resim/".$dosya_adi; /// dosyaya ulaştık

            if (file_exists($myPath)) { //ındırılmek ıstededn dosyanın dogrulugu 
                header("Content-Disposition: File Transfer");
                header("Content-Type: application/octet-stream");
                header("Content-Disposition: attachment; filename=".$dosya_adi);
                header("Content-Transfer-Encoding:binary");
                header("Expires:0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Pragma: public");
                header("Content-Length:".filesize($myPath));
                ob_clean();
                flush();
                readfile($myPath); 
                exit();
            }else{
                echo "ındırılmek ıstenen bu dosy artada yok";
            }
        } 

        if ($tur=="video") {
            $dosya_adi=$_GET['dosya_adi'];  

            $myPath="sisteme_atilacak_nots/video/".$dosya_adi; /// dosyaya ulaştık

            if (file_exists($myPath)) { //ındırılmek ıstededn dosyanın dogrulugu 
                header("Content-Disposition: File Transfer");
                header("Content-Type: application/zip");
                header("Content-Disposition: attachment; filename=".$dosya_adi);
                header("Content-Transfer-Encoding:binary");
                header("Expires:0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Pragma: public");
                header("Content-Length:".filesize($myPath));
                ob_clean();
                flush();
                readfile($myPath); 
                exit();
            }else{
                echo "ındırılmek ıstenen bu dosy artada yok";
            }
        } 

        if ($tur=="pdf") {
            $dosya_adi=$_GET['dosya_adi']; 
            $myPath="sisteme_atilacak_nots/pdf/".$dosya_adi; /// dosyaya ulaştık

            if (file_exists($myPath)) { //ındırılmek ıstededn dosyanın dogrulugu 
                header("Content-Disposition: File Transfer");
                header("Content-Type: application/octet-stream");
                header("Content-Disposition: attachment; filename=".$dosya_adi);
                header("Content-Transfer-Encoding:binary");
                header("Expires:0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Pragma: public");
                header("Content-Length:".filesize($myPath));
                ob_clean();
                flush();
                readfile($myPath); 
                exit();
            }else{
                echo "ındırılmek ıstenen bu dosy artada yok";
            }
        }  

    }else{ ?>
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4" style=" border-radius: 20px; ;height: 200px; background-color:  red;">
                    <h1 style="text-align:center;padding-top:20px;"> <i>Not indirebilmeniz İçin Not Yüklemiş Olmanız Gerekmektedir.</i> </h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div> 
        <?php header("Refresh: 4; url=Ana_sayfa.php"); 
    }



}

?>

<!-- sayfa gelecek -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--bootstarp linki-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--font awesome den icon kullanmak için link-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!--pencere resmı-->
    <link rel="icon" type="image/png" href="resimler/logo.png">
    <title>Hocalar hakkında</title>
</head>

<body style="background-color: rgb(230,230,250);">

    <style>
        #yukari {
            text-align: center;
            background-color: green;
            width: 50px;
            height: 50px;
            border-radius: 5px 40px 20px;
        }
    </style>


    <?php

    include 'includes/header.php';
    include 'includes/slider.php';

    ?> 
    <!--notlarin oldugu sayfa--> 
    <section style="margin-bottom: 50px;margin-top:100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12  d-flex justify-content-center align-items-center">
                    <a style="width:200px;color:white;" class="btn btn-warning" data-bs-toggle="collapse" href="#pdfnots" role="button" aria-expanded="false" aria-controls="collapseExample">
                        PDF
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12  d-flex justify-content-center align-items-center">
                    <a style="width:200px;" class="btn btn-success" data-bs-toggle="collapse" href="#imagenots" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Resim
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12  d-flex justify-content-center align-items-center">
                    <a style="width:200px;" class="btn btn-danger" data-bs-toggle="collapse" href="#videonots" role="button" aria-expanded="false" aria-controls="collapseExample">
                        VİDEO
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- Burasi pdf notlari (calısıyor bır sıkıntı yok suan burda 25 Nısan)--> 
    <?php 
    include 'vt/vt_baglantisi.php';
    if (isset($_GET['get_veri'])) {
        $ders_id=$_GET['get_veri'];  
        $veri = $baglanti->query("SELECT * FROM `not_paylas` WHERE ders_id='$ders_id' AND not_tur='2'");
        $deger = $baglanti->query("SELECT * FROM `not_paylas` WHERE ders_id='$ders_id' AND not_tur='2'"); 
        $deger_control = $deger->fetch_assoc();
    } 
    ?> 
    <section style="margin-top: 100px;">
        <div class="container">
            <div class="row collapse" id="pdfnots"> 
                <?php   
                if (empty($deger_control['ad'])) { ?>
                    <p>not yok</p> 
                <?php }else{
                    while ($pdfVarmi = $veri->fetch_assoc()) {?> 
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card" id="givecolor">
                                <div class="card-body">
                                    <div style=" display: flex; ">
                                        <h4 class="card-title"><?php echo $pdfVarmi['ad']; ?></h4>
                                        <h4 class="card-title"><?php echo $pdfVarmi['soyad']; ?></h4>
                                    </div> 
                                    <h6 style="color:purple;" class="card-title">Not İçeriği :</h6>
                                    <p><?php echo $pdfVarmi['not_icerik']; ?></p>
                                    <a href="nots.php?dosya_adi=<?php echo $pdfVarmi['dosya_name']; ?>&veri=pdf"  noveri="4" class="btn btn-warning pdfdow" style="color:white;">PDF İndir</a> 
                                </div>
                            </div>
                        </div> 
                    <?php  }  }   ?> 
                </div>
            </div>
        </section>

        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <!-- Burasi resimlerin notlari -->


        <?php 
        include 'vt/vt_baglantisi.php';
        if (isset($_GET['get_veri'])) {
            $ders_id=$_GET['get_veri'];  
            $veri = $baglanti->query("SELECT * FROM `not_paylas` WHERE ders_id='$ders_id' AND not_tur='1'");
            $resim_deger = $baglanti->query("SELECT * FROM `not_paylas` WHERE ders_id='$ders_id' AND not_tur='1'");
            $resim_kontrol = $resim_deger->fetch_assoc();
        } 
        ?> 

        <section style="margin-top: 100px;">
            <div class="container">
                <div class="row collapse" id="imagenots"> 
                    <?php   

                    if (empty($resim_kontrol['ad'])) { ?>
                        <p>not yok</p>  
                    <?php }else{
                        while($resimVarmi = $veri->fetch_assoc()){ ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card" id="givecolor">
                                    <div class="card-body">
                                        <div style=" display: flex; ">
                                            <h4 class="card-title"><?php echo $resimVarmi['ad']; ?></h4>
                                            <h4 class="card-title"><?php echo $resimVarmi['soyad']; ?></h4>
                                        </div> 
                                        <h6 style="color:purple;" class="card-title">Not İçeriği :</h6>
                                        <p><?php echo $resimVarmi['not_icerik']; ?></p>
                                        <a href="nots.php?dosya_adi=<?php echo $resimVarmi['dosya_name']; ?>&veri=res" id="sinif" noveri="4" class="btn btn-success" style="color:white;">Resim İndir</a> 
                                    </div>
                                </div>
                            </div> 
                        <?php } }   ?>

                    </div>
                </div>
            </section>


            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            <!-- Burasi video larin notlari -->

            <?php 
            include 'vt/vt_baglantisi.php';
            if (isset($_GET['get_veri'])) {
                $ders_id=$_GET['get_veri'];  
                $veri = $baglanti->query("SELECT * FROM `not_paylas` WHERE ders_id='$ders_id' AND not_tur='3'");
                $video_kontrol = $baglanti->query("SELECT * FROM `not_paylas` WHERE ders_id='$ders_id' AND not_tur='3'");
                $video_deger = $video_kontrol->fetch_assoc(); 
            } 
            ?>  
            <section style="margin-top: 100px;">
                <div class="container">
                    <div class="row collapse" id="videonots"> 
                        <?php  
                        if (empty($video_deger['ad'])) { ?> 
                            <p>not yok</p> 
                        <?php }else{
                            while ($videoVarmi = $veri->fetch_assoc()) { ?>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card" id="givecolor">
                                        <div class="card-body">
                                            <div style=" display: flex; ">
                                                <h4 class="card-title"><?php echo $videoVarmi['ad']; ?></h4>
                                                <h4 class="card-title"><?php echo $videoVarmi['soyad']; ?></h4>
                                            </div> 
                                            <h6 style="color:purple;" class="card-title">Not İçeriği :</h6>
                                            <p><?php echo $videoVarmi['not_icerik']; ?></p>
                                            <a href="nots.php?dosya_adi=<?php echo $videoVarmi['dosya_name']; ?>&veri=video" id="sinif" noveri="4" class="btn btn-danger" style="color:white;">Video İndir</a> 
                                        </div>
                                    </div>
                                </div>  
                            <?php } } ?>  
                        </div>
                    </div>
                </section>





                <!--FOOTER KISMI -->
                <?php 
                include 'includes/footer.php';
                ?>

                <script>
                    $(function() {

                    // like arttirma
                        $(document).on('click', '#like_number', function(e) {
                            var like_number = $(this).attr('veri');
                            e.preventDefault();
                            $.post("function/function.php", {
                                "like_number": like_number,
                                "number_deger": "number_deger"
                            }).done(function(data) {
                                if (data == "yes") {
                                    location.reload(true);
                                } else {
                                    Swal.fire('Bir Sıkıntı Oluştu');
                                }
                            });
                        });


                    // yukari cikma tusu
                        $(window).scroll(function() {
                            if ($(this).scrollTop() >= 350) {
                                $('#yukari').fadeIn(200);
                            } else {
                                $('#yukari').fadeOut(200);
                            }
                        });

                    // Tıklama
                        $('#yukari').on('click', function() {
                            $("html, body").animate({
                                scrollTop: 0
                            }, 1000);
                        });





                    });
                </script>

            </body>

            </html>

            <?php
        } else { ?>

            <!-- login gidecek -->

            <?php 
            include 'includes/logine_gitmeli.php';
            ?>

            <?php
            header("Refresh: 2; url=login.php");
        }
    } else { ?>

        <!-- logine gidecek -->

        <?php 
        include 'includes/logine_gitmeli.php';
        ?>

        <?php
        header("Refresh: 2; url=login.php");
    }

?>