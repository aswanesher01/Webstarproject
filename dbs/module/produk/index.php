<? 
include "inc/conn.php";

$nama_pemilik	= $_REQUEST['nama_pemilik'];
$thn_rakit		= $_REQUEST['thn_rakit'];
$tgl_daftar		= $_REQUEST['tgl_daftar'];
$tgl_aktif		= $_REQUEST['tgl_aktif'];
$jml_data		= $_REQUEST['jml_data'];

$ambil="select * from produk where true";
if($nama_pemilik!="") {
	$ambil.=" and nama_pemilik like '$paud%'";	
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

$rs=mysql_query($ambil);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
<title>.: DBS Application :.</title>
<script>
$(document).ready(function() {
	$('#dp1').datepicker({
		format: 'yyyy-mm-dd'	
	});	
});
$(document).ready(function() {
	$('#dp2').datepicker({
		format: 'yyyy-mm-dd'	
	});	
});
</script>
</head>
<body>
<div class="page-header">
  <h3>Data Pembelian Produk</h3>
</div>
<form class="form-inline" role="form" action="" method="post">
<label>Cari : </label>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Nama Pemilik</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="nama_pemilik" placeholder="Nama Pemilik" value="<?=$nama_pemilik?>">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Tahun Rakit</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="thn_rakit" placeholder="Tahun Rakit" value="<?=$thn_rakit?>">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Tgl. Daftar</label>
    <input type="text" class="form-control" name="tgl_daftar" placeholder="Tgl Daftar" value="<?=$tgl_daftar?>" id="dp1">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Tgl. Aktif</label>
    <input type="text" class="form-control" name="tgl_aktif" placeholder="Tgl Aktif" value="<?=$tgl_aktif?>" id="dp2">
  </div>
  <div class="form-group">
    <select class="form-control" name="jml_data">
    <option value="10" <?=$jml_data=='10'?"selected":"";?>>10</option>
    <option value="20" <?=$jml_data=='20'?"selected":"";?>>20</option>
    <option value="" <?=$jml_data==''?"selected":"";?>>Semua</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Cari</button>
</form>
<hr>
    <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>No.</th>
                  <th>Nama Pemilik</th>
                  <th>No. Rangka</th>
                  <th>No. Mesin</th>
                  <th>Tahun Rakit</th>
                  <th>Tgl. Daftar</th>
                  <th>Tgl. Aktif</th>
                </tr>
              </thead>
              <tbody>
              <? 
			  $i=1;
			  while($row=mysql_fetch_array($rs)) {?>
                <tr>
                  <td><?=$i++;?></td>
                  <td><?=$row['nama_pemilik'];?></td>
                  <td><?=$row['no_rangka'];?></td>
                  <td><?=$row['no_mesin'];?></td>
                  <td><?=$row['tahun_rakit'];?></td>
                  <td><?=$row['tgl_daftar'];?></td>
                  <td><?=$row['tgl_aktif'];?></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
</body>
</html>