<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$idpaud = $_REQUEST['idpaud'];
	$nmpaud = $_REQUEST['nmpaud'];
	$lat = $_REQUEST['lats'];
	$result = array();

	include '../../inc/conn.php';
	
	$rs = mysql_query("select count(*) from data_paud");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	if($idpaud!="") {
		$where.= " and t_nilai_paud.id_paud='$idpaud'";
	}
	if($nmpaud!="") {
		$where.= " and data_paud.nama_paud like '$nmpaud%'";
	}
	$sqln="select data_paud.nama_paud, t_nilai_paud.* from t_nilai_paud, data_paud where data_paud.id_paud=t_nilai_paud.id_paud $where limit $offset,$rows";
	//echo $sqln;
	$rs = mysql_query($sqln);
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>