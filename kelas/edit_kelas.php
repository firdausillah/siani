<?php session_start();
if (empty($_SESSION['user_name']) && empty($_SESSION['level'])) {
	echo "<script>
		alert('Anda harus login dahulu !');
		window.location.href='../login.php';
	</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
 <title>Data Kelas| SIANI</title>
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
 <!-- style css -->
 <link rel="stylesheet" href="../assets/css/style.css">
 <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
 <!--<link rel="stylesheet" href="assets/css/demo.css">-->
 <!-- GOOGLE FONTS -->
 <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> -->
 <!-- ICONS -->
 <link rel="shortcut icon" href="../assets/img/icon.ico">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php
			include '../dashboard/navbar.php';
			include '../dashboard/left_sidebar.php';
			$query = "SELECT * FROM kelas WHERE kd_kelas = '$_GET[kd_kelas]'";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_assoc($result);
			$kd_kelas_err = $kelas_err = $golongan_err ="";
			$kd_kelas = $kelas= $golongan = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST['kd_kelas'])) {
				$kd_kelas_err = "* kode kelas harus diisi !";
			}
			else {
				$kd_kelas = trim($_POST['kd_kelas']);
			}

			if (empty($_POST['kelas'])) {
				$kelas_err = "* kelas harus diisi !";
			}
			else {
				$kelas = trim($_POST['kelas']);
			}
			if (empty($_POST['golongan'])) {
				$golongan_err = "* golongan harus diisi !";
			}
			elseif (!is_numeric($_POST['golongan'])) {
				$golongan_err = "* Hanya dapat menginputkan angka !";
			}
			else {
				$golongan = trim($_POST['golongan']);
			}


				if ($kd_kelas_err == "" && $kelas_err == "" && $golongan_err == "") {
					mysqli_query($con, "UPDATE kelas SET kd_kelas = '$kd_kelas', kelas = '$kelas', golongan = '$golongan' WHERE kd_kelas = '$_POST[kd_kelas]' ");
					echo "<script>
						alert('Data berhasil diperbarui');
						window.location.href='data_kelas.php';
					 	</script>";
				}
			}
		?>


		<div class="main">
 		 <div class="main-content">
 			 <div class="container-fluid">
 				 <div class="panel">
 					 <div class="panel-heading">
 						 <h1 class="panel-title"><i class="fa fa-user"></i>&ensp;Edit Guru</h1>
 					 </div>
 				 </div>
 				 <div class="row">
 					 <div class="col-md-12">
 						 <div class="panel">
 							 <div class="row">
 							<div class="panel-body">
									<form method="POST" action="">
										<input type="hidden" name="kd_kelas" value="<?php echo $val['kd_kelas']?>">
										<div class="row">
											<div class="col-md-6">
												<div class="col-md-6">
												<label for="">Kode Kelas</label>
												<input type="text" name="kd_kelas" class="form-control" placeholder="kd_kelas" value="<?php echo($val['kd_kelas']) ?>">
		 										<span class="text-danger"> <?php echo($kd_kelas_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
										 <div class="col-md-6">
											 <label for="">kelas</label>
											 <input type="text" name="kelas" class="form-control" placeholder="kelas" value="<?php echo($val['kelas']) ?>">
											 <span class="text-danger"> <?php echo($kelas_err); ?></span>
										 </div>
										</div>
										<br>
										 <div class="row">
											<div class="col-md-6">
												<div class="col-md-6">
												<label for="">golongan</label>
												<input type="text" name="golongan" class="form-control" placeholder="golongan" value="<?php echo($val['golongan']) ?>">
		 										<span class="text-danger"> <?php echo($golongan_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
		 									<div class="col-md-6">
		 										<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>  Simpan</button> &nbsp; &nbsp;
		 										<button type="reset" name="reset" class="btn btn-danger" onclick="history.go(-1);"><i class="fa fa-times-circle"></i> &nbsp;  Batal</button>
		 									</div>
		 								</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
		<?php include '../dashboard/footer.php'; ?>
		<script src="../assets/vendor/jquery/jquery.min.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="../assets/scripts/klorofil-common.js"></script>
</body>
	</div>
</body>
</html>
