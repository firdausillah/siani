<?php
session_start();
//print_r($_SESSION); exit;
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
	<title>Raport | SIANI</title>
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
			//print_r($_POST); //exit();
			$mapel = mysqli_query($con, "SELECT * FROM mapel");
			$siswa = mysqli_query($con, "SELECT * FROM siswa WHERE kd_kelas='$_GET[kelas]'");
			$id_guru = $_SESSION['user_name'];
			$th_aka = mysqli_fetch_object(mysqli_query($con,"SELECT * FROM thn_akad ORDER BY id_thn_akad DESC"))->id_thn_akad;


			if(!empty($_POST['act'])){
				$siswa = $_POST['siswa'];
				$mapel = $_POST['mapel'];

				$notif = "";
				foreach ($siswa as $siswa_key => $siswa_val) {
					$spr = $_POST['spiritual'][$siswa_key];
					$sosial = $_POST['sosial'][$siswa_key];
					$pengetahuan = $_POST['pengetahuan'][$siswa_key];
					$keterampilan = $_POST['keterampilan'][$siswa_key];
					$id_hasil = $_POST['id_hasil_nilai'][$siswa_key];

					$datamapel=array();
					$delete_nilaimapel=array();

					foreach ($mapel as $mapel_key => $mapel_val) {
						$delete_nilaimapel[]=$mapel_val;
						$nilai = $_POST['nilai'.$mapel_key][$siswa_key];
						$datamapel[] = "null,'$siswa_val','$nilai','$mapel_val','$id_guru','$th_aka','$spr','$sosial','$pengetahuan','$keterampilan'";
					}
					if(mysqli_query($con,"DELETE FROM hasil_nilai WHERE kd_mapel IN('".implode("','",$delete_nilaimapel)."') AND nis='$siswa_val' AND id_thn_akad='$th_aka'")){
						if(mysqli_query($con,"INSERT INTO hasil_nilai VALUES(".implode('),(', $datamapel).")")){
							$notif = "Data Nilai Berhasil Disimpan.";
						}else $notif = "PInsert ".mysqli_error($con);
					}else $notif = "PDel ".mysqli_error($con);

				}
				echo "<script>".((!empty($notif))?"alert('$notif');":'')."window.location='input_nilai.php?".(empty($_GET)?'':http_build_query($_GET))."'</script>";
				
			}


			$q=mysqli_query($con,"SELECT * FROM mapel;");
			$mapel=array();
			foreach ($q as $val) {
				$mapel[]=$val;
			}

			?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid container">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="lnr lnr-user"></i>&ensp;Raport</h3>
							<div class="col-md-2 col-md-offset-10">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<br>
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-6"></div>
									<div class="col-md-4">
										<form action="" method="POST">
											<div class="input-group" style="margin-right: 25px;">
												<input type="text" name="cari" class="form-control input-sm" placeholder="Cari berdasarkan nama ...">
												<span class="input-group-btn"><button type="submit" name="btn_cari" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button></span>
											</div>
										</form>
									</div>
								</div>

								<div class="panel-body">
									<div class="table-responsive">
									<form method="post" id="form_nilai">
									<table class="table table-striped table-hover table-bordered">
										<thead align="center">
                      <tr>
                				<td rowspan="2">No</td>
                				<td rowspan="2" >Nama Siswa</td>
                				<td colspan="<?php echo count($mapel);?>">Nilai</td>
                				<td colspan="4">Nilai Kompentensi</td>
                			</tr>
                			<tr>
												<?php
													foreach ($mapel as $val) { ?>
                					<input type="hidden" value="<?php echo $val['kd_mapel'] ?>" name="mapel[]">
                					<td width="150"><?php echo $val['mapel'] ?></td>
                				<?php }
                				foreach (array('Spiritual','Sosial','Pengetahuan','Keterampilan') as $val) { echo "<td>$val</td>"; }?>
                			</tr>
										</thead>


                    <tbody>
                      <?php
												foreach ($siswa as $key => $val) {
                        $hsl_nilai = mysqli_fetch_object(mysqli_query($con,"SELECT * FROM hasil_nilai WHERE nis='$val[nis]' AND id_thn_akad='$th_aka'"));
                        ?>
                        <input type="hidden" value="<?php echo $val['nis'] ?>" name="siswa[]">
                        <input type="hidden" value="<?php echo @$hsl_nilai->id_hasilnilai ?>" name="id_hasil_nilai[]">
                        <tr>
													<!-- nomor -->
                          <td><?php echo ($key+1); ?></td>

													<!-- nama -->
                          <td ><?php echo $val['first_name'].' '.$val['last_name'] ?></td>


                          <?php foreach ($mapel as $key2 => $value) {
                            $nilai = mysqli_fetch_object(mysqli_query($con,"SELECT * FROM hasil_nilai WHERE nis='$val[nis]' AND id_thn_akad='$th_aka' AND kd_mapel='$value[kd_mapel]'"));
                          ?>

														<!-- nilai -->
                            <td>
                              <input type="number" maxlength="3" required value="<?php echo $nilai->nilai; ?>" name="nilai<?php echo $key2 ?>[]">
                            </td>

                          <?php }
                          foreach (array('spiritual','sosial','pengetahuan','keterampilan') as $val) { ?>

														<!-- kompetensi -->
                            <td>
                              <textarea name="<?php echo $val ?>[]" required><?php echo @$nilai->$val?></textarea>
                            </td>

                          <?php } ?>
                        </tr>
                      <?php } ?>
									</table>
								</form>
								</div>
								<div class="row">
                  <div class="col-md-8"></div>
                  <div class="col-md-2">
										<?php if(mysqli_num_rows($siswa)>0){ ?>
                      <button type="submit" form="form_nilai" name="act" value="save" class="btn btn-primary btn-sm" style="margin-left: 25px; margin-bottom: 10px;">Simpan</button>
										<?php } ?>
									</div>
									<!-- <span class="text-default">Jumlah data : <?php echo($jml_siswa) ?></span> -->
								</div>
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

</body>
</html>
