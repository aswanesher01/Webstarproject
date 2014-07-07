<?php
include "inc/conn.php";

$query=mysql_query("select * from data_paud");

?>
<p>&nbsp;</p>
<div class="table-responsive">
<table width="373" class="table table-hover">
<thead class="panel-heading">
<tr>
					<th>No</th>
                  <th>Id Paud</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>DSP</th>
                  <th>SPP</th>
                  <th>Jenis</th>
</tr>
</thead>
<?php
while($row=mysql_fetch_array($query)){
	?>
	<tr>
    	<td><?php echo $c=$c+1;?></td>
        <td><?=$row['id_paud'];?></td>
                  <td><?=$row['nama_paud'];?></td>
                  <td><?=$row['Alamat_Paud'];?></td>
                  <td><?=$row['Telepon'];?></td>
                  <td><?=$row['Uang_Pangkal'];?></td>
                  <td><?=$row['Spp'];?></td>
                  <td><?=$row['jenis_sekolah'];?></td>
    </tr>
	<?php
}
?>
</table>
</div>