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
		$site_admin = $baglanti->query("SELECT * FROM `iletisim_bilgileri`");

		$veri_cek = $baglanti->query("SELECT * FROM `iletisim_bilgileri`");
		$guncel_kismi = $veri_cek->fetch_assoc();
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
					<h1 style="margin-bottom:40px;text-align: center;height: 60px;"> - İletişim Bilgileri -</h1>
				</div> 
				<div id="asil" class="container" >
					<div class="row"> 
						<div class="table-responsive">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Face</th>
										<th scope="col">Google</th> 
										<th scope="col">Linkedin</th>
										<th scope="col">twither</th>  
										<th scope="col">Tel</th>  
										<th scope="col">Email</th>  
										<th scope="col">Footer Metin</th>  
										<th scope="col">Güncelle</th>  
									</tr>
								</thead>
								<tbody> 

									<?php while ($getadmin = $site_admin->fetch_assoc()) {    ?>
										<tr>
											<td><?php echo $getadmin['face']; ?></td>
											<td><?php echo $getadmin['google_site']; ?></td> 
											<td><?php echo $getadmin['linkedin']; ?></td>
											<td><?php echo $getadmin['twit']; ?></td>
											<td><?php echo $getadmin['tel']; ?></td>
											<td><?php echo $getadmin['email']; ?></td>
											<td><?php echo $getadmin['footer_metin']; ?></td>

											<td><button id="modal_ac" type="button" class="btn btn-info">Güncelle</button></td>  
										</tr>
									<?php } ?>
								</tbody>
								<thead>
									<tr>
										<th scope="col">Face</th>
										<th scope="col">Google</th> 
										<th scope="col">Linkedin</th>
										<th scope="col">twither</th>  
										<th scope="col">Tel</th>  
										<th scope="col">Email</th>  
										<th scope="col">Footer Metin</th>  
										<th scope="col">Güncelle</th>  
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>


				<div id="need">
					<div style="background-color:rgb(225, 190, 231);">
						<h1 style="margin-bottom:40px;text-align: center;height: 60px;"> - Güncelleme İşlemi -</h1>
					</div>
					<div  class="container"> 
						<div class="row">
							<div class="col-lg-4 col-sm-12"></div> 
							<div class="col-lg-4 col-sm-12"> 
								<form>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Face Adres</label>
										<input id="face" value="<?php echo $guncel_kismi['face']; ?>" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Google Link</label>
										<input id="google" value="<?php echo $guncel_kismi['google_site']; ?>" type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Linkedin Linki</label>
										<input id="linkedin" value="<?php echo $guncel_kismi['linkedin']; ?>" type="text" class="form-control" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Twitter Linki</label>
										<input id="twit" value="<?php echo $guncel_kismi['twit']; ?>" type="text" class="form-control"  aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Telefon Numarası</label>
										<input id="tel" value="<?php echo $guncel_kismi['tel']; ?>" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Email Adresi</label>
										<input id="email" value="<?php echo $guncel_kismi['email']; ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> 
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Footer Metni</label>
										<input id="footer_metin" value="<?php echo $guncel_kismi['footer_metin']; ?>"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" > 
									</div>
									<button id="iletisim_guncelle" type="submit" class="btn btn-primary">Güncelle</button>
									<button id="kapa_modal" type="submit" class="btn btn-dark">Kapat</button>
								</form>
							</div>
							<div class="col-lg-4 col-sm-12">  
							</div>
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


					$(document).on('click', '#iletisim_guncelle', function(e) {
						e.preventDefault();

						var face=$('#face').val();
						var google=$('#google').val();
						var linkedin= $('#linkedin').val();
						var twit= $('#twit').val();
						var tel= $('#tel').val();
						var email= $('#email').val();
						var footer_metin=$('#footer_metin').val();
						
						$.post("function_admin/admin_function.php", {
                             "face": face,
                             "google": google,
                             "linkedin": linkedin,
                             "twit": twit,
                             "tel": tel,
                             "email": email,
                             "footer_metin": footer_metin,
                             "iletisim_guncelle": "iletisim_guncelle"
                         }).done(function(data){ 
                            if (data=='yes') {
                            	Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Güncelleme İşlemi Yapıldı',
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

