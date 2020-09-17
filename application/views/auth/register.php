<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Dispermasdesdukcapil Prov. Jateng">
		<meta name="author" content="Dispermasdesdukcapil Prov. Jateng">
		<title>Dispermasdesdukcapil - Halaman Login</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="http://dispendukcapil.batangkab.go.id:80/pelayanan/assets/img/logo_prov_mail.png" rel="icon" type="image/png">
		<style type="text/css">
			body {
				color: #434343;
				background: #dfe7e9;
				font-family: 'Varela Round', sans-serif;
				/* background-image: url("http://pks.id/contentAsset/image/a94620bb-2c7d-4b1a-babb-feb66f90b674/fileAsset/filter/Resize/resize_w/1340/byInode/1"); */
			}
			.form-control {
				font-size: 16px;
				transition: all 0.4s;
				box-shadow: none;
			}
			.form-control:focus {
				border-color: #5cb85c;
			}
			.form-control, .btn {
				border-radius: 50px;
				outline: none !important;
			}
			.signin-form {
				width: 400px;
				margin: 0 auto;
				padding: 30px 0;
			}
			.signin-form form {
				border-radius: 5px;
				margin-bottom: 20px;
				background: #fff;
				box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
				padding: 40px;
			}
			.signin-form a {
				color: #5cb85c;
			}
			.signin-form h2 {
				text-align: center;
				font-size: 34px;
				margin: 10px 0 15px;
			}
			.signin-form .hint-text {
				color: #999;
				text-align: center;
				margin-bottom: 20px;
			}
			.signin-form .form-group {
				margin-bottom: 20px;
			}
			.signin-form .btn {
				font-size: 18px;
				line-height: 26px;
				font-weight: bold;
				text-align: center;
			}
			.signin-form .small {
				font-size: 13px;
			}
			.signup-btn {
				text-align: center;
				border-color: #5cb85c;
				transition: all 0.4s;
			}
			.signup-btn:hover {
				background: #5cb85c;
				opacity: 0.8;
			}
			.or-seperator {
				margin: 50px 0 15px;
				text-align: center;
				border-top: 1px solid #e0e0e0;
			}
			.or-seperator b {
				padding: 0 10px;
				width: 40px;
				height: 40px;
				font-size: 16px;
				text-align: center;
				line-height: 40px;
				background: #fff;
				display: inline-block;
				border: 1px solid #e0e0e0;
				border-radius: 50%;
				position: relative;
				top: -22px;
				z-index: 1;
			}
			.social-btn .btn {
				color: #fff;
				margin: 10px 0 0 30px;
				font-size: 15px;
				width: 55px;
				height: 55px;
				line-height: 38px;
				border-radius: 50%;
				font-weight: normal;
				text-align: center;
				border: none;
				transition: all 0.4s;
			}
			.social-btn .btn:first-child {
				margin-left: 0;
			}
			.social-btn .btn:hover {
				opacity: 0.8;
			}
			.social-btn .btn-primary {
				background: #507cc0;
			}
			.social-btn .btn-info {
				background: #64ccf1;
			}
			.social-btn .btn-danger {
				background: #df4930;
			}
			.social-btn .btn i {
				font-size: 20px;
			}
		</style>
		<style>
			.page-bg {
				background-image: url("<?=base_url('assets/logo.JPG');?>");
				-webkit-filter: blur(99px);
				-moz-filter: blur(99px);
				-o-filter: blur(99px);
				-ms-filter: blur(99px);
				filter: blur(99px);
				position: fixed;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				z-index: -1;
			}    	
		</style>
		<!-- <style>
			.signin-form {
				background-image: url("http://pks.id/contentAsset/image/a94620bb-2c7d-4b1a-babb-feb66f90b674/fileAsset/filter/Resize/resize_w/1340/byInode/1");
				-webkit-filter: blur(99px);
				-moz-filter: blur(99px);
				-o-filter: blur(99px);
				-ms-filter: blur(99px);
				filter: blur(99px);
				position: fixed;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				z-index: -1;
			}
		</style> -->
	</head>
	<body onload="getLocation()">
	<div class="page-bg"></div>
		<div class="signin-form">
			<?= $this->session->flashdata('error') ?>
			<form role="form" action="<?= site_url('register_process'); ?>" method='post'>
				<p id="getLocation"></p>
				<!-- <h2>Sign in</h2>
				<p class="hint-text">Sign in with your social media account</p> -->
				<div class="social-btn text-center">
					<!-- <a href="#" class="btn btn-danger btn-lg" title="Google"><i class="fa fa-google"></i></a> -->
					<!-- <img src="http://dispendukcapil.batangkab.go.id/pelayanan/assets/img/kab/3325.png" width='50%'> -->
					<p><font size="4">Silahkan isi data dengan benar  !!!</font></p><hr>
				</div>
				<!-- <div class="or-seperator"><b></b></div> -->
				<div class="form-group">
					<input type="text" class="form-control input-lg" name="username" placeholder="Nama Pengguna" onkeypress="return event.charCode < 48 || event.charCode  >57" required>
				</div>
                <div class="form-group">
					<input type="number" class="form-control input-lg" name="nik" placeholder="NIK" maxlength='16' required="required">
				</div>
                <div class="form-group">
					<input type="email" class="form-control input-lg" name="email" placeholder="Email" required="required">
				</div>
                <div class="form-group">
					<input type="number" class="form-control input-lg" name="no_hp" placeholder="No. HP" required="required">
				</div>
                <hr>
				<div class="form-group">
					<input type="password" class="form-control input-lg" name="password" placeholder="Kata Sandi" required="required">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-lg btn-block signup-btn">Daftar</button>
				</div>
				<!-- <div class="text-center small"><a href="#">Lupa Kata Sandi?</a></div> -->
				<div class="text-center"><hr>© Copyright 2019, All Right Reserved
				<br>Created by Dispermasdesdukcapil Prov. Jateng</div>
			</form>
			<div class="text-center small">Sudah punya akun? <a href="<?php echo site_url(); ?>">Masuk disini!</a></div>
			<script>
				var view = document.getElementById("getLocation");
				function getLocation() {
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					} else {
						view.innerHTML = "";
					}
				}
				function showPosition(position) {
					view.innerHTML = "<input type='hidden' name='location' value='" + position.coords.latitude + "," + position.coords.longitude +"' />";
				}
			</script>
		</div>
	</body>
</html>