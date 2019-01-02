
<?php
require '../../koneksi.php';

if(!empty($_POST)){
	print_r($_POST);

}

$q=mysqli_query($con,"select * FROM mapel;");
$mapel=array();
foreach ($q as $val) {
	$mapel[]=$val;
}

$siswa=mysqli_query($con,"select * FROM siswa;"); ?>

<form method="POST">
	<table width="100%" border="1">
		<thead align="center">
			<tr>
				<td rowspan="2">No</td>
				<td rowspan="2">Siswa</td>
				<td colspan="<?php echo count($mapel);?>">Nilai</td>
			</tr>
			<tr>
				<?php foreach ($mapel as $val) { echo "<td>$val[mapel]</td>"; } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($siswa as $key => $val) {?>
				<tr>
					<input type="hidden" value="<?php echo $val['nis'] ?>" name="siswa[]">
					<td><?php echo ($key+1) ?></td>
					<td><?php echo $val['first_name'].' '.$val['first_name'] ?></td>
					<?php foreach ($mapel as $key2 => $value) { ?>
						<td>
							<input type="hidden" value="<?php echo $value['kd_mapel'] ?>" name="mapel[]">
							<input type="number" maxlength="3" required name="nilai<?php echo $key2 ?>[]">
						</td>
					<?php } ?>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="<?php echo count($mapel)+3?>">
					<button type="submit">Simpan</button>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
