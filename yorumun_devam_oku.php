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

    if ($vt_ip == $session_ip && $vt_brovser == $session_brovser) {  ?>

        <!-- chat sayfa gelecek -->

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
            include 'vt/vt_baglantisi.php';

            $sonuc = mysqli_query($baglanti, "SELECT * FROM `like_numbers`");
            $satir = mysqli_fetch_array($sonuc);

            if (isset($_GET['refresh'])) {
                $veri=$_GET['refresh'];

                // bas verı 
                $kime = $baglanti->query("SELECT * FROM `chat_page` WHERE id='$veri'");
                $kime_git = $kime->fetch_assoc();

                // yorumun yorumlarını ortaya sıralamak ıcın yazdım bakalım ne olacak  
                $yorum_sirala = $baglanti->query("SELECT * FROM `chat_page` WHERE kime_yorum='$veri'");
                $deneme = $yorum_sirala->fetch_assoc();

                $yorum_si = $baglanti->query("SELECT * FROM `chat_page` WHERE kime_yorum='$veri'");
                
                
            } 
            

            ?>

            <!-- HEADER -->
            <?php 
            include 'includes/header.php';
            ?>



            <!-- SECTİON KISMI TASARLANACAK START -->


            <div class="container" style="margin-top:100px">
                <div class="row">   
                    <div class="col-lg-12 col-sm-12" style="background-color:white;border-radius: 20px;">
                        <h3 style="color:purple;">Yorumun Yorumları</h3>
                        <p>--->  Adı-Soyad: <?php echo $kime_git['name']; ?></p>
                        <p>--->  Yorum: <?php echo $kime_git['yorum']; ?></p>

                        <?php if (empty($deneme['name'])) { ?>

                            <div style="background-color:pink; border-radius: 15px; ">
                                <h3 style="color:grey;">Bu Yorumun Yorumu Bulunmamaktadır</h3>
                            </div>
                            
                        <?php } ?> 

                        
                        <?php while($yorum_get = $yorum_si->fetch_assoc()){ ?>
                            <div class="d-flex text-muted pt-3">
                                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6f42c1"/><text x="50%" y="50%" fill="#6f42c1" dy=".3em"></text></svg>
                                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                    <div class="d-flex justify-content-between">
                                        <strong class="text-gray-dark"> <?php echo $yorum_get['name']." ".$yorum_get['surname']; ?></strong>   
                                    </div>
                                    <span class="d-block"><?php echo $yorum_get['yorum']; ?></span> 
                                    <br>
                                    <a id="like_get" yorumun_yorumu="<?php echo $yorum_get['id']; ?>" yor_yor_like="<?php echo $yorum_get['yorum_like']; ?>" style="margin-right:20px;text-decoration:none;" href="#">Like <?php  echo $yorum_get['yorum_like']; ?> </a>   
                                </div>
                            </div>
                        <?php } ?> 
                    </div> 
                </div> 
            </div>
            
            <!-- SECTİON KISMI TASARLANACAK FINISH -->
            
            <!--FOOTER KISMI -->
            <?php 
            include 'includes/footer.php';
            ?>

            <script>
                $(function() {

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


                    /// yoruma lıke atma kısmını yaptım asada 

                    $(document).on('click', '#like_get', function(e) {
                        var yorumun_yorumu_id = $(this).attr('yorumun_yorumu');
                        var yor_yor_like = $(this).attr('yor_yor_like');
                        e.preventDefault();  
                        $.post("function/yorum_paylas.php", {
                            "yorumun_yorumu_id": yorumun_yorumu_id,
                            "yor_yor_like": yor_yor_like,
                            "yor_yor_id": "yor_yor_id"
                        }).done(function(data) { 
                            if (data == "oldu") {
                                location.reload(true);
                            } else {
                                Swal.fire('Bir Sıkıntı Oluştu');
                            }
                        });
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