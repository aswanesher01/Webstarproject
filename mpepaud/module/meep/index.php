<? 
include "inc/conn.php";

$jml_data	= $_REQUEST['jml_data'];

$ambil="select data_paud.nama_paud, bobot_penilaian.* from bobot_penilaian, data_paud where data_paud.id_paud=bobot_penilaian.id_paud order by data_paud.nama_paud asc";
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
  <? if($act=="input") { echo '<h3>Input Data Angkot</h3>'; } else if($act=="edit") { echo '<h3>Ubah Data Angkot</h3>'; } else {?>
  <h3>Perhitungan MFEP PAUD</h3>
  <? } ?>
</div>
<? if($act=="") {?>
<!--<form class="form-inline" role="form" action="" method="post">
<label>Cari : </label>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Asal</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="asal" placeholder="Asal" value="<?=$asal?>">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Tujuan</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="tiba" placeholder="Tujuan" value="<?=$tiba?>">
  </div>
  <div class="form-group">
    <select class="form-control" name="jml_data">
    <option value="10" <?=$jml_data=='10'?"selected":"";?>>10</option>
    <option value="20" <?=$jml_data=='20'?"selected":"";?>>20</option>
    <option value="" <?=$jml_data==''?"selected":"";?>>Semua</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Cari</button>
  <a class="btn btn-primary" href="?module=module/angkot/index.php&act=input" role="button">Input Jalur Angkot</a>
</form>
<hr>-->
    <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  	<th>ID Paud</th>
					<th>Nama Paud</th>
					<th>Bobot Jarak</th>
                	<th>Bobot SPP</th>
                	<th>Bobot Uang Pangkal</th>
                	<th>Bobot Fasilitas</th>
                	<th>Bobot Guru</th>
                	<th>Bobot Total</th>
                </tr>
              </thead>
              <tbody>
              <? while($row=mysql_fetch_array($rs)) {?>
                <tr>
                  <td><?=$row['id_paud'];?></td>
                  <td><?=$row['nama_paud'];?></td>
                  <td><?=$row['nilai_jarak'];?></td>
                  <td><?=$row['nilai_spp'];?></td>
                  <td><?=$row['nilai_uang_pangkal'];?></td>
                  <td><?=$row['nilai_fas'];?></td>
                  <td><?=$row['nilai_gur'];?></td>
                  <td><?=$row['nilai_total'];?></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
<? } else if($act=="input") { ?>
<form class="form-horizontal" role="form" action="module/angkot/save_angkot.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Asal</label>
    <div class="col-sm-8">
      <input type="text" name="asal" class="form-control" id="inputPaud3" placeholder="Asal">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Tujuan</label>
    <div class="col-sm-8">
      <input type="text" name="tiba" class="form-control" id="inputPaud3" placeholder="Tujuan">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Rute</label>
    <div class="col-sm-8">
      <textarea class="form-control" rows="3" name="rute"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a class="btn btn-danger" href="?module=module/angkot/index.php" role="button">Batal</a>
    </div>
  </div>
</form>

<? } else if($act=="edit") { 
$ambil="select * from angkot where true";
if($asal!="") {
	$ambil.=" and asal='$asal'";	
}
if($tiba!="") {
	$ambil.=" and Tiba='$tiba'";	
}
if($id!="") {
	$ambil.=" and Kode_ang='$id'";	
}
$ambil.=" order by Kode_ang asc";

$rse=mysql_query($ambil);
$data=mysql_fetch_array($rse);
?>

<form class="form-horizontal" role="form" action="module/angkot/update_angkot.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Kode Angkot</label>
    <div class="col-sm-8">
      <input type="text" name="kode_ang" class="form-control" id="inputPaud3" placeholder="Kode Angkot" value="<?=$data['Kode_ang']?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Asal</label>
    <div class="col-sm-8">
      <input type="text" name="asal" class="form-control" id="inputPaud3" placeholder="Asal" value="<?=$data['asal']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Tujuan</label>
    <div class="col-sm-8">
      <input type="text" name="tiba" class="form-control" id="inputPaud3" placeholder="Tujuan" value="<?=$data['Tiba']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Rute</label>
    <div class="col-sm-8">
      <textarea class="form-control" rows="3" name="rute"><?=$data['Rute']?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a class="btn btn-danger" href="?module=module/angkot/index.php" role="button">Batal</a>
    </div>
  </div>
</form>
<? } ?>
</body>
</html>