<?php
include ("../../inc/conn.php");
//include 'library/opendb.php';

$nama		= $_REQUEST['nama'];
$nomor_hp	= $_REQUEST['nomor_hp'];
$jml_data	= $_REQUEST['jml_data'];

$ambil="select Id_dbs, nama, nomor_hp, email from nasabah where true";
if($nama!="") {
	$ambil.=" and nama like '%$nama%' or Id_dbs like '%$nama%'";	
}
if($nomor_hp!="") {
	$ambil.=" and nomor_hp='$nomor_hp%'";	
}
$ambil.=" order by nama asc";
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
header("Content-Disposition: attachment; filename=List_member_dbs.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>
