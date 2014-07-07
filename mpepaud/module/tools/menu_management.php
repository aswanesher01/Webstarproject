<?php

session_start();

?>
<?php
$cek_ids="SELECT * FROM t_user WHERE username='".$_SESSION['username']."' ";
$rs_ids=mysql_query($cek_ids) or die ("Kesalahan sistem, akan segera kami perbaiki");
$ids=mysql_fetch_array($rs_ids);
//print $ids['lvl'];

$sql ="SELECT id_menu , id_menu_tree , nama , url FROM t_menu where true";
if($ids['lvl']=1) {
$sql.=" and kd_permission=1";
}
$sql.=" ORDER BY id_menu , id_menu_tree";
		//print $sql;
$rs  = mysql_query($sql, $koneksi);
?>
<!--<script type="text/javascript" src="js/ajax_proses.js"></script>-->
<script>
/////////////////// FUNGSI MENU (TAMBAH. EDIT, HAPUS) ///////////////

////// munculkan panel tambah menu ///////////
$(document).ready(function() {
	$(".tambah_menu").click(function() {
		$(".panel_tambah_menu").toggle();	
	});	
});

///// aksi tambahkan menu ke db ///////////////
$(document).ready(function() {
	$("#post_menu").click(function() {
		var id_menu			= $("#id_menu").val();
		var id_menu_tree	= $("#id_menu_tree").val();	
		var nama			= $("#nama").val();
		var url				= $("#url").val();
		var kd_permission	= $("#kd_permission").val();
	
		var datana='id_menu='+id_menu+'&id_menu_tree='+id_menu_tree+'&nama='+nama+'&url='+url+'&kd_permission='+kd_permission;
		
		$.ajax({
			type:"POST",
			url:"module/tools/proses_tambah_menu.php",
			data:datana,
			success:function(respon) {
				if(respon=='2') {
					alert("Maaf, input data gagal");
				} else if(respon=='1') {
					alert("Menu baru telah ditambahkan.");
					var htmlna =
					"<td align='left' class='kolom'>"+id_menu+"</td>"+
					"<td class='kolom' align='left'>"+id_menu_tree+"</td>"+
					"<td class='kolom' align='left'>"+nama+"</td>"+
					"<td class='kolom' align='left'>"+url+"</td>"+
					"<td class='kolom' align='center'><a href='#'><img src='images/menu_kecil/Green/up_16.png' border='0' /></a></td>"+
					"<td class='kolom' align='center'><a href='#'><img src='images/menu_kecil/Green/down_16.png' border='0' /></a></td>"+
					"<td class='kolom' align='center'><a href='#' class='tampil' title="+url+"><img src='images/menu_kecil/Green/search_16.png' width='18' height='18' border='0' /></a></td>"+
					"<td class='kolom' align='center'><a href='#' class='ubah_menu'><img src='images/menu_kecil/Green/pencil_16.png' width='18' height='18' border='0' title='Ubah tahun ajaran' /></a></td>"+
					"<td class='kolom' align='center'><a href='#' class='hapus_menu'><img src='images/menu_kecil/Green/trash_16.png' width='18' height='18' border='0' title='Hapus tahun ajaran' /></a></td>";
					$("#baris_data_baru").html(htmlna);
				}	
			}	
		});
		
		return false;
	});	
});

////////////////// UBAH POSISI MENU KE ATAS ///////////////////////
$(document).ready(function() {
	$(".up").click(function() {
		var idmenu		= $(this).attr("id");
		var idtree		= $(this).attr("name");
		
		var datana='idmenu='+idmenu+'&idtree='+idtree;
		
		$.ajax({
			type:"POST",
			url:"module/tools/ubah_posisi_menu.php",
			data:datana,
			success:function() {
				alert("Posisi pindah ke atas,Silahkan refresh halaman");
			}
		});
	return false;
	});
});

