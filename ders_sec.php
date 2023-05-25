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
            <title>İletişim Sayfası</title>
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


            if (isset($_GET['sinif_num'])) {
                $sinif_num = $_GET['sinif_num'];

                $sorgu = $baglanti->query("SELECT * FROM `dersler` WHERE ders_sinif='$sinif_num'");
                $katoDizi = array();
                while ($sonuc = $sorgu->fetch_assoc()) {
                    $dizi = array('id' => $sonuc['id'], 'ders_ad' => $sonuc['ders_ad']);
                    array_push($katoDizi, $dizi);
                }
            }

            ?>

            <!-- HEADER -->
            <?php 
            include 'includes/header.php';
            ?>


            <section style="margin-top:100px;">
                <div class="d-flex justify-content-center align-items-center">
                    <h1><i>BİR DERS SEÇ </i></h1>
                </div>
                <div class="container" style="margin-top:20px;">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="column menu">
                                <ul>
                                    <?php for ($i = 0; $i < count($katoDizi); $i++) { ?>
                                        <li id="ders_but" deger="<?php echo $katoDizi[$i]['id']; ?>" style="margin-top: 10px;"><button type="submit" class="btn btn-primary"> <?php echo $katoDizi[$i]['ders_ad']; ?> </button>
                                        <?php }  ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-4"> </div>
                        </div>
                    </div>
                </section>



                <!-- MODAL OLAY SECICIMI YAPILACAK -->
                <div class="modal" tabindex="-1" id="olay_secimi_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Seçilen Ders Hakkında Yapılmak İstenen Faliyet</h5>
                                <button id="close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body ">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button id="ders_hakkinda" id_ders="" class="btn btn-primary" type="button"><a href="#" style="text-decoration: none; color:white;">Ders Hakkında</a></button>

                                    <button id="ders_notlari" id_not="" class="btn btn-primary" type="button"><a href="nots.php" style="text-decoration: none; color:white;">Ders Notları</a></button>

                                    <button id="not_paylas" id_paylas="" class="btn btn-primary" type="button"><a href="paylas_not.php" style="text-decoration: none; color:white;">Not Paylaş</a></button>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button id="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--FOOTER KISMI -->

                <?php 
                include 'includes/footer.php';
                ?>



                <script>
                    $(function() {
                    // modal acma islemi
                    $(document).on('click', '#ders_but', function(e) {
                        e.preventDefault();
                        $('#olay_secimi_modal').show();
                        var ders_id_verisi=$(this).attr('deger');
                        $('#ders_hakkinda').attr('id_ders',ders_id_verisi);
                        $('#ders_notlari').attr('id_not',ders_id_verisi);
                        $('#not_paylas').attr('id_paylas',ders_id_verisi); 
                    });

                    // modal kapatma islemi
                    $(document).on('click', '#close', function(e) {
                        e.preventDefault();
                        $('#olay_secimi_modal').hide();
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


                    // 3 butondan bırıne basıldıgında sayfa yonlendırme functıondan olmalıdır
                    // dersın id sine gore yonlendırme olmalısır  
                    $(document).on('click', '#ders_hakkinda', function(e){
                        e.preventDefault();
                        var id_ders=$(this).attr('id_ders'); 
                        window.location.assign("chat.php?get_veri="+id_ders); 
                    });

                    // ders notlarını gostermek ıcın burası onemlı
                    $(document).on('click', '#ders_notlari', function(e){
                        e.preventDefault();
                        var id_not=$(this).attr('id_not'); 
                        window.location.assign("nots.php?get_veri="+id_not); 
                    });


                    // not paylaşmak içinde bu yontem kullanılmalı  
                    $(document).on('click', '#not_paylas', function(e){
                        e.preventDefault();
                        var id_paylas=$(this).attr('id_paylas'); 
                        window.location.assign("paylas_not.php?not_verileri="+id_paylas); 
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