<?php
	$nav = $nav_uri = explode('/', $_SERVER['REQUEST_URI']);
	//$nav_dok = $nav[count($nav)]
	$nav = $nav[count($nav) - 2];
	echo $nav;
	include_once ($nav=='biodata'?'../':'').'../koneksi.php';
 ?>
<style>
	.nav_sub2>li{
		padding-left: 30px;
	}
	.nav_sub3>li{
			padding-left: 45px;
		}
</style>
 <!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<?php
				// session_start();
					if ($_SESSION['level'] == 'Admin') {?>

						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == 'dashboard' ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../users/data_user.php" class="<?php echo ($nav == "users" ? 'active' : '') ?>"><i class="lnr lnr-users"></i> <span>Data User</span></a></li>
						<li class="active">
							<a href="#subPagess" data-toggle="collapse" class="<?php echo ($nav == "siswa" ? 'active' : '') ?>"><i class="lnr lnr-user"></i><span>Siswa</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagess" class="collapse">
								<ul class="nav">
											<?php
												$query = (mysqli_query($con, "SELECT * FROM jurusan"));
												foreach ($query as $key => $value) {
											?>
											<li>
												<a data-toggle="collapse" href="#navjur1<?php echo $key; ?>"><?php echo $value['jurusan'] ?> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
												<ul class="collapse nav nav_sub3" id="navjur1<?php echo $key; ?>">
													<?php
														$query2 = (mysqli_query($con, "SELECT * FROM kelas WHERE id_jurusan='$value[id_jurusan]'"));
														foreach ($query2 as $key2 => $value2) {
													?>
													<li>
														<a class="<?php echo (@$_GET['kelas']==$value2['kd_kelas'])?'active':'' ?>" href="../siswa/data_siswa.php?kelas=<?php echo $value2['kd_kelas'] ?>"><?php echo $value2['kelas']." ".$value2['golongan'] ?></a>
													</li>
												<?php } ?>
												</ul>
											</li>
										<?php } ?>
								</ul>
							</div>
						</li>
						<li><a href="../guru/data_guru.php" class="<?php echo ($nav == "guru" ? 'active' : '') ?>"><i class="lnr lnr-user"></i> <span>Data Guru</span></a></li>
						<li><a href="../mapel/data_mapel.php" class="<?php echo ($nav == "mapel" ? 'active' : '') ?>"><i class="fa fa-file-o"></i> <span>Mata Pelajaran</span></a></li>
						<li><a href="../kelas/data_kelas.php" class="<?php echo ($nav == "kelas" ? 'active' : '') ?>"><i class="fa fa-building-o"></i> <span>Kelas</span></a></li>
						<li><a href="../jurusan/data_jurusan.php" class="<?php echo ($nav == "jurusan" ? 'active' : '') ?>"><i class="fa fa-building-o"></i> <span>Jurusan</span></a></li>
						<li class="active">
							<a href="#subPages1" data-toggle="collapse" class="<?php echo ($nav == "raport" ? 'active' : '') ?>"><i class="lnr lnr-list"></i><span>Raport</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse">
								<ul class="nav">
									<li><a href="#sub2" data-toggle="collapse"><i class=""></i> Nilai <i class="icon-submenu lnr lnr-chevron-left"></i></a>
										<ul  class="collapse nav nav_sub2" id="sub2">
											<?php
												$query = (mysqli_query($con, "SELECT * FROM jurusan"));
												foreach ($query as $key => $value) {
											?>
											<li>
												<a data-toggle="collapse" href="#navjur<?php echo $key; ?>"><?php echo $value['jurusan'] ?> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
												<ul class="collapse nav nav_sub3" id="navjur<?php echo $key; ?>">
													<?php
														$query2 = (mysqli_query($con, "SELECT * FROM kelas WHERE id_jurusan='$value[id_jurusan]'"));
														foreach ($query2 as $key2 => $value2) {
													?>
													<li>
														<a class="<?php echo (@$_GET['kelas']==$value2['kd_kelas'])?'active':'' ?>" href="../raport/data_nilai.php?kelas=<?php echo $value2['kd_kelas'] ?>"><?php echo $value2['kelas']." ".$value2['golongan'] ?></a>
													</li>
												<?php } ?>
												</ul>
											</li>
										<?php } ?>
										</ul>
									</li>
								</ul>
							</div>
						</li>
				<?php
					}
					elseif ($_SESSION['level'] == 'Siswa') {?>

						<li><a href="../dashboard/biodata.php" class="<?php echo ($nav == 'biodata' ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Bio Data Siswa</span></a></li>
						<li><a href="../raport/nilai_siswa.php" class="<?php echo ($nav == "nilai" ? 'active' : '') ?>"><i class="lnr lnr-book"></i> <span>Nilai</span></a>

				<?php
					}
					elseif ($_SESSION['level'] == 'Guru') {?>

						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == 'dashboard' ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li class="active">
							<a href="#subPagess" data-toggle="collapse" class="<?php echo ($nav == "siswa" ? 'active' : '') ?>"><i class="lnr lnr-user"></i><span>Siswa</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagess" class="collapse">
								<ul class="nav">
											<?php
												$query = (mysqli_query($con, "SELECT * FROM jurusan"));
												foreach ($query as $key => $value) {
											?>
											<li>
												<a data-toggle="collapse" href="#navjur1<?php echo $key; ?>"><?php echo $value['jurusan'] ?> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
												<ul class="collapse nav nav_sub3" id="navjur1<?php echo $key; ?>">
													<?php
														$query2 = (mysqli_query($con, "SELECT * FROM kelas WHERE id_jurusan='$value[id_jurusan]'"));
														foreach ($query2 as $key2 => $value2) {
													?>
													<li>
														<a class="<?php echo (@$_GET['kelas']==$value2['kd_kelas'])?'active':'' ?>" href="../siswa/data_siswa.php?kelas=<?php echo $value2['kd_kelas'] ?>"><?php echo $value2['kelas']." ".$value2['golongan'] ?></a>
													</li>
												<?php } ?>
												</ul>
											</li>
										<?php } ?>
								</ul>
							</div>
						</li>
							<li><a href="../guru/data_guru.php" class="<?php echo ($nav == "guru" ? 'active' : '') ?>"><i class="lnr lnr-user"></i> <span>Data Guru</span></a></li>
							<li class="active">
								<a href="#subPages1" data-toggle="collapse" class="<?php echo ($nav == "raport" ? 'active' : '') ?>"><i class="lnr lnr-list"></i><span>Raport</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages1" class="collapse">
									<ul class="nav">
										<li><a href="#sub2" data-toggle="collapse"><i class=""></i> Nilai <i class="icon-submenu lnr lnr-chevron-left"></i></a>
											<ul  class="collapse nav nav_sub2" id="sub2">
												<?php
												 	$query = (mysqli_query($con, "SELECT * FROM jurusan"));
													foreach ($query as $key => $value) {
												?>
												<li>
													<a data-toggle="collapse" href="#navjur<?php echo $key; ?>"><?php echo $value['jurusan'] ?> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
													<ul class="collapse nav nav_sub3" id="navjur<?php echo $key; ?>">
														<?php
														 	$query2 = (mysqli_query($con, "SELECT * FROM kelas WHERE id_jurusan='$value[id_jurusan]'"));
															foreach ($query2 as $key2 => $value2) {
														?>
														<li>
															<a class="<?php echo (@$_GET['kelas']==$value2['kd_kelas'])?'active':'' ?>" href="../raport/input_nilai.php?kelas=<?php echo $value2['kd_kelas'] ?>"><?php echo $value2['kelas']." ".$value2['golongan'] ?></a>
														</li>
													<?php } ?>
													</ul>
												</li>
											<?php } ?>
											</ul>
										</li>
									</ul>
								</div>
							</li>
					<?php
					}
				 	?>

					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
