<?php

$id = intval($_REQUEST['id']);
$nama_paud      = $_REQUEST['nama_paud'];
$alamat_paud    = $_REQUEST['Alamat_Paud'];
$telepon        = $_REQUEST['Telepon'];
$uang_pangkal   = $_REQUEST['Uang_Pangkal'];
$spp            = $_REQUEST['Spp'];
$latitude       = $_REQUEST['Latitude'];
$longitude      = $_REQUEST['longitude']; 
$jenis_paud     = $_REQUEST['jenis_sekolah'];

include '../../inc/conn.php';

$sql = "update data_paud set nama_paud='$nama_paud',Alamat_Paud='$alamat_paud',Telepon='$telepon',Uang_Pangkal='$uang_pangkal', Spp='$spp', Latitude='$latitude', longitude='$longitude', jenis_sekolah='$jenis_paud' where id_paud=$id";
$result = @mysql_query($sql);

$sqlceknilai=mysql_query("select * from t_nilai_paud where id_paud='$id'");
$rsceknilai=mysql_fetch_array($sqlceknilai);


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
        
        
        if($rsceknilai['nilai_total']=="") {
            $totalnilai=$up+$us;
        } else {
            $nilai_total=$rsceknilai['nilai_total'];
            $totalnilai=$up+$us+$rsceknilai['nilai_jarak']+$rsceknilai['nilai_gur']+$rsceknilai['nilai_fas'];
        }

$sqlnilai="update t_nilai_paud set nilai_spp='$us', nilai_uang_pangkal='$up', nilai_total='$totalnilai' where id_paud='$id'";
$rsnilai=mysql_query($sqlnilai);

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>