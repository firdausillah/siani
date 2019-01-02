<?php
$connection = mysqli_connect('localhost','root','','siani');
$filename = 'backup_siani_db.sql';
$handle = fopen($filename,"r+");
$contents = fread($handle,filesize($filename));
$sql = explode(';',$contents);
foreach($sql as $query){
  $result = mysqli_query($connection,$query);
  if($result){
    echo "<script>
            alert('Data Berhasil Direstore');
            window.location.href='dashboard/dashboard.php';
          </script>";

  }
}
fclose($handle);

?>
