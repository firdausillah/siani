<?php
session_start();
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
	<title>Tambah Siswa | SIANI</title>
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
			print_r($_POST);
			$nis_err = $first_name_err = $last_name_err = $kd_kelas_err = $tgl_lahir_err = $alamat_err = $no_hp_err = $wali_murid_err = $hp_wali_err = "";
			$nis = $first_name = $last_name = $kd_kelas = $tgl_lahir = $alamat = $no_hp = $wali_murid = $hp_wali = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$qnis = mysqli_query($con, "SELECT nis FROM siswa WHERE nis = '$_POST[nis]'");
				$ceknis = mysqli_num_rows($qnis);
				if (empty($_POST['nis'])) {
					$nis_err = "* NIS harus diisi !";
				}
				elseif ($ceknis > 0) {
					$nis_err = "* NIS telah digunakan !";
				}
				else{
					$nis = trim($_POST['nis']);
				}

				if (empty($_POST['first_name'])) {
					$first_name_err = "* Nama Depan harus diisi !";
				}
				else if (!preg_match("/^[.a-zA-Z ]*$/", $_POST['first_name'])) {
					$first_name_err = "* Hanya dapat menginputkan huruf dan spasi !";
				}
				else {
					$first_name = trim($_POST['first_name']);
				}

				if (empty($_POST['last_name'])) {
					$last_name_err = "* Nama Belakang harus diisi !";
				}
				else if (!preg_match("/^[.a-zA-Z ]*$/", $_POST['last_name'])) {
					$last_name_err = "* Hanya dapat menginputkan huruf dan spasi !";
				}
				else {
					$last_name = trim($_POST['last_name']);
				}

				if (empty($_POST['kd_kelas'])) {
					$kd_kelas_err = "* Pilih kelas !";
				}
				else {
					$kd_kelas = trim($_POST['kd_kelas']);
				}

				if (empty($_POST['tgl_lahir'])) {
					$tgl_lahir_err = "* Tanggal Lahir harus diisi !";
				}
				else {
					$tgl_lahir = trim($_POST['tgl_lahir']);
				}

				if (empty($_POST['alamat']) || $_POST['alamat'] == "Alamat") {
					$alamat_err = "* Alamat harus diisi !";
				}
				else{
					$alamat = $_POST['alamat'];
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

				if (empty($_POST['wali_murid'])) {
					$wali_murid_err = "* Nama Wali harus diisi !";
				}
				else if (!preg_match("/^[.a-zA-Z ]*$/", $_POST['wali_murid'])) {
					$wali_murid_err = "* Hanya dapat menginputkan huruf dan spasi !";
				}
				else {
					$wali_murid = trim($_POST['wali_murid']);
				}

				if (empty($_POST['hp_wali'])) {
					$hp_wali_err = "* No Hp Wali harus diisi !";
				}
				elseif (!is_numeric($_POST['hp_wali'])) {
					$hp_wali_err = "* No Hp Wali harus berupa angka !";
				}
				else{
					$hp_wali = $_POST['hp_wali'];
				}

				// if ($nis_err == "" && $first_name_err == "" && $last_name_err == "" && $kd_kelas_err == "" && $tgl_lahir_err == "" && $alamat_err == "" && $no_hp_err == "" && $wali_murid_err == "" && $hp_wali == "") {

				// if(mysqli_query($con, "INSERT INTO siswa (nis, first_name, last_name, tgl_lahir, alamat, no_hp, wali_murid, hp_wali, kd_kelas) VALUES ('$nis', '$first_name', '$last_name', '$tgl_lahir', '$alamat', '$no_hp', '$wali_murid', '$hp_wali', '$kd_kelas')"))
				//exit("INSERT INTO siswa VALUES ('$nis', '$first_name', '$last_name', '$tgl_lahir', '$alamat', '$no_hp', '$wali_murid', '$hp_wali', '$kd_kelas')");
				if (!empty($_POST)&&$ceknis<=0) {
					if(mysqli_query($con, "INSERT INTO siswa VALUES ('$nis', '$first_name', '$last_name', '$tgl_lahir', '$alamat', '$no_hp', '$wali_murid', '$hp_wali', '$kd_kelas')"))
						echo "<script>
								alert('Data berhasil ditambah');
								window.location.href='data_siswa.php';
						  	  </script>";
				  else 
						echo "<script>
								alert('DB Error : ".mysqli_error($con)."');
							  </script>";
						echo "INSERT INTO siswa VALUES ('$nis', '$first_name', '$last_name', '$tgl_lahir', '$alamat', '$no_hp', '$wali_murid', '$hp_wali', '$kd_kelas')";

				}
			}
		?><div class="main">
 		 <div class="main-content">
 			 <div class="container-fluid">
 				 <div class="panel">
 					 <div class="panel-heading">
 						 <h1 class="panel-title"><i class="lnr lnr-user"></i>&ensp;Tambah Siswa</h1>
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
												<label for="">NIS</label>
												<input required type="number" name="nis" minlength="4" maxlength="6" class="form-control" placeholder="NIS" value="<?php echo(isset($_POST['nis']) ? $_POST['nis'] : $nis ) ?>">
		 										<span class="text-danger"> <?php echo($nis_err); ?></span>
											</div>
											<div class="col-md-6">
												<label for="">Nama Depan</label>
												<input required type="text" name="first_name" minlength="1" maxlength="20" class="form-control" placeholder="Nama Depan" value="<?php echo(isset($_POST['first_name']) ? $_POST['first_name'] : $first_name ) ?>">
		 										<span class="text-danger"> <?php echo($first_name_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">Nama Belakang</label>
													<input required type="text" name="last_name" minlength="1" maxlength="20" class="form-control" placeholder="Nama Belakang" value="<?php echo(isset($_POST['last_name']) ? $_POST['last_name'] : $last_name ) ?>">
			 										<span class="text-danger"> <?php echo($last_name_err); ?></span>
											</div>
											<div class="col-md-6">
												<label for="">Kelas</label>
											   		<select required class="form-control" name="kd_kelas">
											   			<option value="">-- Pilih Kelas --</option>
													<?php
														$qkelas = mysqli_query($con, "SELECT * FROM kelas LEFT JOIN jurusan ON kelas.id_jurusan=jurusan.id_jurusan");
														while($v=mysqli_fetch_array($qkelas)) {
															$kd_kls=$v[0]; 
															print_r($v);
															echo "<option value = '$kd_kls' ".(isset($_POST['kd_kelas']) && $_POST['kd_kelas'] == $kd_kls ? 'selected' : '')."> 
															$v[1] $v[5] $v[2]
															 </option>";
														}
													 ?>
											    	</select>
													<span class="text-danger"><?php echo (@$val['kd_kelas']) ?></span>
											 </div>
										</div>
										<br>
										<div class="row">
										  	<div class="col-md-6">
												<label for="">Tanggal Lahir</label>
													<input required type="date" name="tgl_lahir" minlength="10" maxlength="10" class="form-control" placeholder="Tanggal Lahir" value="<?php echo(isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : $tgl_lahir ) ?>">
		 												<span class="text-danger"> <?php echo($tgl_lahir_err); ?></span>
											</div>
											<div class="col-md-6">
												<label for="">Alamat</label>
												<textarea required placeholder="Alamat" name="alamat" class="form-control" rows="2"><?php echo $alamat ?></textarea>
												<span class="text-danger"> <?php echo($alamat_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">No. Hp</label>
												<input required type="text" name="no_hp" minlength="11" maxlength="13" class="form-control" placeholder="No. Hp" value="<?php echo(isset($_POST['no_hp']) ? $_POST['no_hp'] : $no_hp ) ?>">
		 										<span class="text-danger"> <?php echo($no_hp_err); ?></span>
											</div>
											<div class="col-md-6">
												<label for="">Wali Murid</label>
												<input required type="text" name="wali_murid" minlength="1" maxlength="20" class="form-control" placeholder="Nama Wali Murid" value="<?php echo(isset($_POST['wali_murid']) ? $_POST['wali_murid'] : $wali_murid ) ?>">
		 										<span class="text-danger"> <?php echo($wali_murid_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">Hp Wali</label>
												<input required type="text" name="hp_wali" minlength="11" maxlength="13" class="form-control" placeholder="No. Hp Wali" value="<?php echo(isset($_POST['hp_wali']) ? $_POST['hp_wali'] : $hp_wali ) ?>">
		 										<span class="text-danger"> <?php echo($hp_wali_err); ?></span>
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