////////////////// UBAH POSISI MENU KE BAWAH ///////////////////////
$(document).ready(function() {
	$(".bawah").click(function() {
		var idmenu		= $(this).attr("id");
		var idtree		= $(this).attr("name");
		
		var datana='idmenu='+idmenu+'&idtree='+idtree;
		
		$.ajax({
			type:"POST",
			url:"module/tools/ubah_posisi_menu_bawah.php",
			data:datana,
			success:function() {
				alert("Posisi pindah ke bawah,Silahkan refresh halaman");
			}
		});
	return false;
	});
});

/////////////////// HAPUS MENU ///////////////////////////////////

$(document).ready(function() {
	$(".hapus_menu").click(function() {
		var urut		 = $(this).attr("title");
		var id_menu		 = $(this).attr("id");
		var id_menu_tree = $(this).attr("name");
		
		var datana='id_menu='+id_menu+'&id_menu_tree='+id_menu_tree;
		//alert (datana);
		
		if(confirm("Apa anda yakin akan menghapus menu ini?")) {
		
		$.ajax({
				type:"POST",
				url:"module/tools/proses_hapus_menu.php",
				data:datana,
				success:function(respon) {
					if(respon=='2') {
						alert("Hapus menu gagal");	
					} else if(respon=='1') {
						alert("Hapus menu berhasil");
						$("#"+urut).hide();
					}	
				}
			});
		} else {
			alert("Hapus menu dibatalkan");	
		}
			
		return false;	
	});
});

////////////////// TAMPILKAN HALAMAN DI PENGATURAN MENU /////////////
$(function () {
	$(".tampil").click(function() {
	var id = $(this).attr("id");
	//var tujuan = $(this).attr("name");
	var tujuan = $(this).attr("title");
		$(".msg_body2").fadeIn(400).html('<img src="images/loading.gif" 		align="absmiddle"> Ambil halaman, silahkan tunggu.....');
		$("#text").hide();
		$(".tampil_rekap").hide();
		$("#content").show();
		$(".msg_body2").load(tujuan);
	});
});

/////////////////// EDIT MENU ///////////////////////////////////

////////////////////////////////// UBAH DATA NILAI //////////////////////////////////////////////////////////

$(document).ready(function(){
	$(".baris_data2").click(function() {
		var id = $(this).attr("id");
		
		$("#id_menu_"+id).hide();
		$("#id_tree_"+id).hide();
		$("#nama_"+id).hide();
		$("#url_"+id).hide();
		
		$("#menu_edit_"+id).show();
		$("#menu_tree_edit_"+id).show();
		$("#nama_edit_"+id).show();
		$("#url_edit_"+id).show();
		
	}).change(function(ubah_menu) {
		var id	= $(this).attr("id");
		var id_menu = $("#menu_edit_"+id).val();
		var id_menu_tree = $("#menu_tree_edit_"+id).val();
		var nama_menu = $("#nama_edit_"+id).val();
		var url = $("#url_edit_"+id).val();
		
		var datanas = 'id_menu='+id_menu+'&id_menu_tree='+id_menu_tree+'&nama_menu='+nama_menu+'&url='+url;
		//alert (datanas);
		
		$.ajax({
			type:"POST",
			url:"module/tools/proses_ubah_menu.php",
			data:datanas,
			success:function(ubah_menu) {
				if(ubah_menu=='2') {
					alert ("Ubah menu gagal");
				} else if(ubah_menu=='1') {
					alert("Data menu berhasil diubah");
					$("#id_menu_"+id).html(id_menu);
					$("#id_tree_"+id).html(id_menu_tree);
					$("#nama_"+id).html(nama_menu);
					$("#url_"+id).html(url);
					ubah_menu.stopImmediatePropagation();
				}
			}
		});
	});	
});

$(".edits").live("mouseup",function(ubah_menu) {
	ubah_menu.stopImmediatePropagation();
});

$(document).mouseup(function(){
	$(".edits").hide();
	$(".isi_menu").show();
});
</script>
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
<div class="header_input" align="center"><strong>PENGATURAN MENU</strong></div>
<div class="panel_tambah_menu" style="display:none">
<form method="post">
<table cellpadding="2" cellspacing="0" border="0" width="100%">
<tr>
<td colspan="3" class="headercontent"></td>
</tr>
<tr class="trselang">
	<td width="199">ID Menu</td>
	<td width="723">: 
	  <input type="text" width="10" name="id_menu" id="id_menu" value="<?=$menu?>" <? if($act=="edit"){print("readonly='1'");}?>></td>
