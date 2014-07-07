<?php

$fasilitas      = $_REQUEST['nama_fasilitas'];
$paud           = $_REQUEST['paud'];
$id_fas         = rand(0000,9999);

include '../../inc/conn.php';

$cekn=mysql_query("select nilai_jarak from bobot_penilaian where id_paud='$paud'");
$datan=mysql_fetch_array($cekn);

$cek=mysql_query("select * from fasilitas where Nama_fas='$fasilitas' and id_paud='$paud'");
$rscek=mysql_num_rows($cek);
if($rscek>0) {
	echo "<script>
	alert('Input Fasilitas Gagal, sudah ada data yang sama');
	location.href='../../home.php?module=module/fasilitas/index.php';</script>";
} else {

$sql = "insert into fasilitas(Id_Fas, Nama_fas, id_paud) values ('$id_fas', '$fasilitas','$paud')";
//echo $sql;
$result = @mysql_query($sql);

        $query = mysql_query('SELECT * FROM fasilitas where id_paud="'.$paud.'"');
        $jmls=mysql_num_rows($query);
        $jml=$jmls;
        
        // Uang Pangkal
        switch ($jml) {
            case ($jml>='10'&&$jml<='15') : $n=7 * 0.1;
            break;
            case ($jml>='4'&&$jml<'10') : $n=5 * 0.1;
            break;
            case ($jml<='3'): $n=4 * 0.1;
            break;
        }
        // End of Uang Pangkal
        
        // Get Data Nilai Paud
        $sqlc=mysql_query("select * from bobot_penilaian where id_paud='$paud'");
        $row=mysql_fetch_array($sqlc);
        $num=mysql_num_rows($sqlc);
        
        if($num=="0"||$num=="") {
            $nilai=$n;
        } else {
            $nilai=$n+$row['nilai_jarak']+$row['nilai_uang_pangkal']+$row['nilai_spp']+$row['nilai_gur'];
        }
        
		if($datan['nilai_jarak']=="") {
			// Update bobot_penilaian table
        	$sqls="UPDATE bobot_penilaian SET nilai_fas='$n' WHERE id_paud=$paud";
        	$rss=mysql_query($sqls);	
		} else {
        	// Update bobot_penilaian table
        	$sqls="UPDATE bobot_penilaian SET nilai_fas='$n', nilai_total='$nilai' WHERE id_paud=$paud";
        	$rss=mysql_query($sqls);
		}
		
        $sqlup="UPDATE data_paud set jml_fas='$jmls' where id_paud='$paud'";
        $rsup=mysql_query($sqlup);

if ($result){
	echo "<script>
	alert('Input Fasilitas Berhasil');
	location.href='../../home.php?module=module/fasilitas/index.php';</script>";
} else {
	echo "<script>
	alert('Input Fasilitas Gagal');
	location.href='../../home.php?module=module/fasilitas/index.php';</script>";
}
}
?>