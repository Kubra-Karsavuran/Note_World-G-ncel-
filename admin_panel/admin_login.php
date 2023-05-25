<?php 

include '../vt/vt_baglantisi.php';
session_start();

$kontrol_admin1 = mysqli_query($baglanti, "SELECT * FROM `login_admin`");
$kontrol_sonuc_admin1 = mysqli_fetch_array($kontrol_admin1);

$vt_ip_admin = $kontrol_sonuc_admin1['admin_ip'];  // veri tabanindan aldigim ip degeri 
$vt_brovser_admin = $kontrol_sonuc_admin1['admin_browser'];  // veri tabanindan aldigim brovser  

if (isset($_SESSION['Ip']) && isset($_SESSION['browser'])) {
	$session_admin_ip=$_SESSION['Ip'];
	$session_admin_browser=$_SESSION['browser'];

	if ($session_admin_ip==$vt_ip_admin && $session_admin_browser==$vt_brovser_admin) { 

		header("Location: http://localhost/B%C4%B0T%C4%B0RME/admin_panel/admin_index.php");

	} else {   ?>

		<!DOCTYPE html>
		<html> 
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<!--bootstrap linki-->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
			<!--pencere resmı-->
			<link rel="icon" type="image/png" href="/../resimler/logo.png">
			<title>Admin Login</title>
		</head> 
		<body> 
			<!--logine ozel header bu DİKKAR!! HEADER -->
			<div style="background-color:rgb(25,25,112); border-radius: 20px; width: 100%;height: 35px;">
				<div class="container">
					<div class="row">
						<div class="col-6">
							<h5 style="color: rgb(240,255,255);"><i>Login Sayfası</i> </h5>
						</div>
					</div>
				</div>
			</div> 

			<!---FORM KISMI-->
			<div style="background-color:rgb(240,255,255); border-radius: 20px; ">
				<h1 style="color: rgb(25,25,112);padding-top: 20px;padding-bottom: 20px;text-align: center; "><i>Admin Sayfası</i></h1>
			</div>
			<div class="container" style=" margin-top: 50px; ">
				<div class="row">
					<div class="col-4"></div> 
					<div class="col-4">
						<div id="emailHelp" class="form-text">*Verileri eksiksiz giriniz !!!</div>
						<br>
						<form>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">İsim</label>
								<input type="text" id="admin_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Soyad</label>
								<input id="admin_surname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>    
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Password</label>
								<input id="admin_password" type="password" class="form-control" id="exampleInputPassword1 ">
							</div> 
							<button id="admin_login_kaydet" type="submit" class="btn btn-primary">GİRİŞ</button>
						</form>
					</div>
					<div class="col-4"></div> 
				</div>
			</div>


			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
			<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>

			<script type="text/javascript">
				$(function() {
					$(document).on('click', '#admin_login_kaydet', function(e) {

						var admin_name = $('#admin_name').val();
						var admin_surname = $('#admin_surname').val();
						var admin_password = $('#admin_password').val(); 
						e.preventDefault();


						if (admin_name == "" || admin_surname == "" || admin_password == "") {
							Swal.fire({
								icon: 'error',
								title: 'Dikkat !!!',
								text: 'Lütfen Boş Veri Bırakmayın'
							});
						} else {
							$.post("function_admin/admin_function_login.php", {
								"admin_name": admin_name,
								"admin_surname": admin_surname,
								"admin_password": admin_password, 
								"admin_login": "admin_login"
							}).done(function(data) {
								console.log("veri:" + data);
								if (data == "yes") { 
									$('#admin_name').val("");
									$('#admin_surname').val("");
									$('#admin_password').val(""); 
									$(window).attr('location', 'admin_index.php');

								} else { 
									Swal.fire({
										icon: 'error',
										title: 'Dikkat !!!',
										text: 'Hatalı İşlem Tekrar Deneyiniz'
									});
									$('#admin_name').val("");
									$('#admin_surname').val("");
									$('#admin_password').val(""); 
								}

							});

						}

					});
				});
			</script>
		</body> 
		</html>

	<?php  } 
} else { ?>

	<!DOCTYPE html>
	<html> 
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--bootstrap linki-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<!--pencere resmı-->
		<link rel="icon" type="image/png" href="resimler/logo.png">
		<title>Form Sayfası</title>
	</head> 
	<body> 
		<!--logine ozel header bu DİKKAR!! HEADER -->
		<div style="background-color:rgb(25,25,112); border-radius: 20px; width: 100%;height: 35px;">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<h5 style="color: rgb(240,255,255);"><i>Login Sayfası</i> </h5>
					</div>
				</div>
			</div>
		</div> 

		<!---FORM KISMI-->
		<div style="background-color:rgb(240,255,255); border-radius: 20px; ">
			<h1 style="color: rgb(25,25,112);padding-top: 20px;padding-bottom: 20px;text-align: center; "><i>Admin Sayfası</i></h1>
		</div>
		<div class="container" style=" margin-top: 50px; ">
			<div class="row">
				<div class="col-4"></div> 
				<div class="col-4">
					<div id="emailHelp" class="form-text">*Verileri eksiksiz giriniz !!!</div>
					<br>
					<form>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">İsim</label>
							<input type="text" id="admin_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Soyad</label>
							<input id="admin_surname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>    
						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Password</label>
							<input id="admin_password" type="password" class="form-control" id="exampleInputPassword1 ">
						</div> 
						<button id="admin_login_kaydet" type="submit" class="btn btn-primary">GİRİŞ</button>
					</form>
				</div>
				<div class="col-4"></div> 
			</div>
		</div>


		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
		<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>

		<script type="text/javascript">
			$(function() {
				$(document).on('click', '#admin_login_kaydet', function(e) {

					var admin_name = $('#admin_name').val();
					var admin_surname = $('#admin_surname').val();
					var admin_password = $('#admin_password').val(); 
					e.preventDefault();


					if (admin_name == "" || admin_surname == "" || admin_password == "") {
						Swal.fire({
							icon: 'error',
							title: 'Dikkat !!!',
							text: 'Lütfen Boş Veri Bırakmayın'
						});
					} else {
						$.post("function_admin/admin_function_login.php", {
							"admin_name": admin_name,
							"admin_surname": admin_surname,
							"admin_password": admin_password, 
							"admin_login": "admin_login"
						}).done(function(data) {
							console.log("veri:" + data);
							if (data == "yes") { 
								$('#admin_name').val("");
								$('#admin_surname').val("");
								$('#admin_password').val(""); 
								$(window).attr('location', 'admin_index.php');

							} else { 
								Swal.fire({
									icon: 'error',
									title: 'Dikkat !!!',
									text: 'Hatalı İşlem Tekrar Deneyiniz'
								});
								$('#admin_name').val("");
								$('#admin_surname').val("");
								$('#admin_password').val(""); 
							}

						});

					}

				});
			});
		</script>
	</body> 
	</html>

	<?php
}


?>


