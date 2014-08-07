<? 
include "inc/conn.php";

$nama_paud	= $_REQUEST['nama_paud'];
$jenis_paud	= $_REQUEST['jenis_paud'];
$act		= $_REQUEST['act'];
$id_paud	= $_REQUEST['id'];
$jml_data	= $_REQUEST['jml_data'];

$ambil="select * from data_paud where true";
if($id_paud!="") {
	$ambil.=" and id_paud='$id_paud'";	
}
if($nama_paud!="") {
	$ambil.=" and nama_paud like '$nama_paud%'";	
}
if($jenis_paud!="") {
	$ambil.=" and jenis_sekolah='$jenis_paud'";	
}
$ambil.=" order by nama_paud asc";
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
</head>
<body>
<div class="page-header">
  <? if($act=="input") { echo '<h3>Input Data PAUD</h3>'; } else if($act=="edit") { echo '<h3>Ubah Data PAUD</h3>'; } else {?>
  <h3>Kelola Data PAUD</h3>
  <? } ?>
</div>
<? if($act=="") {?>
<form class="form-inline" role="form" action="" method="post">
<label>Cari : </label>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Nama Paud</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="nama_paud" placeholder="Nama Paud" value="<?=$nama_paud?>">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword2">Password</label>
    <select class="form-control" name="jenis_paud">
    <option value="">-- Jenis PAUD --</option>
    <option value="TK" <?=$jenis_paud=='TK'?"selected":"";?>>TK</option>
    <option value="RA" <?=$jenis_paud=='RA'?"selected":"";?>>Raudhatul Athfal</option>
    </select>
  </div>
  <div class="form-group">
    <select class="form-control" name="jml_data">
    <option value="10" <?=$jml_data=='10'?"selected":"";?>>10</option>
    <option value="20" <?=$jml_data=='20'?"selected":"";?>>20</option>
    <option value="" <?=$jml_data==''?"selected":"";?>>Semua</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Cari</button>
  <a class="btn btn-primary" href="?module=module/paud/index.php&act=input" role="button">Input PAUD</a>
</form>
<hr>
    <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>No.</th>
                  <th>ID</th>
                  <th width="30px">Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Uang Pangkal</th>
                  <th>SPP</th>
                  <th>Jenis</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <? 
			  $i=1;
			  while($row=mysql_fetch_array($rs)) {?>
                <tr>
                  <td><?=$i++;?></td>
                  <td><?=$row['id_paud'];?></td>
                  <td><?=$row['nama_paud'];?></td>
                  <td><?=$row['Alamat_Paud'];?></td>
                  <td><?=$row['Telepon'];?></td>
                  <td><?=$row['Uang_Pangkal'];?></td>
                  <td><?=$row['Spp'];?></td>
                  <td><?=$row['jenis_sekolah'];?></td>
                  <td><a class="btn btn-sm btn-primary" href="?module=module/paud/index.php&act=edit&id=<?=$row['id_paud'];?>" role="button">Ubah</a>
                  <a class="btn btn-sm btn-danger" onClick="return confirm('Anda yakin akan menghapus data ini?')" href="?module=module/paud/remove_paud.php&id=<?=$row['id_paud'];?>" role="button">Hapus</a>
                  <a class="btn btn-sm btn-warning" href="?module=module/paud/viewall.php&id=<?=$row['id_paud'];?>&jenis_paud=<?=$row['jenis_sekolah'];?>" role="button">Rincian</a></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
<? } else if($act=="input") { ?>
<form class="form-horizontal" role="form" action="module/paud/save_paud.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Nama PAUD</label>
    <div class="col-sm-8">
      <input type="text" name="nm_paud" class="form-control" id="inputPaud3" placeholder="Nama Paud">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" rows="3" name="alamat_paud"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Telepon</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="telepon" placeholder="Telepon">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Uang Pangkal</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="uang_pangkal" placeholder="Uang Pangkal">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">SPP</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="spp" placeholder="SPP">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Jenis PAUD</label>
    <div class="col-sm-8">
      <label class="sr-only" for="exampleInputJenisPaud2">Jenis PAUD</label>
    	<select class="form-control" name="jns_paud" placeholder="Jenis PAUD">
    	<option value=""></option>
    	<option value="TK">TK</option>
    	<option value="RA">Raudhatul Athfal</option>
      	</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Latitude</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="latitude" placeholder="Latitude">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Longitude</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="longitude" placeholder="Longitude">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a class="btn btn-danger" href="?module=module/paud/index.php" role="button">Batal</a>
    </div>
  </div>
</form>

<? } else if($act=="edit") { 

$ambil="select * from data_paud where true";
if($id_paud!="") {
	$ambil.=" and id_paud='$id_paud'";	
}
if($nama_paud!="") {
	$ambil.=" and nama_paud like '$nama_paud%'";	
}
if($jenis_paud!="") {
	$ambil.=" and jenis_sekolah='$jenis_paud'";	
}
$ambil.=" order by nama_paud asc";

$rse=mysql_query($ambil);
$data=mysql_fetch_array($rse);
?>

<form class="form-horizontal" role="form" action="module/paud/update_paud.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Nama PAUD</label>
    <div class="col-sm-8">
      <input type="text" name="id_paud" value="<?=$data['id_paud']?>" readonly class="form-control" id="inputPaud3" placeholder="Nama Paud">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Nama PAUD</label>
    <div class="col-sm-8">
      <input type="text" name="nama_paud" value="<?=$data['nama_paud']?>" class="form-control" id="inputPaud3" placeholder="Nama Paud">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" rows="3" name="Alamat_Paud"><?=$data['Alamat_Paud']?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Telepon</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="Telepon" value="<?=$data['Telepon']?>" placeholder="Telepon">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Uang Pangkal</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="Uang_Pangkal" placeholder="Uang Pangkal" value="<?=$data['Uang_Pangkal']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">SPP</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="Spp" placeholder="SPP" value="<?=$data['Spp']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Jenis PAUD</label>
    <div class="col-sm-8">
      <label class="sr-only" for="exampleInputJenisPaud2">Jenis PAUD</label>
    	<select class="form-control" name="jenis_sekolah" placeholder="Jenis PAUD">
    	<option value=""></option>
    	<option value="TK" <?=$data['jenis_sekolah']=='TK'?"selected":"";?>>TK</option>
    	<option value="RA" <?=$data['jenis_sekolah']=='RA'?"selected":"";?>>Raudhatul Athfal</option>
      	</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Latitude</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="Latitude" placeholder="Latitude" value="<?=$data['Latitude']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Longitude</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="longitude" placeholder="Longitude" value="<?=$data['longitude']?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a class="btn btn-danger" href="?module=module/paud/index.php" role="button">Batal</a>
    </div>
  </div>
</form>
<? } ?>
</body>
</html>