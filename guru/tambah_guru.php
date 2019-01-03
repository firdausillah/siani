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
	<title>Data Guru | SIANI</title>
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

			$id_guru_err = $nama_guru_err = $no_hp_err = $email_err = "";
			$id_guru = $nama_guru = $no_hp = $email = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$quser = mysqli_query($con, "SELECT nama_guru FROM guru WHERE nama_guru = '$_POST[nama_guru]'");
				$cekuser = mysqli_num_rows($quser);
				if (empty($_POST['id_guru'])) {
					$id_guru_err = "* ID harus diisi !";
				}
				elseif (!is_numeric($_POST['no_hp'])) {
					$no_hp_err = "* ID harus berupa angka !";
				}
				elseif ($cekid_guru > 0) {
					$id_guru_err = "* ID telah digunakan !";
				}
				else {
					$id_guru = trim($_POST['id_guru']);
				}

				if (empty($_POST['nama_guru'])) {
					$nama_guru_err = "* Nama harus diisi !";
				}
				else if (!preg_match("/^[.a-zA-Z ]*$/", $_POST['nama_guru'])) {
					$nama_guru_rr = "* Hanya dapat menginputkan huruf dan spasi !";
				}
				else {
					$nama_guru = trim($_POST['nama_guru']);
				}

				if (empty($_POST['no_hp'])) {
					$no_hp_err = "* No Hp harus diisi !";
				}
				elseif (!is_numeric($_POST['no_hp'])) {
					$no_hp_err = "* No Hp harus berupa angka !";
				}
				else{
					$no_hp = $_POST['no_hp'];
				}

				if (empty($_POST['email'])) {
					$email_err = "* Email harus diisi !";
				}
				else{
					$email = trim($_POST['email']);
				}
				if ($id_guru_err == "" && $nama_guru_err == "" && $no_hp_err == "" && $email_err == "") {
					mysqli_query($con, "INSERT INTO guru (id_guru, nama_guru, no_hp, email) VALUE ('$id_guru', '$nama_guru', '$no_hp', '$email')");
					echo "<script>
						alert('Data berhasil ditambah');
						window.location.href='data_guru.php';
					  </script>";
				}
			}
		?>
		<div class="main">
 		 <div class="main-content">
 			 <div class="container-fluid">
 				 <div class="panel">
 					 <div class="panel-heading">
 						 <h1 class="panel-title"><i class="lnr lnr-user"></i>&ensp; Tambah Guru</h1>
 					 </div>
 				 </div>
 				 <div class="row">
 					 <div class="col-md-12">
 						 <div class="panel">
 							 <div class="row">
 							<div class="panel-body">
									<form method="POST" action="">
										<div class="row">
											<div class="col-md-6">
												<label for="">ID</label>
												<input type="text" name="id_guru" minlength="4" maxlength="6" class="form-control" placeholder="ID Guru" value="<?php echo(isset($_POST['id_guru']) ? $_POST['id_guru'] : $id_guru ) ?>">
		 										<span class="text-danger"> <?php echo($id_guru_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">Nama Guru</label>
												<input type="text" name="nama_guru" minlength="1" maxlength="20" class="form-control" placeholder="Nama Guru" value="<?php echo(isset($_POST['nama_guru']) ? $_POST['nama_guru'] : $nama_guru ) ?>">
												<span class="text-danger"> <?php echo($nama_guru_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">No. Hp</label>
												<input type="text" name="no_hp" minlength="11" maxlength="13" class="form-control" placeholder="No. Hp" value="<?php echo(isset($_POST['no_hp']) ? $_POST['no_hp'] : $no_hp ) ?>">
		 										<span class="text-danger"> <?php echo($no_hp_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
										  	<div class="col-md-6">
												<label for="">Email</label>
													<input type="text" name="email" minlength="2" maxlength="30" class="form-control" placeholder="Email" value="<?php echo(isset($_POST['email']) ? $_POST['email'] : $email ) ?>">
		 												<span class="text-danger"> <?php echo($email_err); ?></span>
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

		<div class="clearfix"></div>
		<?php include '../dashboard/footer.php'; ?>
	</div>
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>
</body>
</html>
