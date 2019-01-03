<?php
    include '../koneksi.php';

    $id_guru = $_GET['id_guru'];
    $query = mysqli_query($con, "DELETE FROM guru WHERE id_guru=$id_guru");
    if (mysqli_query($con, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

   header ("location:data_guru.php");

?>
