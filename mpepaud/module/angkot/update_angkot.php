<?php

$id = intval($_REQUEST['kode_ang']);
$asal   = $_REQUEST['asal'];
$tiba   = $_REQUEST['tiba'];
$rute   = $_REQUEST['rute']; 

include '../../inc/conn.php';

$sql = "update angkot set asal='$asal', Tiba='$tiba', Rute='$rute' where Kode_ang=$id";
$result = @mysql_query($sql);

if ($result){
	echo "<script>
	alert('Ubah Angkot Berhasil');
	location.href='../../home.php?module=module/angkot/index.php';</script>";
} else {
	echo "<script>
	alert('Input Angkot Gagal');
	location.href='../../home.php?module=module/angkot/index.php';</script>";
}
?>