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
		$site_admin = $baglanti->query("SELECT * FROM `login_ogrenci`");

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
					<h1 style="margin-bottom:40px;text-align: center;height: 60px;">Site Login Listesi <button type="button" id="ekle_login" class="btn btn-info">Login Ekle</button></h1>

				</div>
				<div class="container" id="asil">
					<div class="row">

						<div class="table-responsive">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Adı</th>
										<th scope="col">Soyadı</th>
										<th scope="col">Okul No</th>
										<th scope="col">Email</th> 
										<th scope="col">Sil</th>
										<th scope="col"> Güncelle</th> 
									</tr>
								</thead>
								<tbody> 

									<?php while ($getadmin = $site_admin->fetch_assoc()) {    ?>
										<tr>
											<td><?php echo $getadmin['name']; ?></td>
											<td><?php echo $getadmin['surname']; ?></td>
											<td><?php echo $getadmin['okul_no']; ?></td>
											<td><?php echo $getadmin['email']; ?></td>
											<td><button id="login_sil" login="<?php echo $getadmin['id']; ?>" type="button" class="btn btn-danger">Sil</button></td>
											<td><button id="login_guncel" loginGun="<?php echo $getadmin['id']; ?>" type="button" class="btn btn-warning">Güncelle</button></td> 
										</tr>
									<?php } ?>
								</tbody>
								<thead>
									<tr>
										<th scope="col">Adı</th>
										<th scope="col">Soyadı</th>
										<th scope="col">Okul No</th>
										<th scope="col">Email</th> 
										<th scope="col">Sil</th>
										<th scope="col"> Güncelle</th> 
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>


				<!-- Guncelleme modalı burda  -->
				<div id="guncelleme_modal" class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-12">

						</div>
						<div class="col-lg-4 col-sm-12">
							<form>
								<div class="mb-3">
									<label class="form-label">Ad</label>
									<input value="" type="email" class="form-control" id="gun_ad" aria-describedby="emailHelp"> 
								</div>
								<div class="mb-3">
									<label class="form-label">Soyad</label>
									<input value="" type="email" class="form-control" id="gun_soy" aria-describedby="emailHelp"> 
								</div>
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Okul No</label>
									<input value="" type="number" class="form-control" id="gun_okul">
								</div>
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Email</label>
									<input value="" type="text" class="form-control" id="gun_em">
								</div>

								<button id="hadi_gun" veri_gun_id="" type="submit" class="btn btn-primary">Güncelle</button>
								<button id="modal_kapa" type="submit" class="btn btn-dark">Kapat</button>
							</form>
						</div>
						<div class="col-lg-4 col-sm-12">

						</div>

					</div>
				</div>


				<!-- Login ekleme form modalı burda   -->
				<div id="log_modal" class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-12">

						</div>
						<div class="col-lg-4 col-sm-12">
							<form>
								<div class="mb-3">
									<label class="form-label">Ad</label>
									<input value="" type="email" class="form-control" id="log_ad" aria-describedby="emailHelp"> 
								</div>
								<div class="mb-3">
									<label class="form-label">Soyad</label>
									<input value="" type="email" class="form-control" id="log_so" aria-describedby="emailHelp"> 
								</div>
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Okul No</label>
									<input value="" type="number" class="form-control" id="log_okul">
								</div>
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Email</label>
									<input value="" type="text" class="form-control" id="log_em">
								</div>

								<button id="log_gun" type="submit" class="btn btn-primary">Logine Ekle</button>
								<button id="log_kapa" type="submit" class="btn btn-dark">Kapat</button>
							</form>
						</div>
						<div class="col-lg-4 col-sm-12">

						</div>

					</div>
				</div>

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

					//modal ac ve verı yansıt kısmı burda
					$('#guncelleme_modal').hide();
					$(document).on('click', '#login_guncel', function(e) { 
						e.preventDefault(); 
						var guncell_id = $(this).attr('loginGun');  
						$('#guncelleme_modal').show();
						$('#asil').hide(); 
						$.post("function_admin/admin_function.php", {
							"guncell_id": guncell_id,
							"guncel_veri_see": "guncel_veri_see"
						}).done(function(data) { 
							var obj = jQuery.parseJSON(data);   
							$('#hadi_gun').attr('veri_gun_id',obj.id); 
							$('#gun_ad').val(obj.name);  
							$('#gun_soy').val(obj.surname);  
							$('#gun_okul').val(obj.okul_no);  
							$('#gun_em').val(obj.email);   
						});
					});


					// modal kapa islemi
					$(document).on('click', '#modal_kapa', function() {
						$('#asil').show();
						$('#guncelleme_modal').hide();
						window.location.reload();
					});


					// login ogrencı sıstemı silme islemi yapıldı
					$(document).on('click', '#login_sil', function(e) {
						var login_sil_id = $(this).attr('login');
						e.preventDefault();
						$.post("function_admin/admin_function.php", {
							"login_sil_id": login_sil_id,
							"login_silis": "login_silis"
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

					// login guncelleme ıslemı
					$(document).on('click', '#hadi_gun', function(e) {

						var guncelle_veri = $(this).attr('veri_gun_id'); 
						var gun_ad=$('#gun_ad').val();
						var gun_soy=$('#gun_soy').val();
						var gun_okul=$('#gun_okul').val();
						var gun_em=$('#gun_em').val(); 
						e.preventDefault(); 

						$.post("function_admin/admin_function.php", {
							"guncelle_veri": guncelle_veri,
							"gun_ad": gun_ad,
							"gun_soy": gun_soy,
							"gun_okul": gun_okul,
							"gun_em": gun_em,
							"guncellenecek": "guncellenecek"
						}).done(function(data) {
							if (data == "yes") {
								alert("Güncelleme İşlemi Başarılı");
								$('#asil').show();
								$('#guncelleme_modal').hide();
								window.location.reload();
							} else {
								alert("olmadı malesef");
							} 
						}); 
					});

					$('#log_modal').hide();
					$(document).on('click','#ekle_login',function(e){
						$('#log_modal').show();
						$('#asil').hide(); 
					});

 
 
					$(document).on('click','#log_gun',function(e){  
						var log_ad=$('#log_ad').val();
						var log_so=$('#log_so').val();
						var log_okul=$('#log_okul').val();
						var log_em=$('#log_em').val();  
					 
						$.post("function_admin/admin_function.php", {
							"log_ad": log_ad,
							"log_so": log_so,
							"log_okul": log_okul,
							"log_em": log_em, 
							"log_ekle": "log_ekle"
						}).done(function(data) {
							if (data == "yes") {
								alert("Login Ekleme İşlemi Başarılı");
								$('#asil').show();
								$('#guncelleme_modal').hide();
								$('#log_modal').hide();
								window.location.reload();
							} else {
								alert("olmadı malesef");
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

