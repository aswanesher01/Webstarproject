<?php

$id_paud        = rand(0000, 9999);
$nama_paud      = $_REQUEST['nm_paud'];
$alamat_paud    = $_REQUEST['alamat_paud'];
$telepon        = $_REQUEST['telepon'];
$uang_pangkal   = $_REQUEST['uang_pangkal'];
$spp            = $_REQUEST['spp'];
$latitude       = $_REQUEST['latitude'];
$longitude      = $_REQUEST['longitude']; 
$jenis_paud     = $_REQUEST['jns_paud'];

include '../../inc/conn.php';

$cekn=mysql_query("select nilai_jarak from bobot_penilaian where id_paud='$id_paud'");
$datan=mysql_fetch_array($cekn);

/* CEK PAUD */
$sqlcek=mysql_query("select id_paud from data_paud where nama_paud like '$nama_paud%' and jenis_sekolah='$jenis_paud'");
$hasilcek=mysql_num_rows($sqlcek);

if($hasilcek=="0"||$hasilcek=="") {

$sql="insert into data_paud (id_paud, nama_paud, Alamat_Paud, Telepon, Uang_Pangkal, Spp, Latitude, longitude, jenis_sekolah) 
values ('$id_paud', '$nama_paud', '$alamat_paud', '$telepon', '$uang_pangkal', '$spp', '$latitude', '$longitude', '$jenis_paud')";
$result = @mysql_query($sql);

        // Uang Pangkal
        switch ($uang_pangkal) {
            case $uang_pangkal < '1000000' : $up=8 * 0.2;
            break;
            case ($uang_pangkal >= '1000000'&&$uang_pangkal<='2000000') : $up=6 * 0.2;
            break;
            case $uang_pangkal >'2000000' : $up=3 * 0.2;
            break;
        }
        // End of Uang Pangkal
        
        // Uang SPP
        switch ($spp) {
            case $spp <"100000" : $us=8 * 0.2;
            break;
            case ($spp>="100000"&&$spp<"200000") : $us=6 * 0.2;
            break;
            case $spp >="200000" : $us=3 * 0.2;
            break;
        }
        // End of Uang SPP

	$sqlnilai="insert into bobot_penilaian (id_paud, nilai_jarak, nilai_spp, nilai_uang_pangkal, nilai_fas, nilai_gur, nilai_total) 
	values ('$id_paud', '', '$us', '$up', '', '', '')";
	$rsnilai=mysql_query($sqlnilai);

if ($result){
	echo "<script>
	alert('Input PAUD Berhasil');
	location.href='../../home.php?module=module/paud/index.php';</script>";
} else {
	echo "<script><script>alert('Input PAUD Gagal');
	location.href='../../home.php?module=module/paud/index.php';</script>";
}

} else {
    echo "<script>alert('Input PAUD Gagal, Sudah ada data yang sama sebelumnya');
	location.href='../../home.php?module=module/paud/index.php';</script>";
}
?>