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

	if ($vt_ip == $session_ip && $vt_brovser == $session_brovser) { ?>

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

			?>

			<!-- HEADER -->
			<?php 
			include 'includes/header.php';
			?>


			<?php include 'includes/slider.php'; ?>

			<section style="margin-top:100px;">
				<div class="container">
					<div class="row">
						<div class="col-4"></div>
						<div class="col-4">
							<h3><i>İLETİŞİM İÇİN FORMU DOLDURUN</i></h3>
							<br>
							<form>
								<div class="mb-3">
									<label for="exampleInputEmail1" class="form-label">İsim</label>
									<input type="text" class="form-control name" id="exampleInputEmail1" aria-describedby="emailHelp">
								</div>
								<div class="mb-3">
									<label for="exampleInputEmail1" class="form-label">Soyisim</label>
									<input type="text" class="form-control surname" id="exampleInputEmail1" aria-describedby="emailHelp">
								</div>
								<div class="mb-3">
									<label for="exampleInputEmail1" class="form-label">Mesaj</label>
									<textarea type="text" class="form-control message" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>

								</div>
								<div class="mb-3">
									<label for="exampleInputEmail1" class="form-label">Email address</label>
									<input type="email" class="form-control gmail" id="exampleInputEmail1" aria-describedby="emailHelp">
								</div>
								<button type="submit" id="mesaj_buton" class="btn btn-primary ">Gönder</button>
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


		</body>

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


				$(document).on('click', '#mesaj_buton', function(e) {
					var name = $('.name').val();
					var surname = $('.surname').val();
					var gmail = $('.gmail').val();
					var message = $('.message').val();
					e.preventDefault();

					var kontrol = MailKontrol(gmail);

					function MailKontrol(gmail) {
						var kontrol = new RegExp(/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i);
						return kontrol.test(gmail);
					}


					if (kontrol == false || name == "" || surname == "" || gmail == "" || message == "") {
						Swal.fire({
							icon: 'error',
							title: 'Dikkat !!!',
							text: 'Boş Veri Var Yada Email Hatalı Kontrol Edin'
						});
						$('.name').val('');
						$('.surname').val('');
						$('.gmail').val('');
						$('.message').val('');
					} else {

						$.post("function/mesaj_function.php", {
							"name": name,
							"surname": surname,
							"gmail": gmail,
							"message": message,
							"ileti_fun": "ileti_fun"
						}).done(function(data) {

							if (data == "oldu") {
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: 'Mesajınız Gönderildi',
									showConfirmButton: false,
									timer: 1500
								});
								$('.name').val('');
								$('.surname').val('');
								$('.gmail').val('');
								$('.message').val('');
							} else if (data == "olmadı") {
								Swal.fire({
									icon: 'error',
									title: 'DİKKAT !!!',
									text: 'Malesef Mesaj Gönderilemedi'
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'DİKKAT !!!',
									text: 'Bir Sıkıntı Oluştu'
								});
							}
						});

					}



				});
			});
		</script>

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