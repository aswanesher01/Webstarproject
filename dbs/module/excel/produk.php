<?php
include ("../../inc/conn.php");
//include 'library/opendb.php';

$nama_pemilik	= $_REQUEST['nama_pemilik'];
$thn_rakit		= $_REQUEST['thn_rakit'];
$tgl_daftar		= $_REQUEST['tgl_daftar'];
$tgl_aktif		= $_REQUEST['tgl_aktif'];
$jml_data		= $_REQUEST['jml_data'];

$ambil="select * from produk where true";
if($nama_pemilik!="") {
	$ambil.=" and nama_pemilik like '%$paud%'";	
}
if($thn_rakit!="") {
	$ambil.=" and tahun_rakit='$thn_rakit'";	
}
if($tgl_daftar!="") {
	$ambil.=" and tgl_daftar='$tgl_daftar'";	
}
if($tgl_aktif!="") {
	$ambil.=" and tgl_aktif='$tgl_aktif'";	
}
$ambil.=" order by tahun_rakit asc";
if($jml_data!="") {
	$ambil.=" limit $jml_data";
}
//echo $ambil;
//$rs=mysql_query($ambil);
//die($select);
$export = mysql_query($ambil);
$fields = mysql_num_fields($export);
for ($i = 0; $i < $fields; $i++) {
$header .= mysql_field_name($export, $i) . "\t";
}
while($row = mysql_fetch_row($export)) {
$line = '';
foreach($row as $value) {
if ((!isset($value)) OR ($value == "")) {
$value = "\t";
} else {
$value = str_replace('"', '""', $value);
$value = '"' . $value . '"' . "\t";
}
$line .= $value;
}
$data .= trim($line)."\n";
}
$data = str_replace("\r","",$data);
if ($data == "") {
$data = "Data kosong\n";
}
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=List_Produk.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>
