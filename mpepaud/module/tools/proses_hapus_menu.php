<? 
include "../../inc/inc_config.php";

$id_menu		= $_REQUEST['id_menu'];
$id_menu_tree	= $_REQUEST['id_menu_tree'];

$sql2="delete from t_menu where id_menu='".$id_menu."' and id_menu_tree='".$id_menu_tree."'";
$rs2=mysql_query($sql2, $koneksi);
if($rs2) {
		echo "1";
	} else {
		echo "2";
	}

?>