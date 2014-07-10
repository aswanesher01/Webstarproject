<?php
require("inc/conn.php"); 
// Get parameters from URL
$center_lat     = $_GET["lat"];
$center_lng     = $_GET["lng"];
$radius         = $_GET["radius"];
$uang_pangkal   = $_GET['uang_pangkal'];
$uang_spp       = $_GET['uang_spp'];
$jmlfasilitas   = $_GET['jmlfasilitas'];
$pendidikanguru = $_GET['pendidikanguru'];
$jenis_sekolah  = $_GET['jenis_sekolah'];

$cb1			= $_GET['cb1'];
$cb2			= $_GET['cb2'];
$cb3			= $_GET['cb3'];
$cb4			= $_GET['cb4'];
$cb5			= $_GET['cb5'];
$cb6			= $_GET['cb6'];
$cb7			= $_GET['cb7'];
$cb8			= $_GET['cb8'];
$cb9			= $_GET['cb9'];
$cb10			= $_GET['cb10'];
$cb11			= $_GET['cb11'];
$cb12			= $_GET['cb12'];
$cb13			= $_GET['cb13'];
$cb14			= $_GET['cb14'];
$cb15			= $_GET['cb15'];
$cb16			= $_GET['cb16'];
$cb17			= $_GET['cb17'];
$cb18			= $_GET['cb18'];
$cb19			= $_GET['cb19'];
$cb20			= $_GET['cb20'];
$cb21			= $_GET['cb21'];


// translating uang pangkal //

if($uang_pangkal==1) {
    $up1="500000";
    $up2="1000000";
} else if($uang_pangkal==2) {
    $up1="1000000";
    $up2="2000000";
} else if($uang_pangkal==3) {
    $up1="2000000";
    $up2="10000000";
} else if($uang_pangkal==0) {
    $up1="0";
    $up2="10000000";
}

// translating uang SPP //

if($uang_spp==1) {
    $sp1="50000";
    $sp2="100000";
} else if($uang_spp==2) {
    $sp1="100000";
    $sp2="200000";
} else if($uang_spp==3) {
    $sp1="200000";
    $sp2="1000000";
} else if($uang_spp==0) {
    $sp1="0";
    $sp2="1000000";
}

// translating Fasilitas //

if($jmlfasilitas==1) {
    $jf1="10";
    $jf2="15";
} else if($jmlfasilitas==2) {
    $jf1="4";
    $jf2="10";
} else if($jmlfasilitas==3) {
    $jf1="0";
    $jf2="3";
} else if($jmlfasilitas==0) {
    $jf1="0";
    $jf2="20";
}

// translating Jml Guru //

