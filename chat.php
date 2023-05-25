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

            // ustune bastıgım dersın ıd sı burda 
            $id_ders=$_GET['get_veri']; 
            $write_yorumlar = $baglanti->query("SELECT * FROM `chat_page` WHERE kime_yorum=0 AND yorum_yapilan_ders_id='$id_ders'");

            $trytext = $baglanti->query("SELECT * FROM `chat_page` WHERE kime_yorum=0 AND yorum_yapilan_ders_id='$id_ders'");
            $try = $trytext->fetch_assoc();
            ?>

            <!-- HEADER -->
            <?php 
            include 'includes/header.php'; 
            ?>
            


            <!-- SECTİON KISMI TASARLANACAK -->

            <div class="container" style="margin-top:100px">
                <div class="row">   
                    <div class="col-lg-8 col-sm-12" style="background-color:white;border-radius: 20px;">
                        <h3 style="color:purple;">Yorumlar</h3>
                        <!--tekrarlayacak kısım-->
                        <?php while($get_yorumlar = $write_yorumlar->fetch_assoc()){ ?>
                            <div class="d-flex text-muted pt-3">
                                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6f42c1"/><text x="50%" y="50%" fill="#6f42c1" dy=".3em"></text></svg>
                                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                    <div class="d-flex justify-content-between">
                                        <strong class="text-gray-dark"><?php echo $get_yorumlar['name']; echo $get_yorumlar['surname'];?></strong>   
                                    </div>
                                    <span class="d-block"> <?php echo $get_yorumlar['yorum']; ?></span> 
                                    <br>
                                    <a id="see" yorum_id="<?php echo $get_yorumlar['id']; ?>" like_sayisi="<?php echo $get_yorumlar['yorum_like']; ?>" style="margin-right:20px;text-decoration:none;" href="#">Like <?php echo $get_yorumlar['yorum_like']; ?></a>  
                                    <a style="margin-right:20px;text-decoration:none;" yorum_id="<?php echo $get_yorumlar['id']; ?>" id="fikir" href="#">Yoruma Yorum Yap</a> 
                                    <a  style="text-decoration:none;" href="yorumun_devam_oku.php?refresh=<?php echo $get_yorumlar['id']; ?>">Devamını Oku</a>  
                                </div>
                            </div>
                        <?php } ?>

                        <?php 
                        if (empty($try['name'])) { ?>
                            <div id="yorum_yok">
                                <h4 style="color: orange;">Bu Ders İle İlgili Yorum Yapılmamıştır</h4>
                            </div>
                        <?php } ?>

                        
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <!-- devamını oku denınce bu form kalkacak yerıne chat sayfası gelecek o  yorumun devamı yani -->
                        <form id="yorum_yap_form" >
                            <h3 style="color:blue;">Yorum Yap</h3>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ad</label>
                                <input id="yo_name" type="text" class="form-control isim" id="exampleInputEmail1 " aria-describedby="emailHelp"> 
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Soyad</label>
                                <input id="yo_surname" type="text" class="form-control soyad" id="exampleInputEmail1 " aria-describedby="emailHelp"> 
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Okul Numarası</label>
                                <input id="yo_number" type="number" class="form-control okul_num" id="exampleInputEmail1 " aria-describedby="emailHelp"> 
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Yorumun</label>
                                <textarea id="yo_yorum" type="text" class="form-control yorumum" id="exampleInputPassword1 "></textarea> 
                            </div> 
                            <button id="yorum_butonu" hangi_ders="<?php echo $id_ders; ?>" type="submit" class="btn btn-primary">Yorumu Paylaş</button>
                        </form>

                        <form id="fikir_form" >
                            <h3 id="baslik" kime_yorum="" style="color:blue;">Yoruma Yorum Kat</h3>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ad</label>
                                <input id="yo_name_ka" type="text" class="form-control isim" id="exampleInputEmail1 " aria-describedby="emailHelp"> 
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Soyad</label>
                                <input id="yo_surname_ka" type="text" class="form-control soyad" id="exampleInputEmail1 " aria-describedby="emailHelp"> 
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Okul Numarası</label>
                                <input id="yo_number_ka" type="number" class="form-control okul_num" id="exampleInputEmail1 " aria-describedby="emailHelp"> 
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Yorumun</label>
                                <textarea id="yo_yorum_ka" type="text" class="form-control yorumum" id="exampleInputPassword1 "></textarea> 
                            </div> 
                            <button id="yorum_butonu_ka" type="submit" hangi_ders_kat="<?php echo $id_ders; ?>" class="btn btn-primary">Yorumu Paylaş</button>
                            <button type="button" class="btn btn-secondary" id="pencere_kapa">Pencereyi Kapat</button>
                        </form>

                    </div>
                </div> 
            </div>


            <!-- SECTİON KISMI TASARLANACAK -->


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


                    $(document).on('click','#pencere_kapa',function(e){
                        e.preventDefault();
                        $('#yorum_yap_form').show();
                        
                        $('#yorumun_name_surname').text(''); 
                        $('#yorumun_yorumu').text('');
                        $('#yorumun_like').text('');
                        window.location.reload();  
                    });


                    //yorum yapma form kodları (yapıldı)
                    $(document).on('click','#yorum_butonu',function(e){
                        e.preventDefault();
                        var isim=$('.isim').val();
                        var soyad=$('.soyad').val();
                        var okul_num=$('.okul_num').val();
                        var yorumum=$('.yorumum').val();
                        var hangi_ders=$(this).attr('hangi_ders');

                        if(isim == "" || soyad == "" || okul_num == "" || yorumum == ""){ 
                            Swal.fire('Boş Veri Bırakmayın !!!');
                        }else{
                            $.post("function/yorum_paylas.php", {
                               "isim": isim,
                               "hangi_ders": hangi_ders,
                               "soyad": soyad,
                               "okul_num": okul_num,
                               "yorumum": yorumum,
                               "yorum_fun": "yorum_fun"
                           }).done(function(data){
                            if(data=="oldu"){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Yorumunuz Paylaşıldı',
                                    showConfirmButton: false,
                                    timer: 1500
                                }); 
                            }
                        });

                       }
                   });

                    $(document).on('click','#see',function(e){
                     e.preventDefault();
                     var like_number=$(this).attr('like_sayisi');
                     var yorum_number=$(this).attr('yorum_id'); 

                     $.post("function/yorum_paylas.php", { 
                       "like_number": like_number,
                       "yorum_number": yorum_number,
                       "like_point": "like_point"
                   }).done(function(data){ 
                    if(data){
                        window.location.reload();
                    }else{
                        alert("Bir Hata Oluştu Yetkililere Bildiriniz");
                    }
                });

               });



                    //// yoruma yorum yap 
                    $('#fikir_form').hide();
                    $(document).on('click','#fikir',function(e){ 
                        e.preventDefault();

                        $('#yorum_yap_form').hide();
                        $('#fikir_form').show();
                        var kime_yorum=$(this).attr('yorum_id'); 
                        $('#baslik').attr('kime_yorum',kime_yorum);  
                    });


                    // yoruma yorum yap formu yapılıyor buda 
                    $('#fikir_form').hide();
                    $(document).on('click','#yorum_butonu_ka',function(e){ 
                        e.preventDefault();
                        var isim=$('#yo_name_ka').val();
                        var soyad=$('#yo_surname_ka').val();
                        var okul_num=$('#yo_number_ka').val();
                        var yorumum=$('#yo_yorum_ka').val();
                        var kime_yorum=$('#baslik').attr('kime_yorum');
                        var hangi_ders_kat=$(this).attr('hangi_ders_kat');

                        if(isim == "" || soyad == "" || okul_num == "" || yorumum == ""){ 
                            Swal.fire('Boş Veri Bırakmayın !!!');
                        }else{
                            $.post("function/yorum_paylas.php", {
                             "isim": isim,
                             "soyad": soyad,
                             "okul_num": okul_num,
                             "yorumum": yorumum,
                             "kime_yorum": kime_yorum,
                             "hangi_ders_kat": hangi_ders_kat,
                             "yoruma_yorum_yap_hadi": "yoruma_yorum_yap_hadi"
                         }).done(function(data){ 
                            if(data=="oldu"){
                                alert("İşleminiz Başarıyla Yapıldı"); 
                                window.location.reload();
                            }
                        });

                     }   
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