</tr>
<tr class="trseling">
	<td>ID Menu Tree</td>
	<td>: <input type="text" width="10" name="id_menu_tree" id="id_menu_tree" value="<?=$tree?>" <? if($act=="edit"){print("readonly='1'");}?>></td>
</tr>
<tr class="trselang">
	<td>Nama</td>
	<td>: <input name="nama" type="text" id="nama" value="<?=$row['nama']?>" size="50" width="10"></td>
</tr>
<tr class="trseling">
	<td>URL</td>
	<td>: <input name="url" type="text" id="url" value="<?=$row['url']?>" size="50" width="10"></td>
</tr>
<tr class="trselang">
	<td>Permission</td>
	<td>: 
	  <select name="kd_permission" id="kd_permission">
	  <option></option>
	  <option value="0" <?=($row['kd_permission']==0)?"selected":"";?>>Admin only</option>
	  <option value="1" <?=($row['kd_permission']==1)?"selected":"";?>>All user</option>
	    </select>
	  </td>
</tr>
<tr class="trseling">
	<td align="center">&nbsp;</td>
    <td align="left">&nbsp;&nbsp;<input name="new" type="submit" class="tombol" value="Tambah" id="post_menu"  />
&nbsp;
<input name="button" type="button" class="tombol" value="Batal" /></td>
</tr>
<tr>
<td colspan="3" class="footercontent"></td>
</tr>
</table>
</form>
</div>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="tabel_pencarian">
<tr>
<td colspan="9" align="right" valign="middle" class="headercontent">&nbsp;</td>
</tr>
<tr>
  <td colspan="6" align="left" valign="middle" class="field2">&nbsp;</td>
  <td colspan="3" align="right" valign="middle" class="field2"><? if($ids['lvl']!=1) { print ""; } else { ?><a href="#" class="tambah_menu"><strong>Tambah Menu</strong></a>    <? } ?></td>
  </tr>
  <tr class="field2">
    <th rowspan="2" class="kolom">Id menu </th>
    <th rowspan="2" class="kolom">Id sub menu</th>
    <th rowspan="2" class="kolom">Nama</th>
    <th rowspan="2" class="kolom">Alamat</th>
    <? if($ids['lvl']!=1) { print ""; } else { ?>
    <th colspan="2" class="kolom">Ubah posisi</th><? } ?>
   <? if($ids['lvl']!=1) { print ""; } else { ?> <th rowspan="2" class="kolom">Tampilkan</th><? } ?>
    <? if($ids['lvl']!=1) { print ""; } else { ?><th rowspan="2" class="kolom">Ubah</th>
    <th rowspan="2" class="kolom">Hapus</th><? } ?>
  </tr>
  <tr class="field2">
    <? if($ids['lvl']!=1) { print ""; } else { ?><th class="kolom">Atas</th>
    <th class="kolom">Bawah</th><? } ?>
  </tr>
  <?php
    $i=0;
	while($row=mysql_fetch_array($rs)){
    if($row['id_menu_tree']==0){$i++;}
	$class = ($i%2==0)?"trselang":"trseling";	
	$urut++;
  ?>
  <tr class="baris_data2" id="<?=$urut?>" onClick="if(this.style.backgroundColor==''){this.style.backgroundColor='#FFC6AA';}else{this.style.backgroundColor='';}" style="cursor:pointer; <?=$row['id_menu_tree']==0?"font-weight:bold;background-color:#FFC6AA;":"";?>">
    <td class="kolom"><span id="id_menu_<?=$urut?>" class="isi_menu"><?=$row['id_menu'];?></span><input type="text" readonly id="menu_edit_<?=$urut?>" class="edits" style="display:none" size="5" value="<?=$row['id_menu']?>"/></td>
    <td class="kolom"><span id="id_tree_<?=$urut?>" class="isi_menu"><?=$row['id_menu_tree'];?></span><input type="text" readonly id="menu_tree_edit_<?=$urut?>" class="edits" style="display:none" size="5" value="<?=$row['id_menu_tree']?>"/></td>
    <td class="kolom"><span id="nama_<?=$urut?>" class="isi_menu"><?=$row['nama'];?></span><input type="text" id="nama_edit_<?=$urut?>" class="edits" style="display:none" size="40" value="<?=$row['nama']?>"/></td>
    <td class="kolom"><? if($ids['lvl']!=1) { print "Alamat disembunyikan karena alasan keamanan"; } else { ?><span id="url_<?=$urut?>" class="isi_menu"><?=$row['url'];?></span><input type="text" id="url_edit_<?=$urut?>" class="edits" style="display:none" size="40" value="<?=$row['url']?>"/><? } ?></td>
    <?php 
	if($row['id_menu_tree']>0){
	?>
	<td align="center" class="kolom">
	<?php
	if($row['id_menu_tree']>101){
	?>
	<? if($ids['lvl']!=1) { print ""; } else { ?><a href="#" class="up" title="<?=$urut;?>" id="<?=$row['id_menu']?>" name="<?=$row['id_menu_tree']?>"><img src="images/menu_kecil/Green/up_16.png" border="0" /></a><? } ?>
	<?php
	}
	?>	</td>
    <td align="center" class="kolom"><? if($ids['lvl']!=1) { print ""; } else { ?><a href="#" class="bawah" title="<?=$urut;?>" id="<?=$row['id_menu']?>" name="<?=$row['id_menu_tree']?>"><img src="images/menu_kecil/Green/down_16.png" border="0" /></a><? } ?></td>
	<td align="center" class="kolom"><? if($ids['lvl']!=1) { print ""; } else { ?><a href="#" class="up" title="<?=$urut;?>" id="<?=$row['id_menu']?>" name="<?=$row['id_menu_tree']?>"></a><a href="#" class="tampil" title="<?=$row['url']?>"><img src="images/menu_kecil/Green/search_16.png" width="18" height="18" border="0" /></a><? } ?></td>
	<td align="center" class="kolom"><? if($ids['lvl']!=1) { print ""; } else { ?><a href="#" class="edit_menu" id="<?=$row['id_menu']?>" name="<?=$row['id_menu_tree']?>" title="<?=$urut?>"><img src="images/menu_kecil/Green/pencil_16.png" width="18" height="18" border="0" /></a><? } ?></td>
	<td align="center" class="kolom"><? if($ids['lvl']!=1) { print ""; } else { ?><a href="#" class="hapus_menu" id="<?=$row['id_menu']?>" name="<?=$row['id_menu_tree']?>" title="<?=$urut?>"><img src="images/menu_kecil/Green/trash_16.png" width="18" height="18" border="0" /></a><? } ?></td>
	<?php
	}else{
	echo '<td colspan="3" class="kolom">&nbsp;</td>';
	if($ids['lvl']!=1) { print "<td align=center colspan=2></td>"; } else { 
	echo '<td align="center" class="kolom"><a href=\'?modulee='.$modulee.'&act=edit&idmenu='.$row['id_menu'].'&idtree='.$row['id_menu_tree'].'\'><img src="images/menu_kecil/Green/pencil_16.png" width="18" height="18" border="0" /></a></td>';
	echo '<td align="center" class="kolom"><a href="#"><img src="images/menu_kecil/Green/trash_16.png" width="18" height="18" border="0" /></a></td>';
	}
	}
	?>  
  </tr>
  
  <?php
  }
  ?>
  <tr id="baris_data_baru" style="background-color:yellow;"></tr>
  <tr>
  <td colspan="9" class="footercontent"><div style="
    padding:10px;
	background:#CFE8F1;
	-moz-border-radius: 5px;
	border-radius: 5px;
	position:relative;
	left:50%;
	margin-left:-420px;
	width:830px;
	border:1px #CCCCCC solid;" align="center">updatescript :
    <!-- #BeginDate format:Sw1a -->9 November, 2013 9:26 PM<!-- #EndDate -->
  </div></td>
  </tr>
</table>