if($pendidikanguru==1) {
    $qss="and (jml_sma>0 and jml_d3<1 and jml_s1<1)";
} else if($pendidikanguru==2) {
    $qss="and (jml_sma>0 and jml_d3>0 and jml_s1<1)";
} else if($pendidikanguru==3) {
    $qss="and (jml_d3>0 and jml_s1>0 and jml_sma<1)";
} else if($pendidikanguru==4) {
    $qss="and (jml_sma>0 and jml_d3>0 and jml_s1>0)";
} else if($pendidikanguru==5) {
    $qss="and (jml_sma>0 and jml_s1>0 and jml_d3<1)";
} else if($pendidikanguru==0) {
    $qss="";
}

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$sqlfas="select fasilitas.*, data_paud.* from fasilitas, data_paud where fasilitas.id_paud=data_paud.id_paud";
$sqlfas.=" and (Nama_fas='$cb1' or Nama_fas='$cb2' or Nama_fas='$cb3' or Nama_fas='$cb4' or Nama_fas='$cb5' or Nama_fas='$cb6' or Nama_fas='$cb7' or Nama_fas='$cb8' or Nama_fas='$cb9' or Nama_fas='$cb10' or Nama_fas='$cb11' or Nama_fas='$cb12' or Nama_fas='$cb13' or Nama_fas='$cb14' or Nama_fas='$cb15' or Nama_fas='$cb16' or Nama_fas='$cb17' or Nama_fas='$cb18' or Nama_fas='$cb19' or Nama_fas='$cb20' or Nama_fas='$cb21')";
$rsfas=mysql_query($sqlfas);
while($rowfas=mysql_fetch_array($rsfas)) {

//echo $sqlfas;

// Search the rows in the markers table
$sqln="SELECT data_paud.id_paud, data_paud.id_paud, data_paud.Uang_Pangkal, data_paud.Spp, data_paud.nama_paud, data_paud.Alamat_Paud, data_paud.Telepon, data_paud.Uang_Pangkal, data_paud.Spp, data_paud.Latitude, data_paud.longitude, data_paud.jml_fas, data_paud.jml_sma, data_paud.jml_d3, data_paud.jml_s1,  bobot_penilaian.nilai_total, bobot_penilaian.nilai_jarak, bobot_penilaian.nilai_spp, bobot_penilaian.nilai_uang_pangkal, bobot_penilaian.nilai_fas, bobot_penilaian.nilai_gur,  ( 3959 * acos( cos( radians('%s') ) * cos( radians( data_paud.Latitude ) ) * cos( radians( data_paud.longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( data_paud.Latitude ) ) ) ) AS distance FROM data_paud, bobot_penilaian where data_paud.id_paud=bobot_penilaian.id_paud and data_paud.id_paud='".$rowfas['id_paud']."'";
if($jenis_sekolah!="") {
	$sqln.=" and jenis_sekolah='$jenis_sekolah'";	
}
if($uang_pangkal!="") {
	$sqln.=" and (Uang_Pangkal>='$up1' and Uang_Pangkal<='$up2')";	
}
if($uang_spp!="") {
	$sqln.=" and (Spp>='$sp1' and Spp<='$sp2')";	
}
if($jmlfasilitas!="") {
	$sqln.=" and (jml_fas>='$jf1' and jml_fas<='$jf2')";	
}
$sqln.=" $qss HAVING distance < '%s' ORDER BY bobot_penilaian.nilai_total DESC LIMIT 0, 20";
$query = sprintf($sqln, mysql_real_escape_string($center_lat),mysql_real_escape_string($center_lng),mysql_real_escape_string($center_lat),mysql_real_escape_string($radius));
$result = mysql_query($query);

//echo $sqln;

if (!$result) {
    die("Invalid query: " . mysql_error());
}

//header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){

        $jarak=$row['distance'];
        $id_paud=$row['id_paud'];

        ///// Hitung Jarak /////
        switch ($jarak) {
            case ($jarak<='2') : $n=8 * 0.5;
            break;
            case (($jarak>'2')&&($jarak<='5')) : $n=5 * 0.5;
            break;
            case ($jarak>'5'): $n=3 * 0.5;
            break;
        }

        $queryss="select * from bobot_penilaian where id_paud='$id_paud'";
        $rss=mysql_query($queryss);
        $dat_nil=mysql_fetch_array($rss);

        $nilai_total=$dat_nil['nilai_jarak']+$dat_nil['nilai_spp']+$dat_nil['nilai_uang_pangkal']+$dat_nil['nilai_fas']+$dat_nil['nilai_gur'];

        $querys="update bobot_penilaian set nilai_jarak='$n', nilai_total='$nilai_total' where id_paud='$id_paud'";
        $rs=mysql_query($querys);
        ///// End Hitung Jarak /////

        ///// Hitung Jumlah Fasilitas /////
        $querysf="select * from fasilitas where id_paud='$id_paud'";
        $rsf=mysql_query($querysf);
        $rowf=mysql_num_rows($rsf);

		$rsq=mysql_query("update data_paud set jarak='".$row['distance']."' where id_paud='$id_paud'");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

//header("Content-type: text/xml");

// Search the rows in the markers table
$sqls="SELECT data_paud.*,  bobot_penilaian.*,  ( 3959 * acos( cos( radians('%s') ) * cos( radians( data_paud.Latitude ) ) * cos( radians( data_paud.longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( data_paud.Latitude ) ) ) ) AS distance FROM data_paud left join bobot_penilaian on data_paud.id_paud=bobot_penilaian.id_paud";
if($jenis_sekolah!="") {
	$sqls.=" and jenis_sekolah='$jenis_sekolah'";	
}
if($uang_pangkal!="") {
	$sqls.=" and (Uang_Pangkal>='$up1' and Uang_Pangkal<='$up2')";	
}
if($uang_spp!="") {
	$sqls.=" and (Spp>='$sp1' and Spp<='$sp2')";	
}
if($jmlfasilitas!="") {
	$sqls.=" and (jml_fas>='$jf1' and jml_fas<='$jf2')";	
}
$sqls.=" $qss HAVING distance < '%s' ORDER BY nilai_total DESC, distance ASC LIMIT 3";
$querys = sprintf($sqls, mysql_real_escape_string($center_lat),mysql_real_escape_string($center_lng),mysql_real_escape_string($center_lat),mysql_real_escape_string($radius));
//echo $querys;
$results = mysql_query($querys);

if (!$results) {
    die("Invalid query: " . mysql_error());
}

while ($rows = @mysql_fetch_assoc($results)){
	
if($rows['nilai_total']=='') {
	echo "";	
} else {

$node = $dom->createElement("marker");
$newnode = $parnode->appendChild($node);
$newnode->setAttribute("name", $rows['nama_paud']);
$newnode->setAttribute("address", $rows['Alamat_Paud']);
$newnode->setAttribute("nilai", $rows['nilai_total']);
$newnode->setAttribute("nilai_jarak", $rows['nilai_jarak']);
$newnode->setAttribute("nilai_fas", $rows['nilai_fas']);
$newnode->setAttribute("nilai_uang_spp", $rows['nilai_spp']);
$newnode->setAttribute("nilai_uang_pangkal", $rows['nilai_uang_pangkal']);
$newnode->setAttribute("nilai_gur", $rows['nilai_gur']);
$newnode->setAttribute("fas", $rows['jml_fas']);
$newnode->setAttribute("sma", $rows['jml_sma']);
$newnode->setAttribute("d3", $rows['jml_d3']);
$newnode->setAttribute("s1", $rows['jml_s1']);
$newnode->setAttribute("uang_pangkal", "Rp.".number_format($rows['Uang_Pangkal']));
$newnode->setAttribute("spp", "Rp.".number_format($rows['Spp']));
$newnode->setAttribute("telephone", $rows['Telepon']);
$newnode->setAttribute("lat", $rows['Latitude']);
$newnode->setAttribute("lng", $rows['longitude']);
$newnode->setAttribute("distance", $rows['distance']);
}
}
echo $dom->saveXML();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
}


?>