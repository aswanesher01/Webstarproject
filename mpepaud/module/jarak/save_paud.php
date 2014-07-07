<?php

$id_paud        = rand(0000, 9999);
$nama_paud      = $_REQUEST['nama_paud'];
$alamat_paud    = $_REQUEST['alamat_paud'];
$telepon        = $_REQUEST['telepon_paud'];
$uang_pangkal   = $_REQUEST['uang_pangkal'];
$spp            = $_REQUEST['spp'];
$latitude       = $_REQUEST['latitude'];
$longitude      = $_REQUEST['longitude']; 
$jenis_paud     = $_REQUEST['jenis_paud'];

include '../../inc/conn.php';

/* CEK PAUD */
$sqlcek=mysql_query("select id_paud from data_paud where id_paud='$id_paud'");
$hasilcek=mysql_num_rows($sqlcek);

if($hasilcek=="0"||$hasilcek=="") {

$sql="insert into data_paud (id_paud, nama_paud, Alamat_Paud, Telepon, Uang_Pangkal, Spp, Latitude, longitude, jenis_sekolah) 
values ('$id_paud', '$nama_paud', '$alamat_paud', '$telepon', '$uang_pangkal', '$spp', '$latitude', '$longitude', '$jenis_paud')";
$result = @mysql_query($sql);

        // Uang Pangkal
        switch ($uang_pangkal) {
            case $uang_pangkal < '1000000' : $up=8 * 0.3;
            break;
            case ($uang_pangkal >= '1000000'&&$uang_pangkal<='2000000') : $up=6 * 0.3;
            break;
            case $uang_pangkal >'2000000' : $up=4 * 0.3;
            break;
        }
        // End of Uang Pangkal
        
        // Uang SPP
        switch ($spp) {
            case $spp <"100000" : $us=8 * 0.3;
            break;
            case ($spp>="100000"&&$spp<"200000") : $us=6 * 0.3;
            break;
            case $spp >="200000" : $us=4 * 0.3;
            break;
        }
        // End of Uang SPP

$sqlnilai="insert into t_nilai_paud (id_paud, nilai_jarak, nilai_spp, nilai_uang_pangkal, nilai_fas, nilai_gur, nilai_total) 
values ('$id_paud', '', '$us', '$up', '', '', '')";
$rsnilai=mysql_query($sqlnilai);

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}

} else {
    echo json_encode(array('msg'=>'ID Paud Sudah Terdaftar.'));
}
?>