<?php
    include '../koneksi.php';

    $nis = $_GET['nis'];
    // procedure
    $query = mysqli_query($con, "call delete_data_siswa ('$nis')");
        if (mysqli_query($con, $query)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }

       header ("location:data_siswa.php");
?>
