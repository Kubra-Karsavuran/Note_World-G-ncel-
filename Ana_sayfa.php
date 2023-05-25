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

		<!-- ana sayfa gelecek -->

		<!DOCTYPE html>
		<html>


		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<!-- css dosyası uzantısı-->
			<link rel="stylesheet" type="text/css" href="css/css_dosyasi.css">
			<!--bootstarp linki-->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
			<!--pencere resmı-->
			<link rel="icon" type="image/png" href="resimler/logo.png">
			<!--font awesome den icon kullanmak için link-->
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
			<title>Not Sistemine Hoşgeldin</title>
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

			$deger_1 = $baglanti->query("SELECT * FROM `hoca_veri`");

			?>

			<!-- HEADER -->
			<?php 
			include 'includes/header.php';
			?>
  
			<header>
				<?php include 'includes/slider.php'; ?>
			</header>
 
			<!-- SINIF KARDLARI -->
			<section style="margin-top: 150px;">
				<div class="container">
					<div class="row">

						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="card" id="givecolor">
								<div class="img-wrap" style="width: auto; height:170px;">
									<img style="padding: 0; max-height:100%; min-width:100%;" src="resimler/2.sınıf.jpg" class="card-img-top" alt="...">
								</div>

								<div class="card-body">
									<h5 class="card-title">1.Sınıf</h5>
									<p class="card-text">1.Sınıf hakkınta tüm notlar ve bilgiler burda.</p>
									<a href="ders_sec.php?sinif_num=<?php echo 1; ?>" class="btn btn-primary">Git</a>
								</div>
							</div>
						</div>


						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="card" id="givecolor">
								<div class="img-wrap" style="width: auto; height:170px;">
									<img style="padding: 0; max-height:100%; min-width:100%;" src="resimler/2.sınıf.jpg" class="card-img-top" alt="...">
								</div>

								<div class="card-body">
									<h5 class="card-title">2.Sınıf</h5>
									<p class="card-text">2.Sınıf hakkınta tüm notlar ve bilgiler burda.</p>
									<a href="ders_sec.php?sinif_num=<?php echo 2; ?>" id="sinif" noveri="2" class="btn btn-primary">Git</a>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="card" id="givecolor">
								<div class="img-wrap" style="width: auto; height:170px;">
									<img style="padding: 0; max-height:100%; min-width:100%;" src="resimler/3.sınıf.jpg" class="card-img-top" alt="...">
								</div>

								<div class="card-body">
									<h5 class="card-title">3.Sınıf</h5>
									<p class="card-text">3.Sınıf hakkınta tüm notlar ve bilgiler burda.</p>
									<a href="ders_sec.php?sinif_num=<?php echo 3; ?>" id="sinif" noveri="3" class="btn btn-primary">Git</a>
								</div>
							</div>
						</div>


						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="card" id="givecolor">
								<div class="img-wrap" style="width: auto; height:170px;">
									<img style="padding: 0; max-height:100%; min-width:100%;" src="resimler/3.sınıf.jpg" class="card-img-top" alt="...">
								</div>

								<div class="card-body">
									<h5 class="card-title">4.Sınıf</h5>
									<p class="card-text">4.Sınıf hakkınta tüm notlar ve bilgiler burda.</p>
									<a href="ders_sec.php?sinif_num=<?php echo 4; ?>" id="sinif" noveri="4" class="btn btn-primary">Git</a>
								</div>
							</div>
						</div>



					</div>
				</div>
			</section>

			<section class="top-bar" style="margin-top: 100px;">
				<div class="container">
					<div class="row">
						<div class="col-4">
							<a id="givecoloriki" style="margin-left: 10px;" class="btn btn-primary hoca_data">HOCALAR HAKKINDA</a>
						</div>
						<div class="col-4"></div>
						<div class="col-4"></div>
					</div>
				</div>
			</section>


			<!--MODAL KISMI HANGİ HOCA NIN VERISI ISTENIYO BURDAN O ÇEKİLECEK-->

			<div class="modal" tabindex="-1" id="modal_kendi">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Hangi Hocanın Verilerine Ulaşmak İstediniz ?</h5>
							<button id="close_modal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div style="margin-left:50px;margin-top: 20px;">
							<?php while ($deger_1get = $deger_1->fetch_assoc()) {    ?>
								<p><a href="hocalar_hakkinda.php?get_id=<?php echo $deger_1get['id']; ?>" style="color: black; text-decoration:none;"> <?php echo $deger_1get['ad'] . " " . $deger_1get['soyad']; ?> </a></p>
							<?php  } ?>
						</div>
						<div class="modal-footer">
							<button type="button" id="close_modal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!--FOOTER KISMI -->


			<?php 
			include 'includes/footer.php';
			?>


			<script type="text/javascript">
				$(function() {
					//modal ac
					$(document).on('click', '#givecoloriki', function() {
						$('#modal_kendi').show();
					});
					// modal kapa islemi
					$(document).on('click', '#close_modal', function() {
						$('#modal_kendi').hide();
					});

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
	} else {
		?>
		<!-- login gidecek -->

		<?php 
		include 'includes/logine_gitmeli.php';
		?>



		<?php
		header("Refresh: 2; url=login.php");
	}
} else {
	?>

	<!-- logine gidecek -->

	<?php 
	include 'includes/logine_gitmeli.php';
	?>

	<?php
	header("Refresh: 2; url=login.php");
}

?>