<? 

session_start();

if($_SESSION['username']!="") {
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>.: MFEP PAUD :.</title>

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">MFEP PAUD Kota Cimahi</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="#">Beranda</a></li>
          </ul>
          <ul class="nav nav-sidebar">
  			<li class="dropdown">
    		<a class="dropdown-toggle" style="margin-top:-20px; margin-bottom:-25px;" data-toggle="dropdown" href="#">
      		Data Paud <span class="caret"></span>
    		</a>
    			<ul class="dropdown-menu" role="menu" style="margin-left:20px">
    				<li><a href="?module=module/paud/index.php">Kelola Data PAUD</a></li>
            		<li><a href="">Kelola Data Guru</a></li>
                    <li><a href="">Kelola Data Fasilitas</a></li>
            	</ul>
  			</li>
		  </ul>
          <ul class="nav nav-sidebar">
            <li><a href="#">Kelola Data Angkot</a></li>
            <li><a href="#">Kelola Data Jarak</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <? $module = $_REQUEST['module'];
		
		if($module) {
			require ($module);
		} else { ?>
          <h1 class="page-header">Panel Admin</h1>
          <div class="container" style="max-width:1000px !important; padding:0px !important; margin-left:0px; margin-right:0px;">
          
      		<div class="jumbotron">
        		<h1>MFEP PAUD Kota Cimahi</h1>
        		<p>Sistem ini Memberikan rekomendasi, PAUD Formal (Taman Kanak – kanak dan Raudhathul Atfal) kepada Pencari PAUD Formal  yang ada di kota cimahi.</p>
      		</div>
        <? } ?>    
    	  </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="src/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
  </body>
</html>
<? } else {
	echo "<script>location.href='login.php';</script>";	
} ?>