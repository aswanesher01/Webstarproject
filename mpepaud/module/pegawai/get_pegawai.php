<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();
	$idgur	= $_REQUEST['idgur'];
	$pendidikans	= $_REQUEST['pendidikans'];
    $pauds  = $_REQUEST['pauds'];

	include '../../inc/conn.php';
	
	$rs = mysql_query("select count(*) from pend_guru");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	if($idgur!="") {
		$where.= " and Id_guru='$nips'";
	}
	if($pendidikans!="") {
		$where.= " and Pendidikan='$pendidikans'";
	}
    if($pauds!="") {
        $where.=" and pend_guru.id_paud='$pauds'";
    }
	$sql="select pend_guru.*, data_paud.nama_paud from pend_guru, data_paud where pend_guru.id_paud=data_paud.id_paud $where limit $offset,$rows";
	//echo $sql;
    $rs = mysql_query($sql);
	while($data=mysql_fetch_array($rs)) {
	//$items = array();
	
	if($data['Pendidikan']=='S1') {
		$pend="SARJANA";	
	} else if($data['Pendidikan']=='D3') {
		$pend="DIPLOMA";	
	} else if($data['Pendidikan']=='SMA') {
		$pend="SMA";	
	}
	
	$items[] = array(
		'Id_guru' => $data['Id_guru'],
		'Nama_Guru' => $data['Nama_Guru'],
		'Pendidikan' => $pend,
		'id_paud' => $data['id_paud'],
		'nama_paud' => $data['nama_paud']
	);
	}
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
	
?>