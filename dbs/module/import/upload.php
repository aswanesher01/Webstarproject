<?php

include "inc/conn.php";
include "excel_reader2.php";

$querys=mysql_query("truncate table data_paud");
	$querys=mysql_query("truncate table bobot_penilaian");	
	$querys=mysql_query("truncate table pend_guru");
	$querys=mysql_query("truncate table fasilitas");
 
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

//// IMPORT DARI SHEET 1 ////////////

$baris = $data->rowcount($sheet_index=0);

$sukses = 0;
$gagal = 0;

for ($i=2; $i<=$baris; $i++) //akan membaca data excel mulai dari baris dua. karena baris satu di excel untuk judul field
{

	$id_paud = rand(000000, 999999);
	$nama_sekolah = $data->val($i, 2, 0); 
	$alamat = $data->val($i, 3, 0);
	$telepon = $data->val($i, 4, 0); 
	$uang_pangkal = $data->val($i, 5, 0); 
	$spp = $data->val($i, 6, 0);
	$lat = $data->val($i, 7, 0);
	$long = $data->val($i, 8, 0);
	$jenis_sekolah = $data->val($i, 9, 0);
	
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
	
	if(!empty($nama_sekolah)){ //cek salah satu inputan
	
	/* CEK PAUD */
	$rscekd="select * from data_paud where nama_paud like '$nama_sekolah%' and jenis_sekolah='$jenis_sekolah'";
	//echo $rscekd;
	$sqlcek=mysql_query($rscekd);
	$hasilcek=mysql_num_rows($sqlcek);
	
	//echo $hasilcek;

	if($hasilcek<1) {
	$query=mysql_query("insert into data_paud (id_paud, nama_paud, Alamat_Paud, Telepon, Uang_Pangkal, Spp, Latitude, longitude, jenis_sekolah) 
values ('$id_paud', '$nama_sekolah', '$alamat', '$telepon', '$uang_pangkal', '$spp', '$lat', '$long', '$jenis_sekolah')") or die(mysql_error());
	
	$sqlnilai="insert into bobot_penilaian (id_paud, nilai_jarak, nilai_spp, nilai_uang_pangkal, nilai_fas, nilai_gur, nilai_total) 
	values ('$id_paud', '', '$us', '$up', '', '', '')";
	$rsnilai=mysql_query($sqlnilai);
	if ($query) $sukses++;
	else $gagal++;
	} else {
		$stat="Sudah ada data yang sama, Sebagian data gagal dimasukan";	
	}
  }
}
echo $stat;

////// IMPORT DARI SHEET 2 ///////////////////

$baris = $data->rowcount($sheet_index=1);

$sukses = 0;
$gagal = 0;

for ($i=2; $i<=$baris; $i++) //akan membaca data excel mulai dari baris dua. karena baris satu di excel untuk judul field
{

	$id_guru = rand(000000, 999999);
	$nama_sekolah = $data->val($i, 2, 1); 
	
	$sql="select id_paud from data_paud where nama_paud like '$nama_sekolah%'";
	$cek=mysql_query($sql);
	$pauds=mysql_fetch_array($cek);
	$paud=$pauds['id_paud'];
	
	$nama_guru = $data->val($i, 3, 1);
	$pendidikan = $data->val($i, 4, 1); 
	
	if(!empty($nama_sekolah)){ //cek salah satu inputan
	
	$rsss="select * from pend_guru where Nama_Guru='$nama_guru' and id_paud='$paud'";
	//echo $rsss;
	$cek=mysql_query($rsss);
	$rscek=mysql_num_rows($cek);
	if($rscek>0) {
		echo "";
	} else {
	
	$query=mysql_query("insert into pend_guru (Id_guru, Nama_Guru, Pendidikan, id_paud) values ('$id_guru', '$nama_guru', '$pendidikan', '".$paud."')") or die(mysql_error());
	
	// query S1
        $querys1 = mysql_query('SELECT * FROM pend_guru where Pendidikan="S1" and id_paud="'.$paud.'"');
        $jmls1=mysql_num_rows($querys1);
        
        // query D3
        $queryd3 = mysql_query('SELECT * FROM pend_guru where Pendidikan="D3" and id_paud="'.$paud.'"');
        $jmld3=mysql_num_rows($queryd3);
        
        // query SMA
        $querysma = mysql_query('SELECT * FROM pend_guru where Pendidikan="SMA" and id_paud="'.$paud.'"');
        $jmlsma=mysql_num_rows($querysma);
        
        //$jmln=array();
        
        if(($jmlsma=="0"||$jmlsma==NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0";
        } else if(($jmlsma!="0"||$jmlsma==NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0.5";
        } else if (($jmlsma!="0"||$jmlsma!=NULL)&&($jmld3!="0"||$jmld3!=NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0.6";
        } else if(($jmlsma!="0"||$jmlsma!=NULL)&&($jmld3!="0"||$jmld3!=NULL)&&($jmls1!="0"||$jmls1!=NULL)) {
            $jmls="0.8";
        } else if(($jmlsma=="0"||$jmlsma==NULL)&&($jmld3!="0"||$jmld3!=NULL)&&($jmls1!="0"||$jmls1!=NULL)) {
            $jmls="0.8";
        }
        else if(($jmlsma!="0"||$jmlsma!=NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1!="0"||$jmls1!=NULL)) {
            $jmls="0.8";
        } else if(($jmlsma=="0"||$jmlsma==NULL)&&($jmld3!="0"||$jmld3!=NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0.6";
        } else if(($jmlsma=="0"||$jmlsma==NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1!="0"||$jmls1!=NULL)) {
            $jmls="0.8";
        }
        
        $sqlceknilai=mysql_query("select * from bobot_penilaian where id_paud='".$paud."'");
        $rsceknilai=mysql_fetch_array($sqlceknilai);
        
        $totalnilai=$jmls+$rsceknilai['nilai_jarak']+$rsceknilai['nilai_uang_pangkal']+$rsceknilai['nilai_spp']+$rsceknilai['nilai_fas'];
        
		if($datan['nilai_jarak']=="") {
			$sql=mysql_query("UPDATE bobot_penilaian SET nilai_gur='$jmls'  WHERE id_paud=$paud");
		} else {
        	$sql=mysql_query("UPDATE bobot_penilaian SET nilai_gur='$jmls', nilai_total='$totalnilai' WHERE id_paud='".$paud."'");
		}
		
        $sqlup="UPDATE data_paud set jml_sma='$jmlsma' where id_paud='".$paud."'";
        $rsup=mysql_query($sqlup);
        
        $sqlup2="UPDATE data_paud set jml_d3='$jmld3' where id_paud='".$paud."'";
        $rsup2=mysql_query($sqlup2);
        
        $sqlup3="UPDATE data_paud set jml_s1='$jmls1' where id_paud='".$paud."'";
        $rsup3=mysql_query($sqlup3);
	
	if ($query) $sukses++;
	else $gagal++;
	}
  }
}


////// IMPORT DARI SHEET 3 ///////////////////

$baris = $data->rowcount($sheet_index=2);

$sukses = 0;
$gagal = 0;

for ($i=2; $i<=$baris; $i++) //akan membaca data excel mulai dari baris dua. karena baris satu di excel untuk judul field
{

	$id_fas = rand(000000, 999999);
	$nama_sekolah = $data->val($i, 2, 2); 
	
	$sql="select id_paud from data_paud where nama_paud like '$nama_sekolah%'";
	$cek=mysql_query($sql);
	$pauds=mysql_fetch_array($cek);
	$paud=$pauds['id_paud'];
	
	$fasilitas = $data->val($i, 3, 2);
	
	if(!empty($nama_sekolah)){ //cek salah satu inputan
	
	$cek=mysql_query("select * from fasilitas where Nama_fas='$fasilitas' and id_paud='$paud'");
	$rscek=mysql_num_rows($cek);
	if($rscek>0) {
		echo "";
	} else {
	
	$query=mysql_query("insert into fasilitas(Id_Fas, Nama_fas, id_paud) values ('$id_fas', '$fasilitas','$paud')") or die(mysql_error());
	
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
	
	if ($query) $sukses++;
	else $gagal++;
	}
  }
}

echo "<h3>Proses import data selesai. <a href='?module=module/paud/rekapall.php'>Refresh</a></h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
?>
 