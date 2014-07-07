<?php

$id = intval($_REQUEST['id']);
$paud = $_REQUEST['id_paud'];

include 'inc/conn.php';

$cekn=mysql_query("select nilai_jarak from bobot_penilaian where id_paud='$paud'");
$datan=mysql_fetch_array($cekn);

$sql = "delete from fasilitas where Id_Fas=$id";
$result = @mysql_query($sql);

        $r='SELECT * FROM fasilitas where id_paud="'.$paud.'"';
        $query = mysql_query($r);
        $jmls=mysql_num_rows($query);
        $jml=$jmls;
        
        if(($jml>10)&&($jml<=15)) {
            $n=7*0.1;
        } else if(($jml>=4)&&($jml<=10)) {
            $n=5*0.1;
        } else if(($jml>0)&&($jml<=3)) {
            $n=4*0.1;
        } else {
            $n="";
        }
        
        // End of Uang Pangkal
        
        // Get Data Nilai Paud
        $sqlc=mysql_query("select * from bobot_penilaian where id_paud='$paud'");
        $row=mysql_fetch_array($sqlc);
        $num=mysql_num_rows($sqlc);
        

        $nilai=$n+$row['nilai_jarak']+$row['nilai_uang_pangkal']+$row['nilai_spp']+$row['nilai_gur'];
               
        // Update bobot_penilaian table
		if($datan['nilai_jarak']=="") {
			$sqls="UPDATE bobot_penilaian SET nilai_fas='$n' WHERE id_paud=$paud";
        	//echo $sqls;
        	$rss=mysql_query($sqls);
		} else {
        	$sqls="UPDATE bobot_penilaian SET nilai_fas='$n', nilai_total='$nilai' WHERE id_paud=$paud";
        	//echo $sqls;
        	$rss=mysql_query($sqls);
		}
		
        $sqlup="UPDATE data_paud set jml_fas='$jmls' where id_paud='$paud'";
        $rsup=mysql_query($sqlup);

if ($result){
	echo "<script>
	alert('Hapus Fasilitas Berhasil');
	location.href='home.php?module=module/fasilitas/index.php';</script>";
} else {
	echo "<script>
	alert('Hapus Fasilitas Gagal');
	location.href='home.php?module=module/fasilitas/index.php';</script>";
}
?>