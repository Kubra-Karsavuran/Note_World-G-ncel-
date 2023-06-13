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

            if (isset($_GET['not_verileri'])) {
                $id_paylas = $_GET['not_verileri'];

                $sonuc = mysqli_query($baglanti, "SELECT * FROM `dersler` WHERE id='$id_paylas'");
                $veri = mysqli_fetch_array($sonuc);
            }


            // dosya kaydetme islemleri var asagida


            if ($_POST) {  
                $dosya_name = $_FILES["dosya"]["name"]; 
                if (!empty($dosya_name)) { 
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $schoolnum = $_POST['schoolnum'];
                    $email = $_POST['email'];
                    $not_icerik = $_POST['not_icerik'];
                    $ders_id = $veri['id'];
                    $not_tur = $_POST['flexRadioDefault'];

                    echo "tur numarası: ".$not_tur;

                    if (empty($name) || empty($surname) || empty($schoolnum) || empty($email) || empty($ders_id) || empty($not_tur) || empty($not_icerik) ) {
                        echo "bos veri var";
                    } 
                    else {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // email dosyası

                            #////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            if ($not_tur == 2) {   // pdf işlemleri 
                                $virus_pdf=rand(0, 999999999) . $_FILES["dosya"]["name"];
                                $tasipdf = move_uploaded_file($_FILES["dosya"]["tmp_name"], $virus_pdf);
                                
                                if ($tasipdf)  
                                { 
                                    require_once('VirusTotalApiV2.php'); 
                                    $api = new VirusTotalAPIV2('7335628becc90f8ac2f24984be633d41f938def257011ce6c9876bd831e6fb19'); 
                                    $result = $api->scanFile($virus_pdf);
                                    $scanId = $api->getScanID($result);  
                                    $api->displayResult($result);

                                    if ($result->response_code==1) // 1->virus yok 0->virus var 
                                    {   
                                        $dosyaYolu = "sisteme_atilacak_nots/pdf/" . $virus_pdf;  
                                        $tasima_pdf = copy($virus_pdf, $dosyaYolu);
                                        if ($tasima_pdf) {

                                            $get_not = $baglanti->query("INSERT INTO `not_paylas`(`ad`,`soyad`,`okul_no`,`email`,`not_icerik`,`ders_id`,`not_tur`,`dosya_name`) VALUES('$name','$surname','$schoolnum','$email','$not_icerik','$ders_id','$not_tur','$virus_pdf')");

                                            if ($get_not>0) 
                                            {

                                                unlink($virus_pdf); 
                                                ?>

                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-4"></div>
                                                        <div class="col-4" style=" border-radius: 20px; ;height: 100px; background-color:  rgb(38, 183, 255);">
                                                            <h1 style="text-align:center;padding-top:20px;"> <i>İşlem Başarılı <i class="fa-solid fa-check"></i></i> </h1>
                                                        </div>
                                                        <div class="col-4"></div>
                                                    </div>
                                                </div> 

                                                <?php
                                                header("Refresh: 1;");
                                            }

                                        }else{

                                            ?> 
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-4"></div>
                                                    <div class="col-4" style=" border-radius: 20px; ;height: 100px; background-color: red;">
                                                        <h1 style="text-align:center;padding-top:20px;"> <i>Bir Sıkıntı Oluştu<i class="fa-solid fa-check"></i></i> </h1>
                                                    </div>
                                                    <div class="col-4"></div>
                                                </div>
                                            </div> 
                                            <?php 
                                            header("Refresh: 1;"); 
                                        }

                                    }else{
                                        ?> 
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-4"></div>
                                                <div class="col-4" style=" border-radius: 20px; ;height: 100px; background-color: red;">
                                                    <h1 style="text-align:center;padding-top:20px;"> <i>Virüslü Dosya<i class="fa-solid fa-check"></i></i> </h1>
                                                </div>
                                                <div class="col-4"></div>
                                            </div>
                                        </div> 
                                        <?php 
                                        header("Refresh: 1;"); 
                                    } 
                                } 
                            }


                            #////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            if ($not_tur == 1) { #resim  (calisiyo)

                                $maxboyut = 500000; 
                                $dosyaAdi = rand(0, 999999999) . $_FILES["dosya"]["name"];
                                $dosyaYolu = "sisteme_atilacak_nots/resim/" . $dosyaAdi;

                                if ($_FILES["dosya"]["size"] > $maxboyut) {
                                    echo "dosya boyutunuz olmasi gerekenden fazladir";
                                } else {

                                    $d = $_FILES["dosya"]["type"];
                                    if ($d == "image/jpeg" || $d == "image/png" || $d == "image/jpg") {

                                        $tasiresim = move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaAdi); // masaustune atıldı

                                        if ($tasiresim) {

                                            require_once('VirusTotalApiV2.php'); 
                                            $api = new VirusTotalAPIV2('7335628becc90f8ac2f24984be633d41f938def257011ce6c9876bd831e6fb19'); 
                                            $result = $api->scanFile($dosyaAdi);
                                            $scanId = $api->getScanID($result);  
                                            $api->displayResult($result); 

                                            if ($result->response_code==1) {

                                                $dosyaYolu = "sisteme_atilacak_nots/resim/" . $dosyaAdi;  
                                                $tasima_resim = copy($dosyaAdi, $dosyaYolu);

                                                if ($tasima_resim) {

                                                    $get_not = $baglanti->query("INSERT INTO `not_paylas`(`ad`,`soyad`,`okul_no`,`email`,`not_icerik`,`ders_id`,`not_tur`,`dosya_name`) VALUES('$name','$surname','$schoolnum','$email','$not_icerik','$ders_id','$not_tur','$dosyaAdi')");

                                                    if ($get_not) {

                                                        unlink($dosyaAdi);
                                                        ?>

                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-4"></div>
                                                                <div class="col-4" style=" border-radius: 20px; ;height: 100px; background-color:  rgb(38, 183, 255);">
                                                                    <h1 style="text-align:center;padding-top:20px;"> <i>İşlem Başarılı <i class="fa-solid fa-check"></i></i> </h1>
                                                                </div>
                                                                <div class="col-4"></div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        header("Refresh: 1;");

                                                    }else{
                                                        echo "vt olmadı";
                                                        header("Refresh: 1;");
                                                    }
                                                }else{
                                                    echo "olmadı";
                                                    header("Refresh: 1;");
                                                }

                                            }else{
                                                ?> 
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-4"></div>
                                                        <div class="col-4" style=" border-radius: 20px; ;height: 100px; background-color:  rgb(38, 183, 255);">
                                                            <h1 style="text-align:center;padding-top:20px;"> <i>İşlem Başarılı <i class="fa-solid fa-check"></i></i> </h1>
                                                        </div>
                                                        <div class="col-4"></div>
                                                    </div>
                                                </div>
                                                <?php
                                                header("Refresh: 1;");
                                            }

                                        }

                                    }

                                }
                            }

                            #////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            // vıdeo kısmında bıraz sacmalandı kabul edıyorum :D

                            if ($not_tur == 3) #video 
                            {  

                                class Ziple extends ZipArchive
                                { 
                                    protected $zipismi; 
                                    function __construct($isim)
                                    {
                                        $this->zipismi=$isim;
                                        $new_name=rand(0, 999999999).$isim;
                                        $full_name=$new_name.".zip";

                                        $sonuc=$this->open("sisteme_atilacak_nots/video/".$new_name.".zip", ZipArchive::CREATE);  
                                        
                                        // VERİ TABANI ISLEMİ
                                        if ($sonuc>0) 
                                        { 
                                            include 'vt/vt_baglantisi.php';

                                            $name = $_POST['name'];
                                            $surname = $_POST['surname'];
                                            $schoolnum = $_POST['schoolnum'];
                                            $email = $_POST['email'];
                                            $not_icerik = $_POST['not_icerik']; 
                                            $not_tur = $_POST['flexRadioDefault'];

                                            if (isset($_GET['not_verileri'])) {
                                                $id_paylas = $_GET['not_verileri'];

                                                $sonuc = mysqli_query($baglanti, "SELECT * FROM `dersler` WHERE id='$id_paylas'");
                                                $veri = mysqli_fetch_array($sonuc);
                                            }
                                            $ders_id=$veri['id'];

                                            $get_not = $baglanti->query("INSERT INTO `not_paylas`(`ad`,`soyad`,`okul_no`,`email`,`not_icerik`,`ders_id`,`not_tur`,`dosya_name`) VALUES('$name','$surname','$schoolnum','$email','$not_icerik','$ders_id','$not_tur','$full_name')");
                                            if ($get_not > 0) { ?> 
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-4"></div>
                                                        <div class="col-4" style=" border-radius: 20px; ;height: 100px; background-color:  rgb(38, 183, 255);">
                                                            <h1 style="text-align:center;padding-top:20px;"> <i>İşlem Başarılı <i class="fa-solid fa-check"></i></i> </h1>
                                                        </div>
                                                        <div class="col-4"></div>
                                                    </div>
                                                </div> 
                                                <?php
                                                header("Refresh: 1;");
                                            } else {
                                                echo "olmadi";
                                            }
                                        } else {
                                            echo "olmadi";
                                        }

                                    }
                                    public function veriekle($dosya)
                                    {
                                        $dizin=glob($dosya."/*");
                                        foreach ($dizin as $veri) 
                                        {
                                            if (is_dir($veri)) 
                                            {
                                                $this->veriekle($veri);
                                            }
                                            elseif(is_file($veri))
                                            {
                                                $this->addFile($veri,$veri);
                                            }
                                        }
                                    }
                                    public function remove()
                                    {
                                        if (file_exists($this->zipismi.".zip")) 
                                        {
                                            unlink($this->zipismi.".zip");
                                        }

                                    }
                                }

                                $ziple=new Ziple("yedek"); // burda verdıgımız dosya adıyla zıp olusacaktır
                                $ziple->veriekle("C:/Users/Kübra Karsavuran/Desktop/video");
                                $ziple->close();

                            }





                            #////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        }  

                    }  
                }

            }

            ?>

            <!-- HEADER -->
            <?php 
            include 'includes/header.php';
            ?>

            <?php include 'includes/slider.php'; ?>



            <!-- NOT PAYLASILAN FORM KISMI -->
            <section>
                <div class="container" style="margin-top: 100px;">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <h1 style="color: rgb(106, 90, 205);"><i>NOTLARINI HERKESLE</i></h1>
                                <h1 style="color: rgb(106, 90, 205); text-align:center; "><i>PAYLAŞ</i></h1>
                                <br>
                                <br>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">İsim :</label>
                                    <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Soyad :</label>
                                    <input type="text" class="form-control" name="surname" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Okul Numara :</label>
                                    <input type="number" class="form-control" name="schoolnum" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email :</label>
                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Not İçeriği :</label>
                                    <textarea type="email" class="form-control" name="not_icerik" aria-describedby="emailHelp"></textarea>
                                </div>
                                <!-- buna ders id ekelenecek vt icin-->
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ders :</label>
                                    <input type="text" name="<?php echo $veri['id']; ?>" value="<?php echo $veri['ders_ad']; ?>" class="form-control lesson" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <br>


                                <!-- notun turu belirleniyor-->
                                <label for="exampleInputEmail1" class="form-label">Not Türünüzü Seçin :</label>
                                <div class="form-check">
                                    <input value="2" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        PDF
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="1" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        RESİM
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="3" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        VİDEO
                                    </label>
                                </div>
                                <br>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Dosyanızı Ekleyin :</label> 
                                    <input type="file" class="form-control" name="dosya">
                                </div>

                                <button type="submit" class="btn btn-primary" class="kaydet">Kaydet</button>
                            </form>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
            </section>




            <!--FOOTER KISMI -->
            <?php 
            include 'includes/footer.php';
            ?>

            <script>
                $(function() {

                    Swal.fire({
                      title: '<strong>BİLGİLENDİRME</u></strong>',
                      icon: 'info',
                      html:
                      '<b>Video yükleyebilmeniz için masaustunuze video adında dosya açın ve yüklenecek videoyu bu dosyanın içerisine koyun, dosya yüklenecek kısmına ise herhangi bir pdf yada resim yüklemeniz gereklidir. </b>, ',  
                      showCloseButton: true, 
                      focusConfirm: false,
                      confirmButtonText:
                      '<i class="fa fa-thumbs-up"></i>Anladım ',
                      confirmButtonAriaLabel: 'Thumbs up, great!',

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