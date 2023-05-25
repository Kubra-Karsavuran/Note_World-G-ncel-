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
		if (isset($_GET['sinif'])) {
			$sinif=$_GET['sinif']; 
		} 
		$site_admin = $baglanti->query("SELECT * FROM `dersler` WHERE ders_sinif='$sinif'");
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
					<h1 style="margin-bottom:40px;text-align: center;height: 60px;"><?php echo $sinif; ?>.Sınıf Dersleri <button type="button" id="lesson" class="btn btn-info">Ders Ekle</button></h1> 
				</div>
				<div class="container" id="asil">
					<div class="row"> 
						<div class="table-responsive">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Ders Adı</th> 
										<th scope="col"> Sil</th> 
									</tr>
								</thead>
								<tbody> 

									<?php while ($getadmin = $site_admin->fetch_assoc()) {    ?>
										<tr>
											<td><?php echo $getadmin['ders_ad']; ?></td> 
											<td>
												<button id="ders_sil" login="<?php echo $getadmin['id']; ?>" type="button" class="btn btn-danger">Sil</button>
											</td> 
										</tr>
									<?php } ?>
								</tbody>
								<thead>
									<tr>
										<th scope="col">Ders Adı</th> 
										<th scope="col"> Sil</th> 
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>


				<!-- ders ekleme modalı  -->
				<div id="ders_ekle" class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-12"></div> 
						<div class="col-lg-4 col-sm-12">
							<form>
								<div class="mb-3">
									<label class="form-label">Eklenecek Ders</label>
									<input value="" type="email" class="form-control" id="ders_ad" aria-describedby="emailHelp"> 
								</div> 
								<button id="hadi_gun" veri_gun_id="<?php echo $sinif; ?>" type="submit" class="btn btn-primary">Ders Ekle</button> 
							</form>
						</div>
						<div class="col-lg-4 col-sm-12"></div> 
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

					// modal ıslemlerı
					$('#asil').show();
					$('#ders_ekle').hide();
					$(document).on('click', '#lesson', function() {
						$('#asil').hide();
						$('#ders_ekle').show(); 
					});


  					// ders sılme ıslemı yapıldı
  					$(document).on('click', '#ders_sil', function(e) { 
  						var ders_id_verisi = $(this).attr('login');  
  						e.preventDefault();  
  						$.post("function_admin/admin_function.php", {
  							"ders_id_verisi": ders_id_verisi, 
  							"ders_delete": "ders_delete"
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
  								alert("olmadı malesef");
  							} 
  						}); 
  					});

					// ders ekleme ıslmeı yapıldı
					$(document).on('click', '#hadi_gun', function(e) { 
						var sinif_ekle = $(this).attr('veri_gun_id');  
						var ders_ad=$('#ders_ad').val();
						e.preventDefault();  
						if (ders_ad=="") {
							Swal.fire('Ders Eklemelisiniz');
						}else{
							e.preventDefault();  
							$.post("function_admin/admin_function.php", {
								"sinif_ekle": sinif_ekle, 
								"ders_ad": ders_ad, 
								"addclass": "addclass"
							}).done(function(data) { 
								if (data == "yes") {
									Swal.fire({
										position: 'top-end',
										icon: 'success',
										title: 'Eklendi',
										showConfirmButton: false,
										timer: 1500
									});  
								} else {
									alert("olmadı malesef");
								} 
							}); 
						} 
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

