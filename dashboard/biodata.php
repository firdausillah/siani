<?php
session_start();
if (empty($_SESSION['user_name']) && empty($_SESSION['level'])) {
	echo "<script>
		alert('Anda harus login dahulu !');
		window.location.href='../login.php';
	</script>";
}
else {
	include '../koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
	$now = date('Y-m-d');
}
$query =mysqli_query($con,"SELECT s.nis, s.first_name, s.last_name, k.kelas, s.tgl_lahir, s.alamat, s.no_hp, s.wali_murid, s.hp_wali, j.jurusan, k.golongan FROM siswa s LEFT JOIN kelas k ON s.kd_kelas=k.kd_kelas LEFT JOIN jurusan j ON k.id_jurusan=j.id_jurusan WHERE s.nis = '$_SESSION[user_name]'");
//exit("SELECT s.nis, s.first_name, s.last_name, k.kelas, s.tgl_lahir, s.alamat, s.no_hp, s.wali_murid, s.hp_wali FROM siswa s LEFT JOIN kelas k ON s.kd_kelas=k.kd_kelas WHERE s.nis = '$_SESSION[user_name]'");
$result=mysqli_fetch_object($query);
 ?>
<!doctype html>
<html lang="en">
<head>
	<title>Selamat Datang | SIANI</title>
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
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="shortcut icon" href="../assets/img/icon.ico">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php

			 include 'navbar.php';
			 include 'left_sidebar.php';
			 ?>
<!-- MAIN -->
			<!-- MAIN CONTENT -->
			<div class="main">
	 		 <div class="main-content">
	 			 <div class="container-fluid">
	 				 <div class="panel">
	 					 <div class="panel-heading">
	 						 <h1 class="panel-title"></i>&ensp;Selamat Datang <?php echo $result->first_name.' '.$result->last_name ?></h1>
	 					 </div>
	 				 </div>
	 				 <div class="row">
	 					 <div class="col-md-12">
	 						 <div class="panel">
	 							 <div class="row">
	 							<div class="panel-body">
									<table class="table">
										<tr>
											<td width="200" height="50">NIS</td>
											<td width="10">:</td>
											<td><?php echo $result->nis ?></td>
										</tr>
										<tr>
											<td width="200" height="50">Nama</td>
											<td width="10">:</td>
											<td><?php echo $result->first_name.' '.$result->last_name ?></td>
										</tr>
										<tr>
											<td width="200" height="50">Kelas</td>
											<td width="10">:</td>
											<td><?php echo $result->kelas.' '.$result->jurusan.' '.$result->golongan ?></td>
										</tr>
										<tr>
											<td width="200" height="50">Tanggal Lahir</td>
											<td width="10">:</td>
											<td><?php echo $result->tgl_lahir ?></td>
										</tr>
										<tr>
											<td width="200" height="50">Alamat</td>
											<td width="10">:</td>
											<td><?php echo $result->alamat ?></td>
										</tr>
										<tr>
											<td width="200" height="50">No Hp</td>
											<td width="10">:</td>
											<td><?php echo $result->no_hp ?></td>
										</tr>
										<tr>
											<td width="200" height="50">Wali Murid</td>
											<td width="10">:</td>
											<td><?php echo $result->wali_murid ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
			<!-- END MAIN CONTENT -->

		<!-- END MAIN -->

		<script src="../assets/vendor/jquery/jquery.min.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="../assets/scripts/klorofil-common.js"></script>
