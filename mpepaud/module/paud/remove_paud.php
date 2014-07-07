<?php

$id = intval($_REQUEST['id']);

include 'inc/conn.php';

$sql = "delete from data_paud where id_paud=$id";
$result = mysql_query($sql);

$delnilai=mysql_query("delete from bobot_penilaian where id_paud='$id'");
$delfas=mysql_query("delete from fasilitas where id_paud='$id'");
$delgur=mysql_query("delete from pend_guru where id_paud='$id'");

if ($result){
	echo "<script>
	alert('Hapus PAUD Berhasil');
	location.href='home.php?module=module/paud/index.php';</script>";
} else {
	echo "<script>
	alert('Hapus PAUD Gagal');
	location.href='home.php?module=module/paud/index.php';</script>";
}
?>