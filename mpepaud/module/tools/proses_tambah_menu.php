<? 
include "../../inc/inc_config.php";

session_start();

$sql = "INSERT INTO t_menu (id_menu,id_menu_tree,url,nama,kd_permission) 
VALUES ('".$_POST['id_menu']."','".$_POST['id_menu_tree']."','".$_POST['url']."','".$_POST['nama']."', '".$_POST['kd_permission']."')";
//echo $sql;
$rs  = mysql_query($sql);
if($rs) {
		echo "1";
	} else {
		echo "2";	
	}

?>