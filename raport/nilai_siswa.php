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
$q =mysqli_query($con,"SELECT * FROM siswa s LEFT JOIN kelas k ON s.kd_kelas=k.kd_kelas LEFT JOIN jurusan j ON k.id_jurusan=j.id_jurusan WHERE s.nis = '$_SESSION[user_name]'");
$r=mysqli_fetch_object($q);

$mapel = mysqli_query($con, "SELECT * FROM mapel");
$result=mysqli_fetch_object($mapel);

$th_aka = mysqli_fetch_object(mysqli_query($con,"SELECT * FROM thn_akad ORDER BY id_thn_akad DESC"))->id_thn_akad;

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

			 include '../dashboard/navbar.php';
			 include '../dashboard/left_sidebar.php';
			 ?>
			 <style media="screen">
			 	.bg_title{
					background: lightgrey ;
				}
			 </style>
<!-- MAIN -->
			<!-- MAIN CONTENT -->
			<div class="main">
	 		 <div class="main-content">
	 			 <div class="container-fluid">
	 				 <div class="panel">
	 					 <div class="panel-heading">
	 						 <h1 class="panel-title"></i>&ensp;Selamat Datang <?php echo $r->first_name.' '.$r->last_name ?></h1>
	 					 </div>
	 				 </div>
	 				 <div class="row">
	 					 <div class="col-md-12">
	 						 <div class="panel">
	 							 <div class="row">
	 							<div class="panel-body">
									<table class="table">
                    <tr class="bg_title">
                      <td>Mata Pelajaran</td>
                      <td width="100">Nilai</td>
                    </tr>
                    <?php $q = mysqli_query($con,"SELECT * FROM mapel");foreach ($q as $mapel) { ?>
                      <tr>
                        <td><?php echo $mapel['mapel'] ?></td>
                        <td>
                          <?php echo @mysqli_fetch_object(mysqli_query($con,"SELECT * FROM hasil_nilai WHERE nis='$r->nis' AND kd_mapel='$mapel[kd_mapel]' AND id_thn_akad='$th_aka'"))->nilai; ?>
                        </td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr class="bg_title">
                      <td colspan="2">Kompentensi</td>
                    </tr>
                    <?php $komp = mysqli_fetch_object(mysqli_query($con,"SELECT * FROM hasil_nilai WHERE nis='$r->nis' AND spiritual!='' AND id_thn_akad='$th_aka'"));  ?>
                    <tr>
                      <td>Spiritual</td>
                      <td><?php echo @$komp->spiritual ?></td>
                    </tr>
                    <tr>
                      <td>Sosial</td>
                      <td><?php echo @$komp->sosial ?></td>
                    </tr>
                    <tr>
                      <td>Pengetahuan</td>
                      <td><?php echo @$komp->pengetahuan ?></td>
                    </tr>
                    <tr>
                      <td>Keterampilan</td>
                      <td><?php echo @$komp->keterampilan ?></td>
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
