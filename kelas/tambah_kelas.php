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
	<title>Data Kelas | SIANI</title>
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

		$kode_kelas_err = $kelas_err = $golongan_err = $jurusan_err = "";
		$kode_kelas = $kelas= $golongan = $jurusan = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);

			if (empty($_POST['kode_kelas'])) {
				$kode_kelas_err = "* kode kelas harus diisi !";
			}
			else {
				$kode_kelas = trim($_POST['kode_kelas']);
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

			if (empty($_POST['jurusan'])) {
				$jurusan_err = "* Pilih Jurusan !";
			}
			else {
				$jurusan = trim($_POST['jurusan']);
			}

			// if ($kode_kelas_err == "" && $kelas_err == "" && $golongan_err = "" && $jurusan_err = "") {
			if (!empty($_POST)) {
				if(mysqli_query($con, "INSERT INTO kelas (kd_kelas, kelas, golongan, id_jurusan) VALUE ('$kode_kelas','$kelas', '$golongan', '$jurusan') "))
				echo "<script>
						alert('Data berhasil ditambah');
						window.location.href='data_kelas.php';
					  </script>";
						else {

							echo "<script>
									alert('".mysqli_error($con)."');
								  </script>";
						}
			}

		}

		 ?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title"><i class="fa fa-building-o"></i>&ensp; Tambah Data Kelas</h1>
						</div>
					</div>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-body">
		 							<form method="POST" action="">
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Kode Kelas</label>
		 										<input type="text" name="kode_kelas" class="form-control" placeholder="Kode Kelas" value="<?php echo(isset($_POST['kode_kelas']) ? $_POST['kode_kelas'] : $kode_kelas ) ?>">
		 										<span class="text-danger"> <?php echo($kode_kelas_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
											<div class="col-md-6">
												<label for="">Kelas</label>
												<input type="text" name="kelas" class="form-control" placeholder="Kelas" value="<?php echo(isset($_POST['kelas']) ? $_POST['kelas'] : $kelas ) ?>">
												<span class="text-danger"> <?php echo($kelas_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Golongan</label>
		 										<input type="text" name="golongan" class="form-control" placeholder="Golongan" value="<?php echo(isset($_POST['kode_kelas']) ? $_POST['golongan'] : $golongan ) ?>">
		 										<span class="text-danger"> <?php echo($golongan_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
										<div class="row">
										  <div class="col-md-6">
												<label for="">Jurusan</label>
										    <select class="form-control" name="jurusan">
													<option value="">-- Pilih Jurusan --</option>
													<?php
														$qjurusan = mysqli_query($con, "SELECT * FROM jurusan");
														while ($val = mysqli_fetch_assoc($qjurusan)) {
															echo "<option value = '$val[id_jurusan]' isset($_POST[jurusan]) && $_POST[jurusan] == $val[id_jurusan] ? 'selected' : ''> $val[jurusan] </option>";
														}
													 ?>
										    </select>
												<span class="text-danger"><?php echo ($jurusan_err) ?></span>
										  </div>
										</div>
										<br>
		 								<div class="row">
		 									<div class="col-md-6">
		 										<button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp; Tambah</button>
		 										<button type="reset" name="reset" class="btn btn-danger" onclick="history.go(-1);"><i class="fa fa-times-circle"></i>&nbsp; Batal</button>
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
