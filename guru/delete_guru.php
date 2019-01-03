<?php
    include '../koneksi.php';

    $id_guru = $_GET['id_guru'];
    // procedure
    $query = mysqli_query($con, "call delete_guru ('$id_guru')");
    if (mysqli_query($con, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

   header ("location:data_guru.php");

?>
