<section class="top-bar" style="width: 100%; height: 175px;top: 0; ">
	<div class="container">
		<div class="row">
			<div class="col-4 d-flex justify-content-center align-items-center">
				<a href="Ana_sayfa.php"><img style=" width: 160px; height: 120px; " src="resimler/logo.png"></a>
			</div>
			<div class="col-4 d-flex justify-content-center align-items-center">
				<h1 style="margin-top: 20px; text-align:left;"> <a style="text-decoration:none;color: rgb(149, 117, 205);" href="Ana_sayfa.php"><i> NOTE <br>WORLD </i></a></h1>
			</div>
			<div class="col-4 d-flex justify-content-center align-items-center">
				<a href="Ana_sayfa.php"><img style=" width: 160px; height: 120px; " src="resimler/logo.png"></a>
			</div>
		</div>
	</div>
</section>

<!-- butonlar-->
<section style="margin-bottom: 50px;margin-top:20px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center">
				<button style="width:200px;" type="button" class="btn btn-success"><a href="Ana_sayfa.php" style="color: white; text-decoration: none ; ">Ana Sayfa</a> </button>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center">
				<button id="like_number" veri="<?php echo $satir['like_number']; ?>" type="button" style="width:200px;" class="btn btn-primary">Like <i class="fa-solid fa-heart"></i> <?php echo $satir['like_number']; ?></button>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center">
				<button style="color: white;width:200px;" type="button" class="btn btn-warning"> <a href="admin_panel/admin_login.php" style="color:white; text-decoration: none;">Admin Panel</a></button>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
				<button style="width:200px;" type="button" class="btn btn-secondary"> <a href="outdoor.php" style="color:white; text-decoration: none;"> Çıkış Yap </a><i class="fa-solid fa-user"></i></button>
			</div>
		</div>
	</div>
</section>