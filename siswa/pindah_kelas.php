<?php 
include '../koneksi.php';
if(!empty($_POST)){
	$pos = $_POST;
	$notif = array();
	foreach ($pos['siswa'] as $v) {
		if(!mysqli_query($con,"UPDATE siswa SET kd_kelas='$pos[kelas]' WHERE nis='$v'"))
			$notif[] = "Siswa $v Gagal diPerbarui. ".mysqli_error($con); 

	}
	echo "<script>".(empty($notif)?'':"alert('".implode('\n',$notif)."');")." window.location='data_siswa.php';</script>";
}else exit('<h1>404 Page Not Found</h1>');