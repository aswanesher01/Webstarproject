<style type="text/css">
pre	{
	color: brown;
}
table.menu	{
	position: absolute;
	border: 1px solid #CCCCCC;
	cursor: pointer;
	cursor: hand;
	visibility:hidden;
	width:150;
	height:25;
	z-index:100;
}
#mainmenu	{
	position:static;
}
table.menu td	{
	color: #666666;            /* Must be the same as tdColor in the 1dynamicScript.js */
	background-color: #FFFFFF; /* Must be the same as tdBgColor in the 1dynamicScript.js */
	border: 0px;
	padding: 0px 8px 2px;
	font-family: Arial;
	font-size: 12;
	font-weight:bolder;
	white-space: nowrap;
	filter: Alpha(Opacity=90, FinishOpacity=0, Style=4, StartX=0, StartY=0, FinishX=50, FinishY=50);
	opacity:0.9;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
    font-size: 11px;

}
#Layer1 {
	position:absolute;
	width:738px;
	height:25px;
	z-index:1;
}
</style>
<?php
include("inc/inc_config.php");
//include("inc/cek_login.php");

//$username = $_SESSION['username'];
$sql="SELECT u.id_menu,u.id_menu_tree,m.url,m.nama FROM t_menu m ,t_user_menu u WHERE u.id_menu=m.id_menu AND u.id_menu_tree=m.id_menu_tree AND lower(u.username) = lower('".$_SESSION['username']."') ORDER BY u.id_menu,u.id_menu_tree ASC";
//print $sql;
$rs = mysql_query($sql);

$row=mysql_fetch_array($rs);
?>
<script language="JavaScript">
<?php
$i=0;
$j=1;
do{
	if($row['id_menu_tree']!=0){
		echo "//========================\r";
		if($row['id_menu']==$k){
			echo "td_".$i."_".$j."=\"".$row['nama']."\";\r";
			if($row['url']){
				echo "url_".$i."_".$j."=\"".$row['url']."\";\r";
			}
			$j++;
		}		
	}else{
		$i++;
		$j=1;
		$k = $row['id_menu'];
		echo "td_".$i."=\"".$row['nama']."&nbsp;\";\r";
		
	}	
}while($row=mysql_fetch_assoc($rs));
/*if($_SESSION['username']=="admin"){
	$i++;
	echo "td_".$i."=\"Manage Menu &nbsp;\";\r";
	echo "//========================\r";
	echo "td_".$i."_1=\"Manage Menu &nbsp;\";\r";
	echo "url_".$i."_1=\"?module=module/manage menu/manage.php\";\r";
}*/
$i++;
echo "td_".$i."=\"KELUAR APLIKASI &nbsp;\";\r";
echo "url_".$i."=\"logout.php\";\r";
?>
//========================
</script>

<div id="Layer1" style="position:relative;">
<script language="javascript" src="mymenu.js"></script></div>
