<? 

session_start();

if($_SESSION['username']!="") {
 
?>
<html>
<head>
<title>.: MPE PAUD :.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
body {
	background-color:#999 !important;
}
</style>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
 	<script src="src/bootstrap.js"></script>
    <script type="text/javascript" src="src/jquery.min.js"></script>
	<script type="text/javascript" src="src/jquery.easyui.min.js"></script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			color:#666;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
	</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (Untitled-1) -->
<table width="800" height="600" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="3">
			<img src="images/paud_01.png" width="800" height="4" alt=""></td>
	</tr>
	<tr>
		<td rowspan="5">
			<img src="images/paud_02.png" width="11" height="596" alt=""></td>
		<td>
			<img src="images/paud_03.png" width="776" height="138" alt=""></td>
		<td rowspan="5">
			<img src="images/paud_04.png" width="13" height="596" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/paud_05.png" width="776" height="46" alt=""></td>
	</tr>
	<tr>
		<td width="776" height="360" valign="top" style="background-color:#fff; background-attachment:fixed">
        <center>
          <h4>MFEP PAUD | Admin Panel</h4></center>
    <div style="margin:10px 0;"></div>
    <!--<div style="padding:5px;border:1px solid #ddd">
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm5',iconCls:'icon-edit'">Home</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-edit'">Data Paud</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm2',iconCls:'icon-edit'">Kelola Data Jarak</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm3',iconCls:'icon-edit'">Kelola Angkot</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm4',iconCls:'icon-edit'">Perhitungan MFEP</a>
        <a href="index.php" target="_blank" class="easyui-linkbutton" data-options="plain:true">Map</a>
        <a href="logout.php" class="easyui-linkbutton" data-options="plain:true">Logout</a>
    </div>
    <div id="mm1" style="width:150px;">
        <div data-options="iconCls:'icon-user'"><a href="?module=module/paud/index.php">Input Data Paud</a></div>
        <div data-options="iconCls:'icon-customers'"><a href="?module=module/pegawai/index.php">Input Data Guru</a></div>
        <div data-options="iconCls:'icon-comm'"><a href="?module=module/fasilitas/index.php">Input Data Fasilitas</a></div>
    </div>
    <div id="mm2" style="width:150px;">
        <div data-options="iconCls:'icon-user'"><a href="?module=module/jarak/index.php">Kelola Data Jarak</a></div>
    </div>
    <div id="mm3" style="width:150px;">
        <div data-options="iconCls:'icon-user'"><a href="?module=module/angkot/index.php">Kelola Jalur Angkot</a></div>
    </div>
    <div id="mm4" style="width:150px;">
        <div data-options="iconCls:'icon-user'"><a href="?module=module/meep/index.php">Perhitungan MEEP</a></div>
    </div>
    <div id="mm5" style="width:150px;">
        <div data-options="plain:true"><a href="home.php">Home</a></div>
        <div data-options="iconCls:'icon-user'"><a href="?module=ubah_password.php">Ubah Password</a></div>
    </div>-->
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
            <a class="navbar-brand" href="#" id="tombol">Pencarian PAUD</a>
            <a class="navbar-brand" href="?module=login.php">Login</a>
          </div>
        </div><!--/.container-fluid -->
      </div>
    <br />
<div class="main_content">
<? $module = $_REQUEST['module'];
		
		if($module) {
			require ($module);
		} else { ?>
	
<div id="p" class="easyui-panel" title="Beranda" style="padding:10px;">
<div align="center" style="width:200px; position:absolute; border:0px solid #000;"></div>
        <p style="font-size:20px" align="left">MPE PAUD<br /><small><strong>APLIKASI PENCARIAN PAUD TERDEKAT</strong></small></p>
        
  </div>
		
		<?
        }
		
		?>
</div>
        </td>
	</tr>
	<tr>
		<td width="776" height="37" align="center" background="images/paud_07.png" >
		2014 - Sistem Penentuan Pencarian Paud 
        </td>
	</tr>
	<tr>
		<td>
			<img src="images/paud_08.png" width="776" height="15" alt=""></td>
	</tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>
<? } else {
	echo "<script>location.href='login.php';</script>";	
} ?>