<?php
    include '../koneksi.php';

    $kd_mapel = $_GET['kd_mapel'];
    //$query = "DELETE FROM 'tbl_user' WHERE 'id'=$id";
    //echo $query;
   $query = mysqli_query($con, "DELETE FROM mapel WHERE kd_mapel=$kd_mapel");
    if (mysqli_query($con, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

   header ("location:data_mapel.php");

?>
