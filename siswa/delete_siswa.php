<?php
    include '../koneksi.php';

    $nis = $_GET['nis'];
    $query = mysqli_query($con, "DELETE FROM siswa WHERE nis=$nis");
        if (mysqli_query($con, $query)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }

       header ("location:data_siswa.php");
?>