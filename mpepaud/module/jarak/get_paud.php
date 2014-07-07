<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$idpaud = $_REQUEST['idpaud'];
	$long = $_REQUEST['longs'];
	$lat = $_REQUEST['lats'];
	$result = array();

	include '../../inc/conn.php';
	
	$rs = mysql_query("select count(*) from data_paud");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	if($idpaud!="") {
		$where.= " and id_paud='$idpaud'";
	}
	if($long!="") {
		$where.= " and longitude='$long'";
	}
	if($lat!="") {
		$where.= " and Latitude='$lat'";
	}
	$sqln="select id_paud, nama_paud, Latitude, longitude, jarak from data_paud where true $where limit $offset,$rows";
	//echo $sqln;
	$rs = mysql_query($sqln);
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>