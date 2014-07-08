<?php

$id_paud = intval($_REQUEST['id_paud']);
$id_guru = intval($_REQUEST['id']);
$nama = $_REQUEST['Nama_Guru'];
$pendidikan = $_REQUEST['Pendidikan'];

include '../../inc/conn.php';

$cekn=mysql_query("select nilai_jarak from bobot_penilaian where id_paud='$id_paud'");
$datan=mysql_fetch_array($cekn);

$sql = "update pend_guru set Nama_Guru='$nama', Pendidikan='$pendidikan' where Id_guru='$id_guru' and id_paud='$id_paud'";
//echo $sql;
$result = @mysql_query($sql);

        // query S1
        $querys1 = mysql_query('SELECT * FROM pend_guru where Pendidikan="S1" and id_paud="'.$id_paud.'"');
        $jmls1=mysql_num_rows($querys1);
        
        // query D3
        $queryd3 = mysql_query('SELECT * FROM pend_guru where Pendidikan="D3" and id_paud="'.$id_paud.'"');
        $jmld3=mysql_num_rows($queryd3);
        
        // query SMA
        $querysma = mysql_query('SELECT * FROM pend_guru where Pendidikan="SMA" and id_paud="'.$id_paud.'"');
        $jmlsma=mysql_num_rows($querysma);
        
        //$jmln=array();
        
        if(($jmlsma=="0"||$jmlsma==NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0";
        } else if(($jmlsma!="0"||$jmlsma==NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0.6";
        } else if (($jmlsma!="0"||$jmlsma!=NULL)&&($jmld3!="0"||$jmld3!=NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0.7";
        } else if(($jmlsma!="0"||$jmlsma!=NULL)&&($jmld3!="0"||$jmld3!=NULL)&&($jmls1!="0"||$jmls1!=NULL)) {
            $jmls="0.8";
        } else if(($jmlsma!="0"||$jmlsma!=NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1!="0"||$jmls1!=NULL)) {
            $jmls="0.8";
        } else if(($jmlsma=="0"||$jmlsma==NULL)&&($jmld3!="0"||$jmld3!=NULL)&&($jmls1=="0"||$jmls1==NULL)) {
            $jmls="0.7";
        } else if(($jmlsma=="0"||$jmlsma==NULL)&&($jmld3=="0"||$jmld3==NULL)&&($jmls1!="0"||$jmls1!=NULL)) {
            $jmls="0.8";
        }
        
        $sqlceknilai=mysql_query("select * from bobot_penilaian where id_paud='$id_paud'");
        $rsceknilai=mysql_fetch_array($sqlceknilai);
        
        $totalnilai=$jmls+$rsceknilai['nilai_jarak']+$rsceknilai['nilai_uang_pangkal']+$rsceknilai['nilai_spp']+$rsceknilai['nilai_fas'];
        
		if($datan['nilai_jarak']=="") {
			$sql=mysql_query("UPDATE bobot_penilaian SET nilai_gur='$jmls' WHERE id_paud=$id_paud");
		} else {
        	$sql=mysql_query("UPDATE bobot_penilaian SET nilai_gur='$jmls', nilai_total='$totalnilai' WHERE id_paud=$id_paud");
		}
		
        $sqlup="UPDATE data_paud set jml_sma='$jmlsma' where id_paud='$id_paud'";
		//echo $sqlup;
        $rsup=mysql_query($sqlup);
        
        $sqlup2="UPDATE data_paud set jml_d3='$jmld3' where id_paud='$id_paud'";
        $rsup2=mysql_query($sqlup2);
        
        $sqlup3="UPDATE data_paud set jml_s1='$jmls1' where id_paud='$id_paud'";
        $rsup3=mysql_query($sqlup3);

if ($result){
	echo "<script>
	alert('Ubah Guru sukses');
	location.href='../../home.php?module=module/pegawai/index.php';</script>";
} else {
	echo "<script>
	alert('Ubah Guru Gagal');
	location.href='../../home.php?module=module/pegawai/index.php';</script>";
}
?>