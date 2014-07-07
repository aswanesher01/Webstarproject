<?php

$id = intval($_REQUEST['id']);
$paud = intval($_REQUEST['id_paud']);

include 'inc/conn.php';

$sql = "delete from pend_guru where Id_guru=$id";
$result = @mysql_query($sql);

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
        
        $sqlceknilai=mysql_query("select * from bobot_penilaian where id_paud='$paud'");
        $rsceknilai=mysql_fetch_array($sqlceknilai);
        
        $totalnilai=$rsceknilai['nilai_fas']+$rsceknilai['nilai_jarak']+$rsceknilai['nilai_uang_pangkal']+$rsceknilai['nilai_spp']+$jmls;
        
        $sql=mysql_query("UPDATE bobot_penilaian SET nilai_gur='$jmls', nilai_total='$totalnilai' WHERE id_paud=$paud");
        
        $sqlup="UPDATE data_paud set jml_sma='$jmlsma' where id_paud='$paud'";
        $rsup=mysql_query($sqlup);
        
        $sqlup2="UPDATE data_paud set jml_d3='$jmld3' where id_paud='$paud'";
        $rsup2=mysql_query($sqlup2);
        
        $sqlup3="UPDATE data_paud set jml_s1='$jmls1' where id_paud='$paud'";
        $rsup3=mysql_query($sqlup3);

if ($result){
	echo "<script>
	alert('Hapus Guru Berhasil');
	location.href='home.php?module=module/pegawai/index.php';</script>";
} else {
	echo "<script>
	alert('Hapus PAUD Gagal');
	location.href='home.php?module=module/pegawai/index.php';</script>";
}
?>