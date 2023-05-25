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
			<!-- css dosyası uzantısı-->
			<link rel="stylesheet" type="text/css" href="css/css_dosyasi.css">
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

			if (isset($_GET['get_id'])) {
				$get_veri = $_GET['get_id'];

				$sorgu = $baglanti->query("SELECT * FROM `hoca_veri` WHERE id='$get_veri'");
				$sonuc = $sorgu->fetch_assoc();
			}
			?>

			<!-- HEADER -->
			<?php 
			include 'includes/header.php';
			?>

			<section style=" margin-top:110px; "> 
				<div>
					<h1 style="margin-bottom: 100px; text-transform:uppercase" class="d-flex justify-content-center align-items-center"><?php echo $sonuc['ad'] . " " . $sonuc['soyad']; ?></h1>
				</div>
				<div class="container"> 
					<div class="row">

						<div class="col-lg-4 col-sm-12">
							<div class="card" style="width: 18rem;">
								<img src="resimler/<?php echo $sonuc['foto']; ?>" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title"> </h5>
									<a target="_black" href="<?php echo $sonuc['web_site']; ?>" class="btn btn-primary">Hocanın Sitesini Ziyaret Et</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-sm-12">
							<div>
								<h5>GÖREV:</h5>
								<p><?php echo $sonuc['gorev']; ?></p>
							</div>
							<div>
								<h5>AKADEMİK:</h5>
								<p><?php echo $sonuc['akademik']; ?></p>
							</div>
							<div>
								<h5>MEZUN OLDUĞU UNİVERSİTE:</h5>
								<p><?php echo $sonuc['mezun']; ?></p>
							</div>
						</div>

						<div class="col-lg-4 col-sm-12">
							<div>
								<h5>EMİL:</h5>
								<p><?php echo $sonuc['email']; ?></p>
							</div>
							<div>
								<h5>TEL:</h5>
								<p><?php echo $sonuc['tel']; ?></p>
							</div>
							<div>
								<h5>OFİS ADRESİ:</h5>
								<p><?php echo $sonuc['ofis_yeri']; ?></p>
							</div>
						</div>

					</div>
				</div>
			</section>


			<!--FOOTER KISMI -->
 
			<?php 
			include 'includes/footer.php';
			?>

			<script>
				$(function() {

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