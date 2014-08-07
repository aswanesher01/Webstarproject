<? 
include "inc/conn.php";

$nama_paud	= $_REQUEST['nama_paud'];
$jenis_paud	= $_REQUEST['jenis_paud'];
$act		= $_REQUEST['act'];
$id_paud	= $_REQUEST['id'];
$jml_data	= $_REQUEST['jml_data'];

$ambil="select * from data_paud where true";
$ambil.=" and id_paud='$id_paud'";

$ambilfasilitas=mysql_query("select * from fasilitas where id_paud='$id_paud'");	
$ambilguru=mysql_query("select * from pend_guru where id_paud='$id_paud'");
$ambilbobot=mysql_query("select * from bobot_penilaian where id_paud='$id_paud'");

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
  <h3>Rincian Data PAUD</h3><a class="btn btn-primary" href="?module=module/paud/index.php&jenis_paud=<?=$jenis_paud;?>" role="button">Kembali</a>
</div>
    <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>ID</th>
                  <th width="30px">Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Uang Pangkal</th>
                  <th>SPP</th>
                  <th>Jenis</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Guru SMA</th>
                  <th>Guru Diploma</th>
                  <th>Guru Sarjana</th>
                </tr>
              </thead>
              <tbody>
              <? while($row=mysql_fetch_array($rs)) {?>
                <tr>
                  <td><?=$row['id_paud'];?></td>
                  <td><?=$row['nama_paud'];?></td>
                  <td><?=$row['Alamat_Paud'];?></td>
                  <td><?=$row['Telepon'];?></td>
                  <td><?=$row['Uang_Pangkal'];?></td>
                  <td><?=$row['Spp'];?></td>
                  <td><?=$row['jenis_sekolah'];?></td>
                  <td><?=$row['Latitude'];?></td>
                  <td><?=$row['longitude'];?></td>
                  <td><?=$row['jml_sma'];?></td>
                  <td><?=$row['jml_d3'];?></td>
                  <td><?=$row['jml_s1'];?></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
          <!-- AMBIL DATA GURU -->
          <hr>
          <div class="page-header">
  <h3>Rincian Data Guru</h3>
</div>
          
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>ID Guru</th>
                  <th>Nama</th>
                  <th>Pendidikan</th>
                </tr>
              </thead>
              <tbody>
              <? while($rowguru=mysql_fetch_array($ambilguru)) {?>
                <tr>
                  <td><?=$rowguru['Id_guru'];?></td>
                  <td><?=$rowguru['Nama_Guru'];?></td>
                  <td><? 
				  	if($rowguru['Pendidikan']=="SMA") {
						echo "SMA";	  
					} else if($rowguru['Pendidikan']=="D3") {
						echo "Diploma";	
					} else if($rowguru['Pendidikan']=="S1") {
						echo "Sarjana";	
					}?></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
          <!-- AMBIL DATA Fasilitas -->
          <hr>
          <div class="page-header">
  <h3>Rincian Data Fasilitas</h3>
</div>
          
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>ID Fasilitas</th>
                  <th>Nama Fasilitas</th>
                </tr>
              </thead>
              <tbody>
              <? while($rowfas=mysql_fetch_array($ambilfasilitas)) {?>
                <tr>
                  <td><?=$rowfas['Id_Fas'];?></td>
                  <td><?=$rowfas['Nama_fas'];?></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
          <!-- AMBIL DATA Bobot Penilaian -->
          <hr>
          <div class="page-header">
  <h3>Rincian Data Bobot Penilaian</h3>
</div>
          
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="panel-heading">
                <tr>
                  <th>Bobot Jarak</th>
                  <th>Bobot SPP</th>
                  <th>Bobot Uang Pangkal</th>
                  <th>Bobot Fasilitas</th>
                  <th>Bobot Guru</th>
                  <th>Bobot Total</th>
                </tr>
              </thead>
              <tbody>
              <? while($rowbobot=mysql_fetch_array($ambilbobot)) {?>
                <tr>
                  <td><?=$rowbobot['nilai_jarak'];?></td>
                  <td><?=$rowbobot['nilai_spp'];?></td>
                  <td><?=$rowbobot['nilai_uang_pangkal'];?></td>
                  <td><?=$rowbobot['nilai_fas'];?></td>
                  <td><?=$rowbobot['nilai_gur'];?></td>
                  <td><?=$rowbobot['nilai_total'];?></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
</body>
</html>