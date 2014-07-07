<?php
//include ("../../inc/koneksi.php");

session_start();

/*if($_POST['task']){
	if ($_POST['task']=="new"){
	  $sql = "INSERT INTO t_user (username,nama,password,status_user) 
		VALUES ('".$_POST['username']."','".$_POST['nama']."','".md5($_POST['password'])."','".$_POST['status_user']."')";
	  mysql_query($sql);
	  $j=0;
	  for($i=1;$i<=$_POST['count'];$i++){
		  $menu = explode('_',$_POST['chk_'.$i]);
		  if($menu[0]!=$j&&$_POST['chk_'.$i]){
		  	 $sql2 = "INSERT INTO t_user_menu (USERNAME,ID_MENU,ID_MENU_TREE) 
				VALUES ('".$_POST['username']."','".$menu[0]."','0')";
			 print $sql2;
			  mysql_query($sql2);
			  $j = $menu[0];
			  print $menu[0];
		  }
		  if($menu[0]){
			  $sql2 = "INSERT INTO t_user_menu (username,id_menu,id_menu_tree) 
					VALUES ('".$_POST['username']."','".$menu[0]."','".$menu[1]."')";
			  mysql_query($sql2);
		  } elseif ($_POST['task']=="edit") {
	  $sql3 = "UPDATE t_user SET nama='".$_POST['nama']."',password='".$_POST['password']."'
	  	,status_user='".$_POST['status_user']."',status_aktif='".$_POST['status_aktif']."' WHERE username='".$_POST['username']."'";
	  mysql_query($sql3);
	  print $sql3;
		}
	}
}

}*/
/*if($_POST['task']){
	if ($_POST['task']=="new"){
	   $sql = "INSERT INTO t_user (id, id_user, username,nama,password,status_user,status_aktif,id_sekolah) 
		VALUES (NULL, '".$_POST['id_instansi']."', '".$_POST['username']."','".$_POST['nama']."','".md5($_POST['password'])."','".$_POST['status_user']."', '".$_POST['status_aktif']."', '".$_POST['id_instansi']."')";
	  mysql_query($sql);
	  $j=0;
	  for($i=1;$i<=$_POST['count'];$i++){
		  $menu = explode('_',$_POST['chk_'.$i]);
		  if($menu[0]!=$j&&$_POST['chk_'.$i]){
		  	 $sql2 = "INSERT INTO t_user_menu (username,id_menu,id_menu_tree) 
				VALUES ('".$_POST['username']."','".$menu[0]."','0')";
			  mysql_query($sql2);
			  $j = $menu[0];
		  }
		  if($menu[0]){
			  $sql2 = "INSERT INTO t_user_menu (username,id_menu,id_menu_tree) 
					VALUES ('".$_POST['username']."','".$menu[0]."','".$menu[1]."')";
			  mysql_query($sql2);
		  }
	  }
	} elseif ($_POST['task']=="edit") {
	  $sql3 = "UPDATE t_user SET nama='".$_POST['nama']."',password='".$_POST['password']."'
	  	,status_user='".$_POST['status_user']."', status_aktif='".$_POST['status_aktif']."'  WHERE username='".$_POST['username']."'";
	  //print $sql3;
	  mysql_query($sql3);
	  $query = "DELETE FROM t_user_menu WHERE username='".$_POST['username']."'";
	  mysql_query($query);
	  $j=0;
	  for($i=1;$i<=$_POST['count'];$i++){
		  $menu = explode('_',$_POST['chk_'.$i]);
		  if($menu[0]!=$j&&$_POST['chk_'.$i]){
		  	 $sql2 = "INSERT INTO t_user_menu (username,id_menu,id_menu_tree) 
				VALUES ('".$_POST['username']."','".$menu[0]."','0')";
			  mysql_query($sql2);
			  $j = $menu[0];
		  }
		  if($menu[0]){
			  $sql2 = "INSERT INTO t_user_menu (username,id_menu,id_menu_tree) 
					VALUES ('".$_POST['username']."','".$menu[0]."','".$menu[1]."')";
			  mysql_query($sql2);
		  }
	  }
	}
		/*echo "<script language='javascript'>
	location.href='?module=modul/tools/user_management.php';
	</script>";
}*/
?>
<?php
$module = $_REQUEST['module'];
$act			= $_REQUEST['act'];
$params_date	= $_REQUEST['params_date'];
$nmna			= $_REQUEST['nmna'];
$usrnmna		= $_REQUEST['usrnmna'];
$id_instansis	= $_REQUEST['id_instansis'];			
$status_usernas	= $_REQUEST['status_usernas'];

