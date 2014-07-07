<?php

$asal       = $_REQUEST['asal'];
$tiba       = $_REQUEST['tiba'];
$rute       = $_REQUEST['rute'];

$kode       = rand(0000,9999);

include '../../inc/conn.php';

$sql = "insert into angkot (Kode_ang,asal,Tiba,Rute) values ('$kode', '$asal','$tiba','$rute')";
$result = @mysql_query($sql);

if ($result){
	echo "<script>
	alert('Input Jalur Angkot berhasil');
	location.href='../../home.php?module=module/angkot/index.php';</script>";
} else {
	echo "<script>
	alert('Input Jalur Angkot Gagal');
	location.href='../../home.php?module=module/angkot/index.php';</script>";
}
?>