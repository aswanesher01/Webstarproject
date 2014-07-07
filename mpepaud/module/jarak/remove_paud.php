<?php

$id = intval($_REQUEST['id']);

include '../../inc/conn.php';

$sql = "delete from data_paud where id_paud=$id";
$result = @mysql_query($sql);

$delnilai=mysql_query("delete from t_nilai_paud where id_paud='$id'");
$delfas=mysql_query("delete from fasilitas where id_paud='$id'");
$delgur=mysql_query("delete from pend_guru where id_paud='$id'");

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>