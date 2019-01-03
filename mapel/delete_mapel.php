<?php
    include '../koneksi.php';
// print_r($_GET); exit();
    $kd_mapel = $_GET['kd_mapel'];
         if (mysqli_query($con, "DELETE FROM mapel WHERE kd_mapel='$kd_mapel'")) {
            echo "Record deleted successfully";
           header ("location:data_mapel.php");
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }

?>
