<?php session_start();
if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
	echo "<script>
		alert('Anda harus login dahulu !');
		window.location.href='../login.php';
	</script>";
}
 ?>
 <!doctype html>
<html lang="en">
<head>
	<title>Edit Profil | Sehatin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="../assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="../assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!--<link rel="stylesheet" href="assets/css/demo.css">-->
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php
			include '../dashboard/navbar.php';
			include '../dashboard/left_sidebar.php';
			$pass_lama_err = $pass_baru_err = $konfirmasi_err = "";
			$pass_lama = $pass_baru = $konfirmasi = "";
			$query = "SELECT password as password_lama FROM petugas WHERE id_petugas = '$_GET[id_petugas]'";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_assoc($result);
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				//$p = md5($_POST['pass_lama']);
				if (empty($_POST['pass_lama'])) {
					$pass_lama_err = "* Password lama harus diisi !";
				}
				elseif (md5($_POST['pass_lama']) != $val['password_lama']) {
					$pass_lama_err = "* Password lama tidak sessuai";
				}
				else{
					$pass_lama = $_POST['pass_lama'];
					$enkrip = md5($pass_lama);
				}

				if (empty($_POST['pass_baru'])) {
					$pass_baru_err = "* Password baru harus diisi !";
				}
				else{
					$pass_baru = md5($_POST['pass_baru']);
				}

				if (empty($_POST['konfirmasi'])) {
					$konfirmasi_err = "* konfirmasi password harus diisi !";
				}
				elseif ($_POST['konfirmasi'] != $_POST['pass_baru']) {
					$konfirmasi_err = "* Konfirmasi password tidak sesuai !";
				}
				else{
					$konfirmasi = $_POST['konfirmasi'];
				}

				if ($pass_lama_err == "" && $pass_baru_err == "" && $konfirmasi_err == "") {
					mysqli_query($con, "UPDATE petugas SET password = '$pass_baru' WHERE id_petugas = '$_GET[id_petugas]'");
					echo "<script>
									alert('Silahkan login kembali');
									window.location.href='../logout.php';
								</script>";
				}
			}
		?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Ganti Password</h3>
					<div class="row">
						<div class="col-md-6">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Ganti Password</h3>
								</div>
								<div class="panel-body">
									<form method="POST" action="">
										<div class="row">
											<input type="password" name="pass_lama" placeholder="Masukan password lama" class="form-control" value="<?php echo isset($_POST['pass_lama']) ? $_POST['pass_lama'] : $pass_lama ?>">
											<span class="text-danger"><?php echo $pass_lama_err ?></span>
										</div>
										<br>
										<div class="row">
											<input type="password" name="pass_baru" placeholder="Masukan password baru" class="form-control" value="<?php echo isset($_POST['pass_baru']) ? $_POST['pass_baru'] : $pass_baru ?>">
											<span class="text-danger"><?php echo $pass_baru_err ?></span>
										</div>
										<br>
										<div class="row">
											<input type="password" name="konfirmasi" placeholder="konfirmasi password baru" class="form-control" value="<?php echo isset($_POST['konfirmasi']) ? $_POST['konfirmasi'] : $konfirmasi ?>">
											<span class="text-danger"><?php echo $konfirmasi_err ?></span>
										</div>
										<br>
										<div class="row">
											<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>  Simpan</button> &nbsp; &nbsp;
		 										<button type="reset" name="reset" class="btn btn-danger" onclick="history.go(-1);"><i class="fa fa-times-circle"></i> &nbsp;  Batal</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="clearfix"></div>
		<?php include '../dashboard/footer.php'; ?>
	</div>
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>
</body>
</html>
