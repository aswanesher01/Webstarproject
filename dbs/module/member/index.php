<? 
include "inc/conn.php";

$nama		= $_REQUEST['nama'];
$nomor_hp	= $_REQUEST['nomor_hp'];
$jml_data	= $_REQUEST['jml_data'];

$ambil="select * from nasabah where true";
if($nama!="") {
	$ambil.=" and nama like '$nama%'";	
}
if($nomor_hp!="") {
	$ambil.=" and nomor_hp='$nomor_hp%'";	
}
$ambil.=" order by nama asc";
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
</head>
<body>
<div class="page-header">
  <h3>List Member</h3>
</div>
<form class="form-inline" role="form" action="" method="post">
<label>Cari : </label>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Nama</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="nama" placeholder="Nama" value="<?=$nama?>">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">No. HP</label>
    <input type="text" class="form-control" id="exampleInputEmail2" name="nomor_hp" placeholder="No. HP" value="<?=$nomor_hp?>">
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
                  <th>ID DBS</th>
                  <th>Nama</th>
                  <th>Nomor HP</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
              <? 
			  $i=1;
			  while($row=mysql_fetch_array($rs)) {?>
                <tr>
                  <td><?=$i++;?></td>
                  <td><?=$row['Id_dbs'];?></td>
                  <td><?=$row['nama'];?></td>
                  <td><?=$row['nomor_hp'];?></td>
                  <td><?=$row['email'];?></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
</body>
</html>