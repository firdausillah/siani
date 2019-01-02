<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title>Login | SIANI</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
  <!-- style css -->
  <link rel="stylesheet" href="assets/css/style.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!--<link rel="stylesheet" href="assets/css/demo.css">-->
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="shortcut icon" href="assets/img/icon.ico">
</head>

<body>
	<?php
		$user = "user";
		session_start();
		$gagal = "";

		$pass = "pass";

		include 'koneksi.php';
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = $_POST['user'];
			$pass = md5($_POST['pass']);
			$query = "SELECT * FROM users WHERE user_name = '$_POST[user]' AND password = '$_POST[pass]' AND status = 'Aktif'";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_assoc($result);
			if (mysqli_num_rows($result) > 0) {
				$_SESSION['id_user'] = $val['id_user'];
				$_SESSION['user_name'] = $val['user_name'];
				$_SESSION['level'] = $val['level'];
				echo "<script> alert('Berhasil Login');
				window.location.href = 'dashboard/".($val['level']=='Siswa'?'biodata.php':'dashboard.php')."';
				</script>";
			}
			else{
				$gagal = "* Username atau password salah atau user Non Aktif";
			}
		}

	 ?>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left" style="height: auto !important;">
						<div class="content">
							<br><br><br>
							<div class="header">
								<h2>SIANI</h2>
								<p class="lead">Login</p>
							</div>
							<form class="form-auth-small" action="" method="POST">
								<div class="input-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" class="form-control" id="signin-email" value="" placeholder="Username" name="user" required>

								</div>
								<br>
								<div class="input-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" class="form-control" id="signin-password" placeholder="Password" name="pass" value="" required>
								</div>
								<br>
								<span class="text-danger"><?php echo $gagal; ?></span>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<p></p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
