<?php

// asadakı kod parcası ınclude edılmelıydı fakat anlasılmayan bır hata sonucu boyle 
// bır coxum bulundusonuc olarak calısıyor :D

$baglanti = new mysqli('localhost', 'root', '', 'bitirme');
if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

$baglanti->set_charset("utf8");

 
$kontrol = mysqli_query($baglanti, "SELECT * FROM `iletisim_bilgileri`");
$iletisim_get = mysqli_fetch_array($kontrol);
?>


<footer style="width: 100%;border-radius: 20px; height: 550px; margin-top: 100px; background-color: rgb(149, 117, 205); ">

	<!-- yukari cikma tus kodu-->
	<div id="yukari">
		<i class="fa fa-arrow-up"></i>
	</div>

	<div class="container">
		<div class="row">
			<div class=" col-lg-4 col-md-12 ">
				<div style="margin-top: 50px;">
					<h5 style="color: rgb(240,255,255);"> <i>ÖĞRENCİ NOT SİSTEMİ</i> </h5>
					<p style="color: rgb(240,255,255);"><?php echo $iletisim_get['footer_metin']; ?></p>
				</div>
			</div>

			<div class=" col-lg-4 col-md-12 ">
				<div style="margin-top: 50px;">
					<h5 style="color: rgb(240,255,255);"><i>İLETİŞİM İÇİN:</i></h5>
					<button type="button" class="btn btn-secondary"><a style="text-decoration: none;color: rgb(240,255,255);" href="iletisim.php">İletişim</a></button>
				</div>
			</div>

			<div class="col-lg-4 col-md-12">
				<i>
					<h4 style=" color: rgb(240,255,255); margin-top: 50px;">İLETİŞİM BİLGİLERİ</h4>
				</i>
				<a href="<?php echo $iletisim_get['face']; ?>"><img src="ico/f.png" style="width: 30px; height: 30px;"></a>
				<a href="<?php echo $iletisim_get['google_site']; ?>"><img src="ico/g.png" style="width: 30px; height: 30px; margin-left: 20px;"></a>
				<a href="<?php echo $iletisim_get['linkedin']; ?>"><img src="ico/l.png" style="width: 30px; height: 30px; margin-left: 20px;"></a>
				<a href="<?php echo $iletisim_get['twit']; ?>"><img src="ico/t.png" style="width: 30px; height: 30px;margin-left: 20px;"> </a>
				<div id="tel_copy">
					<p style=" color: white; margin-top: 20px; "> <i> <a style="text-decoration: none;color: white;" href="#"><?php echo $iletisim_get['tel']; ?></a> </i> </p>
				</div>
				<div id="email_copy">
					<p style=" color: white; margin-top: 20px; "> <i> <a style="text-decoration: none;color: white;" href="#">Email : <?php echo $iletisim_get['email']; ?></a></i> </p>
				</div>
			</div>
		</div>
	</div>
</footer>

<!-- LINKLER KISMI-->

<!--Bootstrap linki -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!--sweet eklentısı -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--jquery eklentısı -->
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>