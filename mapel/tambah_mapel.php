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
	<title>Data Mata Pelajaran | SIANI</title>
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

		$kd_mapel_err = $mapel_err = "";
		$kd_mapel = $mapel = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);
			if (empty($_POST['kd_mapel'])) {
				$kd_mapel_err = "* harus diisi !";

			}

			else {
				$kd_mapel = trim($_POST['kd_mapel']);

			}

					if (empty($_POST['mapel']) || $_POST['mapel'] == "mapel") {
				$mapel_err = "* harus diisi !";

			}
			else{
				$mapel = $_POST['mapel'];

			}

			if ($kd_mapel_err == "" && $mapel_err == "") {
				mysqli_query($con, "INSERT INTO mapel (kd_mapel, mapel) VALUE ( '$kd_mapel','$mapel')");

				//echo "berhasilkah?";
				echo "<script>
						alert('Data berhasil ditambah');
						window.location.href='data_mapel.php';
					  </script>";

			}

		}

		 ?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title"><i class="lnr lnr-user"></i>&ensp;Tambah mapel</h1>
						</div>
					</div>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-body">
		 							<form method="POST" action="">
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Kode Mata Pelajaran</label>
		 										<input type="text" name="kd_mapel" class="form-control" placeholder="Kode Mata Pelajaran" value="<?php echo(isset($_POST['kd_mapel']) ? $_POST['kd_mapel'] : $kd_mapel ) ?>">
		 										<span class="text-danger"> <?php echo($kd_mapel_err); ?></span>
		 									</div>
                    </div>

		 								<br>
		 								<div class="row">
											<div class="col-md-6">
												<label for="">Mata pelajaran</label>
												<input type="text" name="mapel" placeholder="mata pelajaran" class="form-control" value="<?php echo($mapel) ?>">
												<span class="text-danger"> <?php echo($mapel_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
		 									<div class="col-md-6">
		 										<button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Tambah</button> &nbsp;
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
	</div>
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>

</body>

</html>
