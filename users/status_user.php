<?php
	include '../koneksi.php';
	$status = $_GET['status'] == 'Aktif' ? 'Non Aktif' : 'Aktif';
	mysqli_query($con, "UPDATE users SET status = '$status' WHERE id_user = '$_GET[id_guru]' AND level != 'Guru'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil diperbarui ');
 	window.location.href='data_petugas.php';
 </script>
