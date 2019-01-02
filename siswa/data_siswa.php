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
	<title>Data Siswa | SIANI</title>
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
		 ?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="lnr lnr-user"></i>&ensp;Data Siswa</h3>
							<div class="col-md-2 col-md-offset-10">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<br>
								<div class="row">
									<div class="col-md-2">
										<a href="tambah_siswa.php">
											<button type="button" class="btn btn-primary btn-sm" style="margin-left: 25px; margin-bottom: 10px;">Tambah</button>
										</a>
									</div>
								</div>

								<div class="panel-body">
									<table class="table table-striped table-hover table-bordered" id="datatables">
										<thead>
											<tr>
												<th>&nbsp;</th>
												<th>No.</th>
												<th>NIS</th>
												<th>Nama</th>
												<th>Kelas</th>
												<th>Tanggal Lahir</th>
												<th>Alamat</th>
												<th>No. Hp</th>
												<th>Wali Murid</th>
												<th>Hp Wali</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<script type="text/javascript">
												function konfirm() {
													return confirm("Yakin hapus data ?");
												}
											</script>
											<?php
												if (isset($_POST['btn_cari'])) {
													$where = "WHERE first_name LIKE '%$_POST[cari]%'";
												}
												else{
													$and = "";
												}
												$query = "SELECT siswa.nis, first_name, last_name, tgl_lahir, alamat, no_hp, wali_murid, hp_wali, kelas, jurusan, golongan FROM siswa LEFT JOIN kelas ON siswa.kd_kelas=kelas.kd_kelas LEFT JOIN jurusan ON kelas.id_jurusan=jurusan.id_jurusan WHERE siswa.kd_kelas='$_GET[kelas]'";
												$result = mysqli_query($con, $query);
												$no = 1;


												foreach ($result as $val) {
													echo "<tr>
															<td><input type='checkbox' name='siswa[]' value='$val[nis]' form='form_pindah_kelas'></td>
															<td>$no</td>
															<td>$val[nis]</td>
															<td>$val[first_name] $val[last_name]</td>
															<td>$val[kelas] $val[jurusan] $val[golongan]</td>
															<td>$val[tgl_lahir]</td>
															<td>$val[alamat]</td>
															<td>$val[no_hp]</td>
															<td>$val[wali_murid]</td>
															<td>$val[hp_wali]</td>
															<td>
																<a href='edit_siswa.php?nis=$val[nis]' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a>
																<a onclick='return konfirm()' href='delete_siswa.php?nis=$val[nis]' class='btn btn-danger btn-xs' title='Hapus'><i class='lnr lnr-trash'></i></a>
															</td>
														  </tr>
													";
													$no++;
												}
													?>
										</tbody>
									</table>

									<form id="form_pindah_kelas" onsubmit="return confirm('Pindahkan Siswa ?')" method="POST" action="pindah_kelas.php">
										<div class="form-group" style="margin-top: 10px">
											<div class="input-group">
												<span class="input-group-addon">Pindahkan Ke-</span>
												<select class="form-control" name="kelas" required>
													<?php $q = mysqli_query($con,"SELECT * FROM kelas k LEFT JOIN jurusan j ON(k.id_jurusan=j.id_jurusan)");
													foreach ($q as $key => $value) {
														echo "<option value='$value[kd_kelas]'>$value[kelas] $value[jurusan] $value[golongan]</option>";
													 } ?>
												</select>
												<div class="input-group-btn">
													<button type="submit" class="btn btn-primary">Pindahkan</button>
												</div>
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
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>
	<script src="../assets/datatables/js/dataTables.bootstrap.js"></script>
	<script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$('#datatables').DataTable();
	</script>
</body>


</html>
