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
	<title>Data User | SIANI</title>
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

			$query = "SELECT * FROM users WHERE id_user = '$_GET[id_user]'";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_assoc($result);

			$user_name_err = $password_err = $level_err = $konfirmasi_err = "";
			$user_name = $password = $nohp = $level = $konfirmasi = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST['user_name'])) {
					$user_name_err = "* Username harus diisi !";
				}
				else if (!preg_match("/^[a-zA-Z ]*$/", $_POST['user_name'])) {
					$user_name_err = "* Hanya dapat menginputkan huruf dan spasi !";
				}
				else {
					$user_name = trim($_POST['user_name']);
				}

				if (empty($_POST['password']) || $_POST['password'] == "password") {
					$password_err = "* password harus diisi !";
				}
				else{
					$password = trim($_POST['password']);
				}

				if (empty($_POST['level'])) {
					$level_err = "* Pilih level !";
				}
				else{
					$level = trim($_POST['level']);
				}

				if ($user_name_err == "" && $password_err == "" && $konfirmasi_err == "" && $level_err == "") {
					mysqli_query($con, "UPDATE users SET  user_name = '$user_name', password = '$password', level = '$level', status = 'Aktif' WHERE id_user = '$_POST[id_user]' ");
					echo "<script>
						alert('Data berhasil diperbarui');
						window.location.href='data_user.php';
					 	</script>";
				}
			}
		?>


		<div class="main">
		 <div class="main-content">
			 <div class="container-fluid">
				 <div class="panel">
					 <div class="panel-heading">
						 <h1 class="panel-title"><i class="lnr lnr-users"></i>&ensp; Edit Users</h1>
					 </div>
				 </div>
				 <div class="row">
					 <div class="col-md-12">
						 <div class="panel">
							 <div class="panel-body">
								 <form method="POST" action="">
									 	<input type="hidden" name="id_user" value="<?php echo $val['id_user']?>">
									 <div class="row">
										 <div class="col-md-6">
											 <label for="">User Name</label>
											 <input type="text" name="user_name" class="form-control" placeholder="User Name" value="<?php echo($val['user_name']) ?>">
											 <span class="text-danger"> <?php echo($user_name_err); ?></span>
										 </div>

									 </div>
									 <br>
									 <div class="row">
										 <div class="col-md-6">
											 <label for="">Password</label>
											 <input type="Password" name="password" placeholder="Password" class="form-control" value="<?php echo($val['password']) ?>"> <?php echo($password_err); ?></span>
										 </div>
									 </div>
									 <br>
									 <div class="row">
										 <div class="col-md-6">
											 <label for="">Konfirmasi Password</label>
											 <input type="password" name="konfirmasi" class="form-control" placeholder="Konfirmasi Password" value="<?php echo($val['password']) ?>">
											 <span class="text-danger"> <?php echo($konfirmasi_err); ?></span>
										 </div>
									 </div>
									 <br>
									 <div class="row">
										 <div class="col-md-6">
											 <label for="">Level</label>
											 <select class="form-control" name="level">
												 <option value="">Pilih Level</option>
												 <option value="Admin" <?php echo ($val['level'] == 'Admin' ? 'selected' : '') ?> > Admin </option>
												 <option value="Guru" <?php echo ($val['level'] == 'Guru' ? 'selected' : '') ?> > Guru </option>
												 <option value="Siswa" <?php echo ($val['level'] == 'Siswa' ? 'selected' : '') ?> > Siswa </option>

											 </select>
											 <span class="text-danger"> <?php echo($level_err); ?></span>
										 </div>
									 </div>
									 <br>
									 <div class="row">
										 <div class="col-md-6">
											 <button type="submit" name="button" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i>&nbsp; Simpan</button>
											 <button type="reset" name="reset" class="btn btn-danger btn-sm" onclick="history.go(-1)"> <i class="fa fa-times-circle"></i>&nbsp; Batal</button>
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

</html>
