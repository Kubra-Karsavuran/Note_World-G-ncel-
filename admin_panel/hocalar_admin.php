<?php 

include '../vt/vt_baglantisi.php';
session_start();

$kontrol_admin = mysqli_query($baglanti, "SELECT * FROM `login_admin`");
$kontrol_sonuc_admin = mysqli_fetch_array($kontrol_admin);

$vt_ip_admin = $kontrol_sonuc_admin['admin_ip'];  // veri tabanindan aldigim ip degeri 
$vt_brovser_admin = $kontrol_sonuc_admin['admin_browser'];  // veri tabanindan aldigim brovser  

if (isset($_SESSION['Ip']) && isset($_SESSION['browser'])) {
	$session_admin_ip=$_SESSION['Ip'];
	$session_admin_browser=$_SESSION['browser'];

	if ($session_admin_ip==$vt_ip_admin && $session_admin_browser==$vt_brovser_admin) { ?>


		<?php 

		include '../vt/vt_baglantisi.php';
		$site_admin = $baglanti->query("SELECT * FROM `hoca_veri`");

		if(isset($_GET['secilen_id'])){
			$secilen_id=$_GET['secilen_id']; 

			$veri_yansit = $baglanti->query("SELECT * FROM `hoca_veri` WHERE id='$secilen_id' ");
			$veriler = $veri_yansit->fetch_assoc();


		}

		?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1"> 
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
			<!--pencere resmı-->
			<link rel="icon" type="image/png" href="../resimler/logo.png">
			<!--font awesome den icon kullanmak için link-->
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
			<title>Admin Panel</title>
		</head>
		<body>
			<?php 
			include './includes_admin/header_admin.php';
			?>
			<section>

				<div style="background-color:rgb(225, 190, 231);">
					<h1 style="margin-bottom:40px;text-align: center;height: 60px;">- Hocaların Listesi <button type="button" class="btn btn-dark"><a style="text-decoration:none;color:white;" href="hocalar_admin.php?ogretmen_ekle=1">Öğretmen Ekle</a></button> - </h1>
				</div>

				<!-- asagıda hocaların butun verılerı ancak get olması durumunda calısacaktır asagıda olu yaptık -->

				<?php 
				if (!isset($_GET['secilen_id']) && !isset($_GET['hoca_guncel']) && !isset($_GET['ogretmen_ekle'])) { ?>
					<div class="container" >
						<div class="row"> 
							<div class="table-responsive">
								<table class="table table-striped table-sm">
									<thead>
										<tr>
											<th scope="col">Adı</th>
											<th scope="col">Soyadı</th> 
											<th scope="col">Tüm Veriler</th>
											<th scope="col">Sil</th>  
										</tr>
									</thead>
									<tbody> 

										<?php while ($getadmin = $site_admin->fetch_assoc()) {    ?>
											<tr>
												<td><?php echo $getadmin['ad']; ?></td>
												<td><?php echo $getadmin['soyad']; ?></td> 

												<td><button id="tamami" type="button" class="btn btn-info"><a style="text-decoration: none; color:black;" href="hocalar_admin.php?secilen_id=<?php echo $getadmin['id']; ?>" >Tüm Veriler</a></button></td> 

												<td><button id="hoca_sil" login="<?php echo $getadmin['id']; ?>" type="button" class="btn btn-danger">Sil</button></td> 
											</tr>
										<?php } ?>
									</tbody>
									<thead>
										<tr>
											<th scope="col">Adı</th>
											<th scope="col">Soyadı</th> 
											<th scope="col">Tüm Veriler</th>
											<th scope="col">Sil</th> 
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				<?php } ?>


				<?php  
				if (isset($_GET['secilen_id'])) { ?> 
					<div class="container">
						<div class="row"> 
							<div class="table-responsive">
								<table class="table table-striped table-sm">
									<thead>
										<tr>
											<th scope="col">Foto</th>
											<th scope="col">Web Site</th> 
											<th scope="col">Adı</th>
											<th scope="col">Soyadı</th>  
											<th scope="col">Gorev</th>
											<th scope="col">Akademik</th> 
											<th scope="col">Mezun</th>
											<th scope="col">Email</th>  
											<th scope="col">Tel</th>
											<th scope="col">Web Site</th> 
											<th scope="col">Ofis Yeri</th>
											<th scope="col">Güncelle</th>  
										</tr>
									</thead>
									<tbody>  
										<tr>
											<td><?php echo $veriler['foto']; ?></td>
											<td><?php echo $veriler['web_site']; ?></td>
											<td><?php echo $veriler['ad']; ?></td>
											<td><?php echo $veriler['soyad']; ?></td> 
											<td><?php echo $veriler['gorev']; ?></td>
											<td><?php echo $veriler['akademik']; ?></td>
											<td><?php echo $veriler['mezun']; ?></td> 
											<td><?php echo $veriler['email']; ?></td>
											<td><?php echo $veriler['tel']; ?></td>  
											<td><?php echo $veriler['web_site']; ?></td>
											<td><?php echo $veriler['ofis_yeri']; ?></td>

											<td><button type="button" class="btn btn-info"><a style="text-decoration:none; color: black;" href="hocalar_admin.php?hoca_guncel=<?php echo $veriler['id']; ?>">Güncelle</a></button></td>

										</tr> 
									</tbody>
									<thead>
										<tr>
											<th scope="col">Foto</th>
											<th scope="col">Web Site</th> 
											<th scope="col">Adı</th>
											<th scope="col">Soyadı</th>  
											<th scope="col">Gorev</th>
											<th scope="col">Akademik</th> 
											<th scope="col">Mezun</th>
											<th scope="col">Email</th>  
											<th scope="col">Tel</th>
											<th scope="col">Web Site</th> 
											<th scope="col">Ofis Yeri</th>
											<th scope="col">Güncelle</th> 
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div> 
				<?php } ?>


				<?php  
				if (isset($_GET['hoca_guncel'])) { 

					$hoca_guncel=$_GET['hoca_guncel'];  
					$guncel_veri = $baglanti->query("SELECT * FROM `hoca_veri` WHERE id='$hoca_guncel' ");
					$veriler = $guncel_veri->fetch_assoc();

					?>

					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-12"></div> 
							<div class="col-lg-4 col-md-12">
								<h3>Güncelleme İşlemi</h3>
								<form>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Adı</label>
										<input id="ad" value="<?php echo $veriler['ad']; ?>" type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Soyadı</label>
										<input id="soyad" value="<?php echo $veriler['soyad']; ?>" type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Gorev</label>
										<input id="gorev" value="<?php echo $veriler['gorev']; ?>" type="text" class="form-control" >
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Akademi</label>
										<input id="akademik" value="<?php echo $veriler['akademik']; ?>" type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Mezun</label>
										<input id="mezun" value="<?php echo $veriler['mezun']; ?>" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Email</label>
										<input id="email" value="<?php echo $veriler['email']; ?>" type="email" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Tel</label>
										<input id="tel" value="<?php echo $veriler['tel']; ?>" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Ofis Yeri</label>
										<input id="ofis_yeri" value="<?php echo $veriler['ofis_yeri']; ?>" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Fotoğrafı</label>
										<input id="foto" value="<?php echo $veriler['foto']; ?>" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Web Site</label>
										<input id="web_site" value="<?php echo $veriler['web_site']; ?>" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div> 

									<button hoca_veri="<?php echo $veriler['id']; ?>" id="hoca_guncelleme" type="submit" class="btn btn-primary">Güncelle</button>
								</form>
							</div>
							<div class="col-lg-4 col-md-12"></div>

						</div>
					</div> 
				<?php } ?>


				<?php 

				if (isset($_GET['ogretmen_ekle'])) { ?>

					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-12"></div> 
							<div class="col-lg-4 col-md-12">
								<h3>Öğretmen Ekleme Formu</h3>
								<form>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Adı</label>
										<input id="yeni_ad" type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Soyadı</label>
										<input id="yeni_soyad" type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Gorev</label>
										<input id="yeni_gorev" type="text" class="form-control" >
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Akademi</label>
										<input id="yeni_akademik" type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Mezun</label>
										<input id="yeni_mezun" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Email</label>
										<input id="yeni_email" type="email" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Tel</label>
										<input id="yeni_tel" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Ofis Yeri</label>
										<input id="yeni_ofis_yeri" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Fotoğrafı</label>
										<input id="yeni_foto" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Web Site</label>
										<input id="yeni_web_site" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div> 

									<button id="yeni_hoca_ekle" type="submit" class="btn btn-primary">Kaydet</button>
								</form>
							</div>
							<div class="col-lg-4 col-md-12"></div>

						</div>
					</div>

				<?php } ?>



			</section>

			<!-- LINKLER KISMI-->

			<!--Bootstrap linki -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
			<!--sweet eklentısı -->
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
			<!--jquery eklentısı -->
			<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

			<script type="text/javascript">
				$(function() {  
					$('#tum_veriler_burda').hide(); 

					// hoca sil
					$(document).on('click', '#hoca_sil', function(e) {
						var hoca_id = $(this).attr('login');
						e.preventDefault();
						$.post("function_admin/admin_function.php", {
							"hoca_id": hoca_id,
							"silme_islemi": "silme_islemi"
						}).done(function(data) {
							if (data == "yes") {
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: 'Silme İşlemi Yapıldı',
									showConfirmButton: false,
									timer: 1500
								}); 
							} else {
								Swal.fire('Bir Sıkıntı Oluştu');
							} 
						});
					}); 




					// hoca guncelleme ıslemı yapılacak 
					$(document).on('click', '#hoca_guncelleme', function(e) {
						var hoca_veri = $(this).attr('hoca_veri');

						var ad=$('#ad').val(); 
						var soyad=$('#soyad').val();
						var gorev=$('#gorev').val();
						var akademik=$('#akademik').val();
						var mezun=$('#mezun').val();
						var email=$('#email').val();
						var tel=$('#tel').val();
						var ofis_yeri=$('#ofis_yeri').val();
						var foto=$('#foto').val();
						var web_site=$('#web_site').val();

						e.preventDefault();
						$.post("function_admin/admin_function.php", {
							"hoca_veri": hoca_veri,
							"ad": ad,
							"soyad": soyad,
							"gorev": gorev,
							"akademik": akademik, 
							"mezun": mezun,
							"email": email,
							"tel": tel, 
							"ofis_yeri": ofis_yeri,
							"foto": foto,
							"web_site": web_site, 
							"hoca_gunceleme": "hoca_gunceleme"
						}).done(function(data) {
							if (data == "yes") {
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: 'Güncelleme Yapıldı',
									showConfirmButton: false,
									timer: 1500
								}); 
							} else {
								Swal.fire('Bir Sıkıntı Oluştu');
							} 
						});
					});




					// yeni hoca ekleme işlemi yapılacak

					$(document).on('click', '#yeni_hoca_ekle', function(e) {
					 
						var yeni_ad=$('#yeni_ad').val(); 
						var yeni_soyad=$('#yeni_soyad').val();
						var yeni_gorev=$('#yeni_gorev').val();
						var yeni_akademik=$('#yeni_akademik').val();
						var yeni_mezun=$('#yeni_mezun').val();
						var yeni_email=$('#yeni_email').val();
						var yeni_tel=$('#yeni_tel').val();
						var yeni_ofis_yeri=$('#yeni_ofis_yeri').val();
						var yeni_foto=$('#yeni_foto').val();
						var yeni_web_site=$('#yeni_web_site').val();

						e.preventDefault();
						$.post("function_admin/admin_function.php", { 
							"yeni_ad": yeni_ad,
							"yeni_soyad": yeni_soyad,
							"yeni_gorev": yeni_gorev,
							"yeni_akademik": yeni_akademik, 
							"yeni_mezun": yeni_mezun,
							"yeni_email": yeni_email,
							"yeni_tel": yeni_tel, 
							"yeni_ofis_yeri": yeni_ofis_yeri,
							"yeni_foto": yeni_foto,
							"yeni_web_site": yeni_web_site, 
							"ogretmen_ekle": "ogretmen_ekle"
						}).done(function(data) {
							if (data == "yes") {
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: 'Kayıt İşlemi Başarılı',
									showConfirmButton: false,
									timer: 1500
								}); 
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
	} else {
		include '../includes/logine_gitmeli.php';
		header("Refresh: 2; url=../login.php");
	} 
} else {
	include '../includes/logine_gitmeli.php';
	header("Refresh: 2; url=../login.php");
}


?>

