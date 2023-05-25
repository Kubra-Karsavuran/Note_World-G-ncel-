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
		$site_admin = $baglanti->query("SELECT * FROM `mesaj`");


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

				<div id="baslik" style="background-color:rgb(225, 190, 231);">
					<h1 style="margin-bottom:40px;text-align: center;height: 60px;"> - Atılan Mesajlar -</h1>
				</div> 
				<div id="asil" class="container" >
					<div class="row"> 
						<div class="table-responsive">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Ad</th>
										<th scope="col">Soyad</th> 
										<th scope="col">Email</th>
										<th scope="col">Atılan Mesaj</th> 
										<th scope="col">Sil</th>   
									</tr>
								</thead>
								<tbody> 

									<?php while ($getadmin = $site_admin->fetch_assoc()) {    ?>
										<tr>
											<td><?php echo $getadmin['ad']; ?></td>
											<td><?php echo $getadmin['soyad']; ?></td> 
											<td><?php echo $getadmin['email']; ?></td>
											<td><?php echo $getadmin['mesaj']; ?></td> 
											<td><button id="mesaj_sil" sil="<?php echo $getadmin['id']; ?>" type="button" class="btn btn-danger">Mesajı Sil</button></td>   
											 
										</tr>
									<?php } ?>
								</tbody>
								<thead>
									<tr>
										<th scope="col">Ad</th>
										<th scope="col">Soyad</th> 
										<th scope="col">Email</th>
										<th scope="col">Atılan Mesaj</th> 
										<th scope="col">Sil</th> 
										 
									</tr>
								</thead>
							</table>
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

					// modal ıslemlerı
					$('#need').hide();  
					$(document).on('click', '#modal_ac', function(e) {
						e.preventDefault();
						$('#asil').hide();
						$('#need').show();
						$('#baslik').hide();
					});  
					$(document).on('click', '#kapa_modal', function(e) {
						e.preventDefault();
						$('#asil').show();
						$('#need').hide();
						$('#baslik').show();
					}); 

 
					// mesaj silme işlemi  
					$(document).on('click', '#mesaj_sil', function(e) {
						var sil_id=$(this).attr('sil');
						e.preventDefault(); 
						$.post("function_admin/admin_function.php", { 
							"sil_id": sil_id,
							"mesaj_sil": "mesaj_sil"
						}).done(function(data){ 
							if (data=='yes') {
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: 'Mesaj Silindi',
									showConfirmButton: false,
									timer: 1500
								}); 
							}else{
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

