<html>
<head>
	<title>Import Excel To MySQL</title>
</head>
</html>
<table width=100%>
<tr>
	<td valign=top width=50%>
	<fieldset>
	<legend>Upload Data Excel ke Database</legend>
    <p>
            Silahkan download contoh format data <a href="ex_datapaud.xls"><b>disini</b></a>
            </p><br />
	<?php
	if(isset($_POST[upload])){
		include "upload.php";
	}elseif(isset($_POST[truncate])){
		include "inc/conn.php";
		$trun1=mysql_query("TRUNCATE TABLE data_paud") or die("Gagal kosongkan table");
		$trun2=mysql_query("TRUNCATE TABLE fasilitas") or die("Gagal kosongkan table");
		$trun3=mysql_query("TRUNCATE TABLE pend_guru") or die("Gagal kosongkan table");
		$trun4=mysql_query("TRUNCATE TABLE bobot_penilaian") or die("Gagal kosongkan table");
		if($trun){
		echo"Truncate data berhasil &nbsp;<a href='?module=modules/import/index.php'>refresh</a>";
		}else{
		echo"Truncate data gagal &nbsp;<a href='index.php'>refresh</a>";
		}
	}else{
	?>
	<form class="form-inline" role="form" name="upload" enctype="multipart/form-data" id="upload" method="post" action="?module=module/import/upload.php"  />
	
		<input type="hidden" name="div" value="<?php echo $_GET['ref'];?>">
		<table width="100%">
		<tr>
			<td >Browse Excel</td><td><input size=50 type="file" name="userfile" class="form-control" > 
            <input type="submit" onclick="return confirm('Apakah Anda yakin akan import data ke table?')" name="upload" Value="Proses Upload">
            <input type="submit" name="truncate" Value="Kosongkan Table" onclick="return confirm('Apakah Anda yakin akan kosongkan data di table ?')"> <br />
            </td>
		</tr>
		</table><br />
        
	</form>
	<?php
	}
	?>
	</fieldset>
	<?php //include "view.php";?>
	</td>
</tr>
</table>
