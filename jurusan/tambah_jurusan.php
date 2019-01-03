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
	<title>Data Jurusan | SIANI</title>
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

		$id_jurusan_err = $jurusan_err = "";
		$id_jurusan = $jurusan = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);
			if (empty($_POST['id_jurusan'])) {
				$id_jurusan_err = "* kode kelas harus diisi !";
			}
			elseif (!is_numeric($_POST['id_jurusan'])) {
				$id_jurusan_err = "* Hanya dapat menginputkan angka !";
			}
			else {
				$id_jurusan = trim($_POST['id_jurusan']);

			}

			if (empty($_POST['jurusan'])) {
				$jurusan_err = "* jurusan harus diisi !";
			}
			else {
				$jurusan = trim($_POST['jurusan']);
			}

			if ($id_jurusan_err == "" && $jurusan_err == "" ) {
				mysqli_query($con, "INSERT INTO jurusan (id_jurusan, jurusan) VALUE ('$id_jurusan', '$jurusan') ");

				echo "<script>
						alert('Data berhasil ditambah');
						window.location.href='data_jurusan.php';
					  </script>";
			}

		}

		 ?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title"><i class="fa fa-building-o"></i>&ensp; Tambah Data Jurusan</h1>
						</div>
					</div>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-body">
		 							<form method="POST" action="">
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">ID</label>
		 										<input type="text" name="id_jurusan" class="form-control" placeholder="ID Jurusan" value="<?php echo(isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : $id_jurusan ) ?>">
		 										<span class="text-danger"> <?php echo($id_jurusan_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
											<div class="col-md-6">
												<label for="">Jurusan</label>
												<input type="text" name="jurusan" class="form-control" placeholder="Jurusan" value="<?php echo(isset($_POST['jurusan']) ? $_POST['jurusan'] : $jurusan ) ?>">
												<span class="text-danger"> <?php echo($jurusan_err); ?></span>
		 									</div>
		 								</div>
		 								<br>	
		 								<div class="row">
		 									<div class="col-md-6">
		 										<button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp; Tambah</button>
		 										<button type="reset" name="reset" class="btn btn-danger" onclick="history.go(-1);"><i class="fa fa-times-circle"></i> &nbsp; Batal</button>
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
