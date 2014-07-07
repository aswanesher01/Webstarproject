<? 
include "inc/conn.php";

$nama_fasilitas	= $_REQUEST['nama_fasilitas'];
$id			= $_REQUEST['id'];
$act		= $_REQUEST['act'];
$paud		= $_REQUEST['paud'];
$jml_data	= $_REQUEST['jml_data'];

$ambil="select * from fasilitas where true";
if($paud!="") {
	$ambil.=" and id_paud='$paud'";	
}
if($nama_fasilitas!="") {
	$ambil.=" and Nama_fas like '$nama_fasilitas%'";	
}
$ambil.=" order by Nama_fas asc";
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
  <? if($act=="input") { echo '<h3>Input Data Fasilitas</h3>'; } else if($act=="edit") { echo '<h3>Ubah Data Fasilitas</h3>'; } else {?>
  <h3>Kelola Data Fasilitas</h3>
  <? } ?>
</div>
<? if($act=="") {?>
<form class="form-inline" role="form" action="" method="post">
<label>Cari : </label>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Nama Guru</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="nama_fasilitas" placeholder="Fasilitas" value="<?=$nama_fasilitas?>">
  </div>
  <div class="form-group">
    	<select class="form-control" name="paud" placeholder="Paud">
    	<option value="">-- Pilih Sekolah --</option>
        <?php	
			$sqlr="SELECT nama_paud, id_paud FROM data_paud ORDER BY nama_paud ASC";
			$rslist=mysql_query($sqlr) or die ("Kesalahan sistem, akan segera kami perbaiki");
			while($rowlist=mysql_fetch_array($rslist)){
		?>
    	<option value="<?=$rowlist['id_paud']?>" <?=$rowlist['id_paud']==$paud?"selected":"";?>><?=$rowlist['nama_paud'];?></option>
        <? } ?>
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
  <a class="btn btn-primary" href="?module=module/fasilitas/index.php&act=input" role="button">Input Fasilitas</a>
</form>
<hr>
    <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>No.</th>
                  <th>ID</th>
                  <th>Nama Fasilitas</th>
                  <th>Nama Paud</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <? 
			  $i=1;
			  while($row=mysql_fetch_array($rs)) {?>
                <tr>
                  <td><?=$i++;?></td>
                  <td><?=$row['Id_Fas'];?></td>
                  <td><?=$row['Nama_fas'];?></td>
                  <td><?
                  $nmpaud=mysql_query("select nama_paud from data_paud where id_paud='".$row['id_paud']."'");
				  $dtpaud=mysql_fetch_array($nmpaud);
				  echo $dtpaud['nama_paud'];
				  ?></td>
                  <td><a class="btn btn-sm btn-primary" href="?module=module/fasilitas/index.php&act=edit&id=<?=$row['Id_Fas'];?>" role="button">Ubah</a>
                  <a class="btn btn-sm btn-danger" onClick="return confirm('Apa anda yakin akan menghapus data ini?')" href="?module=module/fasilitas/remove_fasilitas.php&id=<?=$row['Id_Fas'];?>&id_paud=<?=$row['id_paud'];?>" role="button">Hapus</a></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
<? } else if($act=="input") { ?>
<form class="form-horizontal" role="form" action="module/fasilitas/save_fasilitas.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Nama Fasilitas</label>
    <div class="col-sm-8">
      <input type="text" name="nama_fasilitas" class="form-control" id="inputPaud3" placeholder="Nama Fasilitas">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Nama Paud</label>
    <div class="col-sm-8">
      <label class="sr-only" for="exampleInputJenisPaud2">Paud</label>
    	<select class="form-control" name="paud" placeholder="Paud">
    	<option value=""></option>
        <?php	
			$sqlr="SELECT nama_paud, id_paud FROM data_paud ORDER BY nama_paud ASC";
			$rslist=mysql_query($sqlr) or die ("Kesalahan sistem, akan segera kami perbaiki");
			while($rowlist=mysql_fetch_array($rslist)){
		?>
    	<option value="<?=$rowlist['id_paud']?>"><?=$rowlist['nama_paud'];?></option>
        <? } ?>
      	</select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a class="btn btn-danger" href="?module=module/fasilitas/index.php" role="button">Batal</a>
    </div>
  </div>
</form>

<? } else if($act=="edit") { 
$ambil="select * from fasilitas where true";
if($paud!="") {
	$ambil.=" and id_paud='$paud'";	
}
if($id!="") {
	$ambil.=" and Id_Fas='$id'";	
}
if($nama_fasilitas!="") {
	$ambil.=" and Nama_fas like '$nama_fasilitas%'";	
}
$ambil.=" order by Nama_fas asc";

$rse=mysql_query($ambil);
$data=mysql_fetch_array($rse);
?>

<form class="form-horizontal" role="form" action="module/fasilitas/update_fasilitas.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Id Fasilitas</label>
    <div class="col-sm-8">
      <input type="text" name="id_fasilitas" class="form-control" id="inputPaud3" readonly placeholder="Id Fasilitas" value="<?=$data['Id_Fas'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Nama Fasilitas</label>
    <div class="col-sm-8">
      <input type="text" name="Nama_Fasilitas" class="form-control" id="inputPaud3" placeholder="Nama Fasilitas" value="<?=$data['Nama_fas'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Nama Paud</label>
    <div class="col-sm-8">
      <label class="sr-only" for="exampleInputJenisPaud2">Paud</label>
    	<select class="form-control" name="id_paud" placeholder="Paud">
    	<option value=""></option>
        <?php	
			$sqlr="SELECT nama_paud, id_paud FROM data_paud ORDER BY nama_paud ASC";
			$rslist=mysql_query($sqlr) or die ("Kesalahan sistem, akan segera kami perbaiki");
			while($rowlist=mysql_fetch_array($rslist)){
		?>
    	<option value="<?=$rowlist['id_paud']?>" <?=$data['id_paud']==$rowlist['id_paud']?"selected":"";?>><?=$rowlist['nama_paud'];?></option>
        <? } ?>
      	</select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a class="btn btn-danger" href="?module=module/fasilitas/index.php" role="button">Batal</a>
    </div>
  </div>
</form>
<? } ?>
</body>
</html>