<? 
include "../../inc/inc_config.php";

session_start();

$id_menu			= $_REQUEST['id_menu'];
$id_menu_tree			= $_REQUEST['id_menu_tree'];
$nama		= $_REQUEST['nama_menu'];
$url		= $_REQUEST['url'];

$cek_ids="SELECT ID_SEKOLAH FROM t_user WHERE USERNAME='".$_SESSION['username']."'";
//print $cek_ids;
$rs_ids=mysql_query($cek_ids,$koneksi) or die ("Kesalahan sistem, akan segera kami perbaiki");
$ids=mysql_fetch_array($rs_ids);
//print $ids['ID_SEKOLAH'];

$sql="UPDATE t_menu SET URL='".$url."', NAMA='$nama' 
where ID_MENU='".$id_menu."' and ID_MENU_TREE='".$id_menu_tree."'";
$rs=mysql_query($sql);
//print $sql;
if($rs) {
		echo 1;
	} else {
		echo 2;
	}

?>