$cek_ids="SELECT ID_SEKOLAH FROM t_user WHERE USERNAME='".$_SESSION['username']."' ";
$rs_ids=mysql_query($cek_ids) or die ("Kesalahan sistem, akan segera kami perbaiki");
$ids=mysql_fetch_array($rs_ids);

//$maxrow			=	$_REQUEST['maxrow']?$_REQUEST['maxrow']:"33";
$page			=	$_REQUEST['page']?$_REQUEST['page']:"1";
$page			=	$act=="src"?"1":$page;
$paramsnav="?module=".$module;
//$paramsnav.="&params_date=".$params_date;
$paramsnav.="&maxrow=".$maxrow;

/////////////////////////////////////////////////////////////////////////////////////////////////////
$sql = "SELECT * FROM t_user WHERE (STATUS_USER=1 OR STATUS_USER=2 OR STATUS_USER=4)";
if($ids['ID_SEKOLAH']==1) {
$sql.=" ";
} else if($ids['ID_SEKOLAH']!=1) {
$sql.=" AND ID_SEKOLAH='".$ids['ID_SEKOLAH']."'";
} if($id_instansis) {
$sql.=" AND ID_SEKOLAH='".$id_instansis."'";
} 
if($usrnmna) {
$sql.=" AND USERNAME='".$usrnmna."'";	
}
if($nmna) {
$sql.=" AND NAMA LIKE '%".$nmna."%'";	
}
if($status_usernas) {
$sql.=" AND STATUS_USER='".$status_usernas."'";	
}
$sql.=" ORDER BY NAMA ASC, USERNAME ASC";
//$sql.= " WHERE TRUE";
//$sql.= " ORDER BY username ASC";
//$sqlnav= $sql; //get LIMIT ALL
//$sql .=$page?" LIMIT $maxrow OFFSET ".(($page-1)*$maxrow):"";
//echo $sql."<br>";
//echo $sql;
/////////////////////////////////////////////////////////////////////////////////////////////////////
$rs = mysql_query($sql);

?><!-- Start Table Search -->
<!-- End Table Search -->
<!-- Start Table Data -->
<style>
adm
.ui-widget { 
	font-family: Verdana,Arial,sans-serif; 
	font-size:9px; 
	}
.ui-widget .ui-widget { 
	font-size: 9px; 
	}
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { 
	font-family: Verdana,Arial,sans-serif; 
	font-size: 9px; 
	}
.ui-widget-content { 
	background: #ffffff url(images/ui-bg_flat_75_ffffff_40x100.png) 50% 50% repeat-x; 
	color: #222222; 
	}
	
.ui-widget-content a { 
	color: #222222; }

.ui-widget-header { 
	border: 1px solid #aaaaaa; 
	background: #cccccc url(images/ui-bg_highlight-soft_75_cccccc_1x100.png) 50% 50% repeat-x; 
	color: #222222; 
	font-weight: bold; 
}

.ui-widget-header a { 
	color: #222222; 
	}

#availability_status {
	font-size:11px;
	margin-left:3px;
	width:400px;
}
.error{
	
	color:#d12f19;
	font-size:12px;
	
		
	}
	.success{
	
	color:#006600;
	font-size:12px;
	
		
	}

.header_input {
	padding:10px;
	background-image:url(../images/header-image.png);
	-moz-border-radius: 5px;
	border-radius: 5px;
	top:9px;
	border:1px #CCCCCC solid;
}

.trselang {
	background-color: #E5E5E5;
	font-size:12px;
}
.trseling {
	background-color: #F3F3F3;
	font-size:12px;
}

.tombol {
	padding: 0.3em 0.7em; 
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0.5, #E4F3FF), color-stop(1.0, #C7DCFF)); 
	border: 1px #6D8A9F solid; 
	-webkit-border-radius: 0.3em; 
	box-shadow: 1px 1px 1px #ccc;
}

