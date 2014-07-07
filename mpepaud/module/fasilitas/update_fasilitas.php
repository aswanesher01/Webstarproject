<?php

$id = intval($_REQUEST['id_fasilitas']);
$nama_fas = $_REQUEST['Nama_Fasilitas'];
$paud= $_REQUEST['id_paud'];

include '../../inc/conn.php';

$sql = "update fasilitas set Nama_fas='$nama_fas', id_paud='$paud' where Id_Fas='$id'";
$result = @mysql_query($sql);
if ($result){
	echo "<script>
	alert('Ubah Fasilitas sukses');
	location.href='../../home.php?module=module/fasilitas/index.php';</script>";
} else {
	echo "<script>
	alert('Ubah Fasilitas gagal');
	location.href='../../home.php?module=module/fasilitas/index.php';</script>";
}
?>