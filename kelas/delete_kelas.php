<?php
    include '../koneksi.php';
// print_r($_GET); exit();
    $kd_kelas = $_GET['kd_kelas'];
         if (mysqli_query($con, "DELETE FROM kelas WHERE kd_kelas='$kd_kelas'")) {
            echo "Record deleted successfully";
           header ("location:data_kelas.php");
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }


?>
