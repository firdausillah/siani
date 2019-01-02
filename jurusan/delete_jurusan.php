<?php
    include '../koneksi.php';

    $id_jurusan = $_GET['id_jurusan'];
    //$query = "DELETE FROM 'tbl_jurusan' WHERE 'id_jurusan'=$id";
    //echo $query;
   $query = mysqli_query($con, "DELETE FROM jurusan WHERE id_jurusan=$id_jurusan");
    if (mysqli_query($con, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

   header ("location:data_jurusan.php");

?>
