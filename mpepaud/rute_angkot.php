<?php

require("inc/conn.php");

$rute       = $_REQUEST['rute'];

//echo $rute;

$r  = explode($rute, ',');
$daerah = $r[1];

$sqln="select * from angkot where asal like '$daerah%' or Tiba like '$daerah%' or Rute like '%$daerah%'";
$rsn=mysql_query($sqln);

?>
<br>
<div class="table-responsive">
<table border="1" cellpadding="5" class="table table-hover" style="background-color: #fff; border: 1px solid #ccc; width:700px !important;">
    <thead class="panel-heading"><tr><td width="150px" align="center"><b>Jurusan</b></td><td align="center"><b>Rute</b></td></tr></thead>
<?
while($row=mysql_fetch_array($rsn)) { ?>
    <tr><td><?=$row['asal']." - ".$row['Tiba']?></td><td><?=$row['Rute']?></td></tr>
<?
}
?>
</table>
</div>