<? 
include "inc/conn.php";

$nama_guru	= $_REQUEST['nama_guru'];
$pend_guru	= $_REQUEST['pend_guru'];
$act		= $_REQUEST['act'];
$id_guru	= $_REQUEST['id'];
$paud		= $_REQUEST['paud'];
$jml_data	= $_REQUEST['jml_data'];

$ambil="select * from pend_guru where true";
if($paud!="") {
	$ambil.=" and id_paud='$paud'";	
}
if($nama_guru!="") {
	$ambil.=" and Nama_Guru like '$nama_guru%'";	
}
if($pend_guru!="") {
	$ambil.=" and Pendidikan='$pend_guru'";	
}
$ambil.=" order by Nama_Guru asc";
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
  <? if($act=="input") { echo '<h3>Input Data Guru</h3>'; } else if($act=="edit") { echo '<h3>Ubah Data Guru</h3>'; } else {?>
  <h3>Kelola Data Guru</h3>
  <? } ?>
</div>
<? if($act=="") {?>
<form class="form-inline" role="form" action="" method="post">
<label>Cari : </label>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Nama Guru</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="nama_guru" placeholder="Nama Guru" value="<?=$nama_guru?>">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword2">Password</label>
    <select class="form-control" name="pend_guru">
    <option value="">-- Pendidikan Guru --</option>
    <option value="SMA" <?=$pend_guru=='SMA'?"selected":"";?>>SMA</option>
    <option value="D3" <?=$pend_guru=='D3'?"selected":"";?>>Diploma</option>
    <option value="S1" <?=$pend_guru=='S1'?"selected":"";?>>Sarjana</option>
    </select>
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
  <a class="btn btn-primary" href="?module=module/pegawai/index.php&act=input" role="button">Input Guru</a>
</form>
<hr>
    <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>No.</th>
                  <th>ID</th>
                  <th>Nama Guru</th>
                  <th>Pendidikan</th>
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
                  <td><?=$row['Id_guru'];?></td>
                  <td><?=$row['Nama_Guru'];?></td>
                  <td><? 
				  	if($row['Pendidikan']=="SMA") {
						echo "SMA";	  
					} else if($row['Pendidikan']=="D3") {
						echo "Diploma";	
					} else if($row['Pendidikan']=="S1") {
						echo "Sarjana";	
					}?></td>
                  <td><?
                  $nmpaud=mysql_query("select nama_paud from data_paud where id_paud='".$row['id_paud']."'");
				  $dtpaud=mysql_fetch_array($nmpaud);
				  echo $dtpaud['nama_paud'];
				  ?></td>
                  <td><a class="btn btn-sm btn-primary" href="?module=module/pegawai/index.php&act=edit&id=<?=$row['Id_guru'];?>" role="button">Ubah</a>
                  <a class="btn btn-sm btn-danger" onClick="return confirm('Apa anda yakin akan menghapus data ini?')" href="?module=module/pegawai/remove_pegawai.php&id=<?=$row['Id_guru'];?>&id_paud=<?=$row['id_paud'];?>" role="button">Hapus</a></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
<? } else if($act=="input") { ?>
<form class="form-horizontal" role="form" action="module/pegawai/save_pegawai.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Nama Guru</label>
    <div class="col-sm-8">
      <input type="text" name="nama" class="form-control" id="inputPaud3" placeholder="Nama Guru">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Jenis PAUD</label>
    <div class="col-sm-8">Pendidikan
      <select class="form-control" name="pendidikan" placeholder="Pendidikan Guru">
    	<option value=""></option>
    	<option value="SMA">SMA</option>
    	<option value="D3">Diploma</option>
        <option value="S1">Sarjana</option>
      	</select>
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
      <a class="btn btn-danger" href="?module=module/pegawai/index.php" role="button">Batal</a>
    </div>
  </div>
</form>

<? } else if($act=="edit") { 

$id = $_REQUEST['id'];

$ambil="select * from pend_guru where true";
if($id!="") {
	$ambil.=" and Id_guru='$id'";	
}
if($paud!="") {
	$ambil.=" and id_paud='$paud'";	
}
if($nama_guru!="") {
	$ambil.=" and Nama_Guru like '$nama_guru%'";	
}
if($pend_guru!="") {
	$ambil.=" and Pendidikan='$pend_guru'";	
}
$ambil.=" order by Nama_Guru asc";

$rse=mysql_query($ambil);
$data=mysql_fetch_array($rse);
?>

<form class="form-horizontal" role="form" action="module/pegawai/update_pegawai.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Id Guru</label>
    <div class="col-sm-8">
      <input type="text" name="id" class="form-control" id="inputPaud3" readonly placeholder="Id Guru" value="<?=$data['Id_guru'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Nama Guru</label>
    <div class="col-sm-8">
      <input type="text" name="Nama_Guru" class="form-control" id="inputPaud3" placeholder="Nama Guru" value="<?=$data['Nama_Guru'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Pendidikan</label>
    <div class="col-sm-8">
      <label class="sr-only" for="exampleInputJenisPaud2">Pendidikan</label>
    	<select class="form-control" name="Pendidikan" placeholder="Pendidikan Guru">
    	<option value=""></option>
    	<option value="SMA" <?=$data['Pendidikan']=='SMA'?"selected":"";?>>SMA</option>
    	<option value="D3" <?=$data['Pendidikan']=='D3'?"selected":"";?>>Diploma</option>
        <option value="S1" <?=$data['Pendidikan']=='S1'?"selected":"";?>>Sarjana</option>
      	</select>
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
      <a class="btn btn-danger" href="?module=module/pegawai/index.php" role="button">Batal</a>
    </div>
  </div>
</form>
<? } ?>
</body>
</html>