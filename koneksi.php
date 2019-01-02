<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$db = "siani";

	$con = mysqli_connect($server, $username, $password);

	if (mysqli_connect_errno()) {
		die("Koneksi gagal".mysqli_connect_error());
	}
	else{

	}
	mysqli_select_db($con, $db);
 ?>
