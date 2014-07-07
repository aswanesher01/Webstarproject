<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$paud = $_REQUEST['paud'];
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../inc/conn.php';
	
	$rs = mysql_query("select count(*) from fasilitas");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	if($paud!="") {
		$where = "where id_paud='$paud'";
	}
    
	$sql = "select * from fasilitas ".$where." limit $offset,$rows";
	$rs=mysql_query($sql);

	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
?>