<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();
    
    $rute   = $_REQUEST['rute'];

	include '../../inc/conn.php';
	
	$rs = mysql_query("select count(*) from angkot");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
    
    if($rute!="") {
        $where.=" where rute like '%$rute%'";
    }
    
	$rs = mysql_query("select * from angkot $where limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>