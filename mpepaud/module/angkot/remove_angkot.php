<?php

$id = intval($_REQUEST['id']);

include 'inc/conn.php';

$sql = "delete from angkot where Kode_ang=$id";
$result = @mysql_query($sql);
if ($result){
	echo "<script>
	alert('Jalur Angkot Berhasil Dihapus');
	location.href='home.php?module=module/angkot/index.php';</script>";
} else {
	echo "<script>
	alert('Jalur Angkot Gagal Dihapus');
	location.href='home.php?module=module/angkot/index.php';</script>";
}
?>