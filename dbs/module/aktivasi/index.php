<? 
include "inc/conn.php";

$nama_fasilitas	= $_REQUEST['nama_fasilitas'];
$id			= $_REQUEST['id'];
$act		= $_REQUEST['act'];
$paud		= $_REQUEST['paud'];
$jml_data	= $_REQUEST['jml_data'];

$ambil="select * from produk where true";
if($paud!="") {
	$ambil.=" and id_paud='$paud'";	
}
if($nama_fasilitas!="") {
	$ambil.=" and Nama_fas like '$nama_fasilitas%'";	
}
$ambil.=" order by tgl_daftar asc";
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
<title>.: Paud :.</title>
<script>
$(document).ready(function() {
	$('#dp1').datepicker({
		format: 'yyyy-mm-dd'	
	});	
	
	$('#dp2').datepicker({
		format: 'yyyy-mm-dd'	
	});
	
	$('.aktivasi').change(function() {
		var id	   = $(this).attr('id');
		var nopol  = $(this).attr('title');
		var status	= $(this).val(); 	
		
		var datana='nopol='+nopol+'&status='+status;
		
		$.ajax({
			type: "POST",
    		url: "module/aktivasi/proses_aktivasi.php",
    		data: datana,
    		success: function(server_response){
					if(server_response=='1') {
						 alert('Proses aktivasi gagal');
					} else if(server_response=='2') {
						 alert('Proses aktivasi berhasil');
					}
   				}	   
			});
		});
		return false;
});

</script>
</head>
<body>
<div class="page-header">
  <h3>Aktivasi</h3>
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
<hr>
    <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>ID</th>
                  <th>Nama Pemilik</th>
                  <th>No. Rangka</th>
                  <th>No. Mesin</th>
                  <th>Tahun Perakitan</th>
                  <th>Tgl Aktif</th>
                  <th>Aksi/Status</th>
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
                  <td><?=$row['tgl_aktif'];?></td>
                  <td><select name="aktivasi" class="aktivasi" id="<?=$i;?>" title="<?=$row['no_polisi']?>">
                  <option value="true" <?=$row['status']=="true"?"selected":"";?>>Aktifkan</option>
                  <option value="false" <?=$row['status']=="false"?"selected":"";?>>Non-aktif</option>
                  </select></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
</body>
</html>