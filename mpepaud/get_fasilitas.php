<?php

require("inc/conn.php");

$nama       = $_REQUEST['nama'];

//echo $rute;

$sqln="select fasilitas.*, data_paud.nama_paud from fasilitas, data_paud where data_paud.id_paud=fasilitas.id_paud and nama_paud like '$nama%'";
$rsn=mysql_query($sqln);

?>
<?
while($row=mysql_fetch_array($rsn)) { ?>
    <?=$row['Nama_fas']?>,&nbsp;
<?
}
?>