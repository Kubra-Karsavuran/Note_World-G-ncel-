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
 	


	if ($vt_ip == $session_ip && $vt_brovser == $session_brovser) {
		header("Refresh: 1; url=Ana_sayfa.php");
	} else { ?>

		<!-- login gidecek -->

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
							<h5 style="color: rgb(240,255,255);"><i>Okul Notlarına Ulaşabilmek İçin ...</i> </h5>
						</div>
					</div>
				</div>
			</div>


			<!---FORM KISMI-->
			<div style="background-color:rgb(240,255,255); border-radius: 20px; ">
				<h1 style="color: rgb(25,25,112);padding-top: 20px;padding-bottom: 20px;text-align: center; "> <i>GİRİŞ FORM SAYFASI</i> </h1>
			</div>
			<div id="asil" class="container" style=" margin-top: 50px; ">
				<div class="row">
					<div class="col-4">
						<!-- boş col -->
					</div>
					<div class="col-4">
						<div id="emailHelp" class="form-text">*Verileri eksiksiz giriniz !!!</div>
						<br>
						<form>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">İsim</label>
								<input type="text" id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Soyad</label>
								<input id="surname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Okul numaranız</label>
								<input id="school_num" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>

							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Emial</label>
								<input id="email_login" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>

							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Password</label>
								<input id="password" type="password" class="form-control" id="exampleInputPassword1">
							</div>

							<button id="form_kaydet" type="submit" class="btn btn-primary">GİRİŞ</button>

							<a id="yeni_şifre_al" href="#">Yeni Şifre Al</a>
						</form>
					</div>
					<div class="col-4">
						<!-- bos col -->
					</div>
				</div>
			</div>


			<div id="kontrol">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-12"></div> 
						<div class="col-lg-4 col-sm-12">
							<h5 align="center" >YENİ ŞİFRE ALMA FORMU</h5>
							<form>
								<div class="mb-3">
									<label class="form-label">Email Kontrolu</label>
									<input id="yazEmail" type="email" class="form-control" aria-describedby="emailHelp">
									<div id="emailHelp" class="form-text">Yazacağınız Email Onaylanmadıysa Şifre Alamazsınız !!!</div>
								</div>  
								<button id="emaKontrol" type="submit" class="btn btn-primary">Kontrol</button>
							</form>
						</div>
						<div class="col-lg-4 col-sm-12"></div> 
					</div>
				</div> 
			</div>

			<div id="sifre_al">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-12"></div> 
						<div class="col-lg-4 col-sm-12">
							<h5 align="center" >ŞİFRENİZİ YAZINIZ</h5>
							<form>
								<div class="mb-3"> 
									<input id="creatpas" type="password" class="form-control" aria-describedby="emailHelp">
									<div class="form-text">Yazacağınız şifre sisteme girmek için aktifleşecektir.</div>
								</div>  
								<button id="aktifres" geldi="" type="submit" class="btn btn-primary">Şifre Al</button>
							</form>
						</div>
						<div class="col-lg-4 col-sm-12"></div> 
					</div>
				</div> 
			</div>
			
			
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
			<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
			
			<script type="text/javascript">
				$(function() {
					$(document).on('click', '#form_kaydet', function(e) {
						var name = $('#name').val();
						var surname = $('#surname').val();
						var school_num = $('#school_num').val();
						var password = $('#password').val();
						var email_login = $('#email_login').val();

						e.preventDefault();
						// HTML elementlerin mevcut eylemleri engellemesini engeller
						if (name == "" || surname == "" || school_num == "" || password == "" || email_login == "") {
							Swal.fire({
								icon: 'error',
								title: 'Dikkat !!!',
								text: 'Lütfen Boş Veri Bırakmayın'
							});
						} else {
							$.post("function/login_function.php", {
								"name": name,
								"surname": surname,
								"school_num": school_num,
								"password": password,
								"email_login": email_login,
								"deneme": "deneme"
							}).done(function(data) {
								console.log("veri:" + data);
								if (data == "yes") {
									$('#name').val("");
									$('#surname').val("");
									$('#school_num').val("");
									$('#password').val("");
									$('#email_login').val("");
									$(window).attr('location', 'Ana_sayfa.php');
								} else {
									Swal.fire({
										icon: 'error',
										title: 'Dikkat !!!',
										text: 'Hatalı İşlem Tekrar Deneyiniz'
									});
									$('#name').val("");
									$('#surname').val("");
									$('#school_num').val("");
									$('#password').val("");
									$('#email_login').val("");

								}

							});

						}

					});

					$('#kontrol').hide();
					$('#sifre_al').hide(); 
					$(document).on('click','#yeni_şifre_al',function(e){
						e.preventDefault();
						$('#asil').hide();
						$('#kontrol').show(); 
					});


					$(document).on('click','#emaKontrol',function(e){
						e.preventDefault();
						var yazEmail=$('#yazEmail').val();
						$.post("function/login_function.php", {
							"yazEmail": yazEmail, 
							"emailkontrolu": "emailkontrolu"
						}).done(function(data) {
							console.log("veri:" + data);
							if (data == "var") {  
								$('#aktifres').attr('geldi',yazEmail);
								$('#kontrol').hide();
								$('#asil').hide();
								$('#sifre_al').show();  
							} else {  
								alert("Şifreniz Onaylı Değil");
								$(window).attr('location', 'login.php');
							}

						});
					});


			// yenı sıfre aıl burdan alınıyor
			$(document).on('click','#aktifres',function(e){
				e.preventDefault();
				var guncelEmail=$(this).attr('geldi');
				var creatpas=$('#creatpas').val();
				$.post("function/login_function.php", {
					"creatpas": creatpas,
					"guncelEmail": guncelEmail, 
					"aktifles": "aktifles"
				}).done(function(data) {
					console.log("veri:" + data);
					if (data == "yes") {  
						alert("Şifreniz Güncellendi");
						$(window).attr('location', 'login.php'); 
					} else {  
						alert("Şifreniz Onaylı Değil");
						$(window).attr('location', 'login.php');
					}

				});
			});

			
			
		});
	</script>
</body>

</html>







<?php
}
} else { ?>

	<!-- login gidecek -->


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
						<h5 style="color: rgb(240,255,255);"><i>Okul Notlarına Ulaşabilmek İçin ...</i> </h5>
					</div>
				</div>
			</div>
		</div>


		<!---FORM KISMI-->
		<div style="background-color:rgb(240,255,255); border-radius: 20px; ">
			<h1 style="color: rgb(25,25,112);padding-top: 20px;padding-bottom: 20px;text-align: center; "> <i>GİRİŞ FORM SAYFASI</i> </h1>
		</div>
		<div id="asil" class="container" style=" margin-top: 50px; ">
			<div class="row">
				<div class="col-4">
					<!-- boş col -->
				</div>
				<div class="col-4">
					<div id="emailHelp" class="form-text">*Verileri eksiksiz giriniz !!!</div>
					<br>
					<form>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">İsim</label>
							<input type="text" id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Soyad</label>
							<input id="surname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Okul numaranız</label>
							<input id="school_num" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>

						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Emial</label>
							<input id="email_login" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>

						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Password</label>
							<input id="password" type="password" class="form-control" id="exampleInputPassword1">
						</div>

						<button id="form_kaydet" type="submit" class="btn btn-primary">GİRİŞ</button>

						<a id="yeni_şifre_al" href="#">Yeni Şifre Al</a>
					</form>
				</div>
				<div class="col-4">
					<!-- bos col -->
				</div>
			</div>
		</div>


		<div id="kontrol">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-sm-12"></div> 
					<div class="col-lg-4 col-sm-12">
						<h5 align="center" >YENİ ŞİFRE ALMA FORMU</h5>
						<form>
							<div class="mb-3">
								<label class="form-label">Email Kontrolu</label>
								<input id="yazEmail" type="email" class="form-control" aria-describedby="emailHelp">
								<div id="emailHelp" class="form-text">Yazacağınız Email Onaylanmadıysa Şifre Alamazsınız !!!</div>
							</div>  
							<button id="emaKontrol" type="submit" class="btn btn-primary">Kontrol</button>
						</form>
					</div>
					<div class="col-lg-4 col-sm-12"></div> 
				</div>
			</div> 
		</div>

		<div id="sifre_al">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-sm-12"></div> 
					<div class="col-lg-4 col-sm-12">
						<h5 align="center" >ŞİFRENİZİ YAZINIZ</h5>
						<form>
							<div class="mb-3"> 
								<input id="creatpas" type="password" class="form-control" aria-describedby="emailHelp">
								<div class="form-text">Yazacağınız şifre sisteme girmek için aktifleşecektir.</div>
							</div>  
							<button id="aktifres" geldi="" type="submit" class="btn btn-primary">Şifre Al</button>
						</form>
					</div>
					<div class="col-lg-4 col-sm-12"></div> 
				</div>
			</div> 
		</div>
		
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
		<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
		
		<script type="text/javascript">
			$(function() {
				$(document).on('click', '#form_kaydet', function(e) {
					var name = $('#name').val();
					var surname = $('#surname').val();
					var school_num = $('#school_num').val();
					var password = $('#password').val();
					var email_login = $('#email_login').val();

					e.preventDefault();
						// HTML elementlerin mevcut eylemleri engellemesini engeller
						if (name == "" || surname == "" || school_num == "" || password == "" || email_login == "") {
							Swal.fire({
								icon: 'error',
								title: 'Dikkat !!!',
								text: 'Lütfen Boş Veri Bırakmayın'
							});
						} else {
							$.post("function/login_function.php", {
								"name": name,
								"surname": surname,
								"school_num": school_num,
								"password": password,
								"email_login": email_login,
								"deneme": "deneme"
							}).done(function(data) {
								console.log("veri:" + data);
								if (data == "yes") {
									$('#name').val("");
									$('#surname').val("");
									$('#school_num').val("");
									$('#password').val("");
									$('#email_login').val("");
									$(window).attr('location', 'Ana_sayfa.php');
								} else {
									Swal.fire({
										icon: 'error',
										title: 'Dikkat !!!',
										text: 'Hatalı İşlem Tekrar Deneyiniz'
									});
									$('#name').val("");
									$('#surname').val("");
									$('#school_num').val("");
									$('#password').val("");
									$('#email_login').val("");

								}

							});

						}

					});

				$('#kontrol').hide();
				$('#sifre_al').hide(); 
				$(document).on('click','#yeni_şifre_al',function(e){
					e.preventDefault();
					$('#asil').hide();
					$('#kontrol').show(); 
				});


				$(document).on('click','#emaKontrol',function(e){
					e.preventDefault();
					var yazEmail=$('#yazEmail').val();
					$.post("function/login_function.php", {
						"yazEmail": yazEmail, 
						"emailkontrolu": "emailkontrolu"
					}).done(function(data) {
						console.log("veri:" + data);
						if (data == "var") {  
							$('#aktifres').attr('geldi',yazEmail);
							$('#kontrol').hide();
							$('#asil').hide();
							$('#sifre_al').show();  
						} else {  
							alert("Şifreniz Onaylı Değil");
							$(window).attr('location', 'login.php');
						}

					});
				});


			// yenı sıfre aıl burdan alınıyor
			$(document).on('click','#aktifres',function(e){
				e.preventDefault();
				var guncelEmail=$(this).attr('geldi');
				var creatpas=$('#creatpas').val();
				$.post("function/login_function.php", {
					"creatpas": creatpas,
					"guncelEmail": guncelEmail, 
					"aktifles": "aktifles"
				}).done(function(data) {
					console.log("veri:" + data);
					if (data == "yes") {  
						alert("Şifreniz Güncellendi");
						$(window).attr('location', 'login.php'); 
					} else {  
						alert("Şifreniz Onaylı Değil");
						$(window).attr('location', 'login.php');
					}

				});
			});

			
			
		});
	</script>
</body>

</html>










<?php
}

?>