.kolom {
	border:1px solid #CCCCCC;
}
.kolom { border:1px solid #CCCCCC; }

</style>
<!--<script type="text/javascript" src="js/ajax_proses.js"></script>-->
<script>
///////////////// TAMBAH USER //////////////////////////////////////
$(document).ready(function() {
	$(".ubah_hak_akses").click(function() {
	
		var id_user		= $(this).attr("id");
		var datana='id_user='+id_user;
	
		$.ajax({
			type:"POST",
			url:"modul/tools/add_user.php",
			data:datana,
			success:function() {
				$("#rekap_user").hide();
				$("#add_user").fadeIn(400).html('<img src="images/loading.gif" align="absmiddle"> Ambil halaman, silahkan tunggu.....');
				$("#add_user").load("modul/tools/add_user.php?"+datana);
			}
		});
	return false;
	});
});

//////////////////// buka panel ubah user ///////////////////////////////////
$(document).ready(function() {
	$(".ubah_user").click(function() {
		var id_user		= $(this).attr("id");
		var username	= escape($(this).attr("name"));
		
		var datana='id_user='+id_user+'&username='+username;
	
	$.ajax({
			type:"POST",
			url:"modul/tools/ubah_user.php",
			data:datana,
			success:function() {
				$("#rekap_user").hide();
				$("#ubah_user").fadeIn(400).html('<img src="images/loading.gif" align="absmiddle"> Ambil halaman, silahkan tunggu.....');
				$("#ubah_user").load("modul/tools/ubah_user.php?"+datana);
			}
		});
	return false;
	});
});

////////////////////// buka panel tambah user ////////////////////////
$(document).ready(function() {
	$(".buka_panel_tambah_user").click(function() {
		$("#panel_tambah_user").toggle();
	return false;
	});
});

//////////////////// proses simpan user /////////////////////////////
$(document).ready(function() {
	$("#simpan_user").click(function() {
		var username 	= $("#username").val();
		var nama		= escape($("#nama").val());
		var status_user	= $("#status_user").val();
		var password	= $("#password").val();
		var status_aktif= $("#status_aktif").val();
		var id_instansi	= $("#id_instansi").val();
		var id_yayasan	= $("#id_yayasan").val();
		
		var datana='username='+username+'&nama='+nama+'&status_user='+status_user+
		'&password='+password+'&status_aktif='+status_aktif+'&id_instansi='
		+id_instansi+'&id_yayasan='+id_yayasan;
		
		$.ajax({
			type:"post",
			url:"modul/tools/proses_simpan_user.php",
			data:datana,
			success:function(respon) {
				if(respon==1) {
					$("#rekap_user").hide();
					$("#add_user").fadeIn(400).html('<img src="images/loading.gif" align="absmiddle"> Ambil halaman, silahkan tunggu.....');
					$("#add_user").load("modul/tools/add_user.php?"+datana);
					
				} else if(respon==2) {
					alert("User baru gagal ditambahkan");
				} else if(respon==3) {
					alert("Username sudah terdaftar,tidak dapat input ulang");
				}
			}
		});
	return false;
	});
});
</script>
<div id="rekap_user">
<div class="header_input" align="center"><strong>PENGATURAN AKUN</strong></div><br /><br /><br />
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tabel_pencarian">
    <tr class="trselang">
      <td width="15%">Nama</td>
      <td width="1%">:</td>
      <td width="84%"><input type="text" name="nmna" value="<?=$nmna?>" id="textfield" /></td>
    </tr>
    <tr class="trseling">
      <td>Username</td>
      <td>:</td>
      <td><input type="text" name="usrnmna" id="textfield2" value="<?=$usrnmna?>" /></td>
    </tr>
    <tr class="trselang">
      <td>Sekolah</td>
      <td>:</td>
      <td><select name="id_instansis" id="id_instansis">
          <option value="">Pilih</option>
          <?php
			$sqlr="SELECT id_sekolah, nama_sekolah FROM t_info_sekolah";
			if($ids['ID_SEKOLAH']==1) {
			$sqlr.=" ";
			} else {
			$sqlr.=" WHERE id_sekolah='".$ids['ID_SEKOLAH']."' ORDER BY nama_sekolah ASC";
			}
			//print $sqlr;
			$rslist=mysql_query($sqlr) or die('Query failed: ' . mysql_error());
			while($rowlist=mysql_fetch_array($rslist)){
			?>
          <option value="<?=$rowlist['id_sekolah'];?>" <?=$rowlist['id_sekolah']==$id_instansis?"selected":"";?>>
          <?=$rowlist['nama_sekolah'];?>
          </option>
          <?php
			}
			?>
        </select></td>
    </tr>
    <tr class="trseling">
      <td>Status user</td>
      <td>:</td>
      <td><select name="status_usernas" id="status_usernas">
	<option value="">Pilih</option>
          <?php
			$sqlr="SELECT STATUS_USER, KETERANGAN FROM t_status_user";
			print $sqlr;
			$rslist=mysql_query($sqlr) or die('Query failed: ' . mysql_error());
			while($rowlist=mysql_fetch_array($rslist)){
			?>
          <option value="<?=$rowlist['STATUS_USER'];?>" <?=$rowlist['STATUS_USER']==$status_usernas?"selected":"";?>>
          <?=$rowlist['KETERANGAN'];?>
          </option>
          <?php
			}
			?>
	</select></td>
    </tr>
    <tr class="trselang">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="button2" id="button" value="Cari" class="tombol" /></td>
    </tr>
  </table>
</form>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br />
<div id="panel_tambah_user" style="display:none">
<form name="new" method="post">
<table cellpadding="2" cellspacing="2" border="0" class="tabel_pencarian" width="100%">
<tr class="trselang">
	<td>Username</td>
	<td>: <input type="text" id="username" width="10" name="username" value="<?=$row['USERNAME']?>"></td>
</tr>
<tr class="trseling">
	<td>Nama</td>
	<td>: <input type="text" width="10" id="nama" name="nama" value="<?=$row['NAMA']?>"></td>
</tr>
<tr class="trselang">
	<td>Status</td>
	<td>: 
	<select name="status_user" id="status_user">
	<option value="">Pilih</option>
          <?php
			$sqlr="SELECT STATUS_USER, KETERANGAN FROM t_status_user";
			print $sqlr;
			$rslist=mysql_query($sqlr) or die('Query failed: ' . mysql_error());
			while($rowlist=mysql_fetch_array($rslist)){
			?>
          <option value="<?=$rowlist['STATUS_USER'];?>" <?=$rowlist['STATUS_USER']==$row['STATUS_USER']?"selected":"";?>>
          <?=$rowlist['KETERANGAN'];?>
          </option>
          <?php
			}
			?>
	</select>
	</td>
</tr>
<tr class="trseling">
	<td>Password</td>
	<td>: <input type="password" id="password" width="10" name="password" value="<?=$row['PASSWORD']?>"></td>
</tr>
<tr class="trselang">
	<td>Status aktif </td>
	<td>: 
	  <select name="status_aktif" id="status_aktif">
        <option value="T" <? if($row['STATUS_AKTIF']=='T'){print "selected";}?>>Aktif</option>
	<option value="F" <? if($row['STATUS_AKTIF']=='F'){print "selected";}?>>Non-Aktif</option>
      </select></td>
</tr>
<tr class="trseling">
	<td>Sekolah</td>
	<td>:	  
	 <select name="id_instansi" id="id_instansi">
          <option value="">Pilih</option>
          <?php
			$sqlr="SELECT id_sekolah, nama_sekolah FROM t_info_sekolah";
			if($ids['ID_SEKOLAH']==1) {
			$sqlr.=" ";
			} else {
			$sqlr.=" WHERE id_sekolah='".$ids['ID_SEKOLAH']."' ORDER BY nama_sekolah ASC";
			}
			//print $sqlr;
			$rslist=mysql_query($sqlr) or die('Query failed: ' . mysql_error());
			while($rowlist=mysql_fetch_array($rslist)){
			?>
          <option value="<?=$rowlist['id_sekolah'];?>" <?=$rowlist['id_sekolah']==$id_instansi?"selected":"";?>>
          <?=$rowlist['nama_sekolah'];?>
          </option>
          <?php
			}
			?>
        </select></td>
</tr>
<tr class="trselang">
	<td>Yayasan</td>
	<td>:	  
	 <select name="id_yayasan" id="id_yayasan">
          <option value="">Pilih</option>
          <?php
			$sqlr="SELECT id, nama_yayasan FROM t_info_yayasan";
			//print $sqlr;
			$rslist=mysql_query($sqlr) or die('Query failed: ' . mysql_error());
			while($rowlist=mysql_fetch_array($rslist)){
			?>
          <option value="<?=$rowlist['id'];?>" <?=$rowlist['id']==$id_yayasan?"selected":"";?>>
          <?=$rowlist['nama_yayasan'];?>
          </option>
          <?php
			}
			?>
        </select></td>
</tr>
<tr class="trseling">
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="simpan" id="simpan_user" class="tombol" />
        <input name="button" type="button" id="batal_simpan" class="tombol" style="width:60px; " value="Cancel" /></td>
</tr>
</table><br />
<input type="hidden" width="10" name="task" value="<?=$task?>">
</form><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="tabel_pencarian">
  <tr>
  <td colspan="5" align="right"><a href="#" class="buka_panel_tambah_user"><strong>Tambah user</strong></a></td>
  </tr>
  <tr>
  <td colspan="6" class="headercontent">&nbsp;</td>
  </tr>
  <tr class="field2">
	<td width="124" align="center" class="kolom"><strong>USERNAME</strong></td>
	<td width="209" align="center" class="kolom"><strong>NAMA</strong></td>
	<td width="172" align="center" class="kolom"><strong>AKSI</strong></td>
	<td width="135" align="center" class="kolom"><strong>STATUS AKUN</strong> </td>
    <td width="100" align="center" class="kolom"><strong>STATUS AKTIF</strong> </td>
  </tr>
  <?php  
  $i=1;
  while($row=mysql_fetch_array($rs)){
  //if($row['status_user']==0){$status="Tidak Aktif";} else{$status="Aktif";}
  $class = ($i%2==0)?"trselang":"trseling";
  if(($row['USERNAME']==$_SESSION['username'])) {
  	print "";
  } else {
  	$sqlcek = "SELECT * FROM t_user WHERE USERNAME='".$_SESSION['username']."' AND (STATUS_USER=1 OR STATUS_USER=2 OR STATUS_USER=4)";
	if($ids['ID_SEKOLAH']==1) {
	$sqlcek.=" ";
	} else {
	$sqlcek.=" AND id_sekolah='".$ids['ID_SEKOLAH']."'";	
	}
	if($sekolah) {
	$sqlcek.=" AND id_sekolah='".$sekolah."'";
	}
	$sqlcek.=" ORDER BY USERNAME ASC";
	//echo $sqlcek;
	$rscek=mysql_query($sqlcek);
	$datacek=mysql_fetch_array($rscek);
  
  ?>
  <tr class="<?=$class;?>" onClick="if(this.style.backgroundColor==''){this.style.backgroundColor='#FFC6AA';}else{this.style.backgroundColor='';}" style="cursor:pointer; ">
	<td align="center" class="kolom"><?=strtoupper($row['USERNAME']);?></td>
	<td align="left" class="kolom"><?=strtoupper($row['NAMA']);?></td>
	<? if(($datacek['STATUS_USER']==2)) { print "<td align=center class=kolom>Panel ditutup</td>"; } else {?><td align="center" class="kolom"><a href="#" class="ubah_hak_akses" id="<?=$row['ID_USER']?>"><img src="images/menu_kecil/Green/pencil_16.png" width="18" height="18" border="0" /> Hak akses</a> | <a href="#" title="Ubah user" class="ubah_user" id="<?=$row['ID_USER']?>" name="<?=$row['USERNAME']?>"><img src="images/menu_kecil/Green/pencil_16.png" width="18" height="18" border="0" /> Ubah</a></td><? } ?>
	<td align="center" class="kolom"><?=  _getStatusUser($row['STATUS_USER'])?></td>
    <td align="center" class="kolom"><? if($row['STATUS_AKTIF']=="T") { print "AKTIF"; } else { print "NON-AKTIF"; }?></td>
  </tr>
  
  <?php
  $i++;} }
  ?>
  <tr>
  <td colspan="6" align="center" class="footercontent"><span class="updatescript">updatescript :
    <!-- #BeginDate format:Sw1a -->13 November, 2013 10:45 PM<!-- #EndDate -->
  </span></td>
  </tr>
</table>
<!-- End Table Data --></div>
<div id="add_user" style="display:none"></div>
<div id="ubah_user" style="display:none"></div>
