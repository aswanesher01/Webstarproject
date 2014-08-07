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
	<script src="src/jquery.min.js"></script>
    <style>

#lihat_fasilitas {
	width: 700px;
padding: 5px;
background-color: #ccc;
display:none;
}

#utama {
	padding-left:40px;
	padding-right:40px;
	padding-top:20px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:19px;
	text-align:justify;	
}

#pencarian {
	display:none;	
}


/*.tombol {
   border-top: 1px solid #96d1f8;
   background: #65a9d7;
   background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
   background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
   background: -moz-linear-gradient(top, #3e779d, #65a9d7);
   background: -ms-linear-gradient(top, #3e779d, #65a9d7);
   background: -o-linear-gradient(top, #3e779d, #65a9d7);
   padding: 10.5px 21px;
   -webkit-border-radius: 18px;
   -moz-border-radius: 18px;
   border-radius: 18px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 22px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   cursor:pointer;
   }
.tombol:hover {
   border-top-color: #28597a;
   background: #28597a;
   color: #ccc;
   }
.tombol:active {
   border-top-color: #1b435e;
   background: #1b435e;
   }*/

.banner {
		background-image:url(img/Graphic1.jpg);
		height:150px;
		margin:0px;
	}
	
.text_banner {
		position: absolute;
top: 75px;
right: 0px;
margin-right: 50px;
margin-left: 50px;
font-size: 20px;
color: white;
	}

.btnfas {
	color: #fff;
background-color: #428bca;
border-color: #357ebd;
display: inline-block;
margin-bottom: 0;
font-weight: 400;
text-align: center;
vertical-align: middle;
cursor: pointer;
background-image: none;
border: 1px solid transparent;
white-space: nowrap;
padding: 6px 12px;
font-size: 14px;
line-height: 1.42857143;
border-radius: 4px;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}
</style>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA-Gq6foPILnL0gXPtmTcxLhSBazU3GxiNq3dXpyGawPD_3H4NXhQMHnjSg_ozuAgR-VQXc2l8okmegQ" type="text/javascript"></script>
    <script type="text/javascript">

	$(document).ready(function() {
	$(".header").hide();	
	$("#lihat_fasilitas").hide();
	$("#pencarian").show();
	
	$("#tombol").click(function() {
		$("#pencarian").show();	
		$("#utama").hide();	
	});
	
	$("#showfas").click(function() {
		$("#pilihanfas").show();		
	});

	$("#submit").click(function() {
    	$(".header").show();
		$(".bobot_nilai").show();
	});

	
});

//<![CDATA[
var map;
var geocoder;

function load() {
       if (GBrowserIsCompatible()) {
        geocoder = new GClientGeocoder();
         map = new GMap2(document.getElementById('map'));
         map.addControl(new GSmallMapControl());
         map.addControl(new GMapTypeControl());
         map.setCenter(new GLatLng(-0.7892750, 113.9213270), 4);
       }
     }
  
    function searchLocations() {
      var address = document.getElementById('addressInput').value;
	  var jensek = document.getElementById('jenis_sekolah').value;
      var uang_spp = document.getElementById('uang_spp').value;
      var uang_pangkal = document.getElementById('uang_pangkal').value;
      //var jmlfasilitas = document.getElementById('jmlfasilitas').value;
      var pendidikanguru = document.getElementById('pendidikanguru').value;
	 
	  if (document.getElementById('cb1').checked) {
            var cb1 = document.getElementById('cb1').value;
	  } else {
		    var cb1 = "";
	  }
	  if (document.getElementById('cb2').checked) {
	  		var cb2 = document.getElementById('cb2').value;
	  } else {
		    var cb2 = "";
	  }
	  if (document.getElementById('cb3').checked) {
	  		var cb3 = document.getElementById('cb3').value;
	  } else {
		    var cb3 = "";
	  }
	  if (document.getElementById('cb4').checked) {
	  		var cb4 = document.getElementById('cb4').value;
	  } else {
		    var cb4 = "";
	  }
	  if (document.getElementById('cb5').checked) {
	  		var cb5 = document.getElementById('cb5').value;
	  } else {
		    var cb5 = "";
	  }
	  if (document.getElementById('cb6').checked) {
	  		var cb6 = document.getElementById('cb6').value;
	  } else {
		    var cb6 = "";
	  }
	  if (document.getElementById('cb7').checked) {
	  		var cb7 = document.getElementById('cb7').value;
	  } else {
		    var cb7 = "";
	  }
	  if (document.getElementById('cb8').checked) {
	  		var cb8 = document.getElementById('cb8').value;
	  } else {
		    var cb8 = "";
	  }
	  if (document.getElementById('cb9').checked) {
	  		var cb9 = document.getElementById('cb9').value;
	  } else {
		    var cb9 = "";
	  }
	  if (document.getElementById('cb10').checked) {
	  		var cb10 = document.getElementById('cb10').value;
	  } else {
		    var cb10 = "";
	  }
	  if (document.getElementById('cb11').checked) {
	  		var cb11 = document.getElementById('cb11').value;
	  } else {
		    var cb11 = "";
	  }
	  if (document.getElementById('cb12').checked) {
	  		var cb12 = document.getElementById('cb12').value;
	  } else {
		    var cb12 = "";
	  }
	  if (document.getElementById('cb13').checked) {
	  		var cb13 = document.getElementById('cb13').value;
	  } else {
		    var cb13 = "";
	  }
	  if (document.getElementById('cb14').checked) {
	  		var cb14 = document.getElementById('cb14').value;
	  } else {
		    var cb14 = "";
	  }
	  if (document.getElementById('cb15').checked) {
	  		var cb15 = document.getElementById('cb15').value;
	  } else {
		    var cb15 = "";
	  }
	  if (document.getElementById('cb16').checked) {
	  		var cb16 = document.getElementById('cb16').value;
	  } else {
		    var cb16 = "";
	  }
	  if (document.getElementById('cb17').checked) {
	  		var cb17 = document.getElementById('cb17').value;
	  } else {
		    var cb17 = "";
	  }
	  if (document.getElementById('cb18').checked) {
	  		var cb18 = document.getElementById('cb18').value;
	  } else {
		    var cb18 = "";
	  }
	  if (document.getElementById('cb19').checked) {
	  		var cb19 = document.getElementById('cb19').value;
	  } else {
		    var cb19 = "";
	  }
	  if (document.getElementById('cb20').checked) {
	  		var cb20 = document.getElementById('cb20').value;
	  } else {
		    var cb20 = "";
	  }
	  if (document.getElementById('cb21').checked) {
	  		var cb21 = document.getElementById('cb21').value;
	  } else {
		    var cb21 = "";
	  }
	  
	  var data='&cb1='+cb1+'&cb2='+cb2+'&cb3='+cb3+'&cb4='+cb4+'&cb5='+cb5+'&cb6='+cb6+'&cb7='+cb7+'&cb8='+cb8+'&cb9='+cb9+'&cb10='+cb10+'&cb11='+cb11+'&cb12='+cb12+'&cb13='+cb13+'&cb14='+cb14+'&cb15='+cb15+'&cb16='+cb16+'&cb17='+cb17+'&cb18='+cb18+'&cb19='+cb19+'&cb20='+cb20+'&cb21='+cb21
	  
	  	if((jensek=='')||(uang_spp=='')||(uang_spp=='')||(uang_pangkal=='')/*||(jmlfasilitas=='')*/||(pendidikanguru=='')||(data=='')) {
		  	alert('Silahkan isi semua kolom pencarian');
		} else {
	  
      	geocoder.getLatLng(address, function(latlng) {
        	if (!latlng) {
          		alert(address + ' not found');
        	} else {
          		searchLocationsNear(latlng);
        	}
      	});
		}
    }
  
    function searchLocationsNear(center) {
	  var address = document.getElementById('addressInput').value;
      var radius = document.getElementById('radiusSelect').value;
      var jensek = document.getElementById('jenis_sekolah').value;
      var uang_spp = document.getElementById('uang_spp').value;
      var uang_pangkal = document.getElementById('uang_pangkal').value;
      //var jmlfasilitas = document.getElementById('jmlfasilitas').value;
      var pendidikanguru = document.getElementById('pendidikanguru').value;
	  
	  if (document.getElementById('cb1').checked) {
            var cb1 = document.getElementById('cb1').value;
	  } else {
		    var cb1 = "";
	  }
	  if (document.getElementById('cb2').checked) {
	  		var cb2 = document.getElementById('cb2').value;
	  } else {
		    var cb2 = "";
	  }
	  if (document.getElementById('cb3').checked) {
	  		var cb3 = document.getElementById('cb3').value;
	  } else {
		    var cb3 = "";
	  }
	  if (document.getElementById('cb4').checked) {
	  		var cb4 = document.getElementById('cb4').value;
	  } else {
		    var cb4 = "";
	  }
	  if (document.getElementById('cb5').checked) {
	  		var cb5 = document.getElementById('cb5').value;
	  } else {
		    var cb5 = "";
	  }
	  if (document.getElementById('cb6').checked) {
	  		var cb6 = document.getElementById('cb6').value;
	  } else {
		    var cb6 = "";
	  }
	  if (document.getElementById('cb7').checked) {
	  		var cb7 = document.getElementById('cb7').value;
	  } else {
		    var cb7 = "";
	  }
	  if (document.getElementById('cb8').checked) {
	  		var cb8 = document.getElementById('cb8').value;
	  } else {
		    var cb8 = "";
	  }
	  if (document.getElementById('cb9').checked) {
	  		var cb9 = document.getElementById('cb9').value;
	  } else {
		    var cb9 = "";
	  }
	  if (document.getElementById('cb10').checked) {
	  		var cb10 = document.getElementById('cb10').value;
	  } else {
		    var cb10 = "";
	  }
	  if (document.getElementById('cb11').checked) {
	  		var cb11 = document.getElementById('cb11').value;
	  } else {
		    var cb11 = "";
	  }
	  if (document.getElementById('cb12').checked) {
	  		var cb12 = document.getElementById('cb12').value;
	  } else {
		    var cb12 = "";
	  }
	  if (document.getElementById('cb13').checked) {
	  		var cb13 = document.getElementById('cb13').value;
	  } else {
		    var cb13 = "";
	  }
	  if (document.getElementById('cb14').checked) {
	  		var cb14 = document.getElementById('cb14').value;
	  } else {
		    var cb14 = "";
	  }
	  if (document.getElementById('cb15').checked) {
	  		var cb15 = document.getElementById('cb15').value;
	  } else {
		    var cb15 = "";
	  }
	  if (document.getElementById('cb16').checked) {
	  		var cb16 = document.getElementById('cb16').value;
	  } else {
		    var cb16 = "";
	  }
	  if (document.getElementById('cb17').checked) {
	  		var cb17 = document.getElementById('cb17').value;
	  } else {
		    var cb17 = "";
	  }
	  if (document.getElementById('cb18').checked) {
	  		var cb18 = document.getElementById('cb18').value;
	  } else {
		    var cb18 = "";
	  }
	  if (document.getElementById('cb19').checked) {
	  		var cb19 = document.getElementById('cb19').value;
	  } else {
		    var cb19 = "";
	  }
	  if (document.getElementById('cb20').checked) {
	  		var cb20 = document.getElementById('cb20').value;
	  } else {
		    var cb20 = "";
	  }
	  if (document.getElementById('cb21').checked) {
	  		var cb21 = document.getElementById('cb21').value;
	  } else {
		    var cb21 = "";
	  }
	  
	  var data='&cb1='+cb1+'&cb2='+cb2+'&cb3='+cb3+'&cb4='+cb4+'&cb5='+cb5+'&cb6='+cb6+'&cb7='+cb7+'&cb8='+cb8+'&cb9='+cb9+'&cb10='+cb10+'&cb11='+cb11+'&cb12='+cb12+'&cb13='+cb13+'&cb14='+cb14+'&cb15='+cb15+'&cb16='+cb16+'&cb17='+cb17+'&cb18='+cb18+'&cb19='+cb19+'&cb20='+cb20+'&cb21='+cb21
	  
      var searchUrl = 'genxml.php?address='+address+'&lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius +'&jenis_sekolah='+jensek+'&uang_spp='+uang_spp+'&uang_pangkal='+uang_pangkal+'&pendidikanguru='+pendidikanguru+data;
 GDownloadUrl(searchUrl, function(data) {
        var xml = GXml.parse(data);
        var markers = xml.documentElement.getElementsByTagName('marker');
        map.clearOverlays();
  
        var bobot = document.getElementById('bobot_nilai');
        var hasil = document.getElementById('hasil_akhir');
        bobot.innerHTML = '';
        hasil.innerHTML = '';
        if (markers.length == 0) {
            bobot.innerHTML = 'No results found.';
            map.setCenter(new GLatLng(-0.7892750, 113.9213270), 4);
          return;
        }
        
        if (markers.length == 0) {
            hasil.innerHTML = 'No results found.';
            map.setCenter(new GLatLng(-0.7892750, 113.9213270), 4);
          return;
        }
        
 //-----untuk variabel------------------------//
        var bounds = new GLatLngBounds();
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute('name');
          var nilai = markers[i].getAttribute('nilai');
          var nilai_fas = markers[i].getAttribute('nilai_fas');
          var nilai_uang_spp = markers[i].getAttribute('nilai_uang_spp');
          var nilai_uang_pangkal = markers[i].getAttribute('nilai_uang_pangkal');
          var nilai_gur = markers[i].getAttribute('nilai_gur');
		  var nilai_jarak = markers[i].getAttribute('nilai_jarak'); 
		  var distance = parseFloat(markers[i].getAttribute('distance'));
          var point = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
                                  parseFloat(markers[i].getAttribute('lng')));
          
          var marker = createMarker(point, name, address, lat, lon);
                   
          map.addOverlay(marker);
                   
          var bobotEntry = createBobotbarEntry(name, nilai, nilai_fas, nilai_uang_spp, nilai_uang_pangkal, nilai_gur, nilai_jarak);
          bobot.appendChild(bobotEntry);
          bounds.extend(point);
		}
        
        for (var i = 0; i < 1; i++) {
          var name = markers[i].getAttribute('name');
          var address = markers[i].getAttribute('address');
          var telephone = markers[i].getAttribute('telephone');
          var lat = markers[i].getAttribute('lat');
          var lon = markers[i].getAttribute('lng');
          var nilai = markers[i].getAttribute('nilai');
          var fas = markers[i].getAttribute('fas');
          var sma = markers[i].getAttribute('sma');
          var d3 = markers[i].getAttribute('d3');
          var s1 = markers[i].getAttribute('s1'); 
          var uang_pangkal = markers[i].getAttribute('uang_pangkal'); 
          var spp = markers[i].getAttribute('spp');                            
          var distance = parseFloat(markers[i].getAttribute('distance'));
          var point = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
                                  parseFloat(markers[i].getAttribute('lng')));
          
          var marker = createMarker(point, name, address, lat, lon);
                   
          map.addOverlay(marker);
          var contentbarEntry = createContentbarEntry(marker, name, address, telephone, distance, nilai, fas, sma, d3, s1, uang_pangkal, spp);
          hasil.appendChild(contentbarEntry);
          bounds.extend(point);
              
        }
        map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds));
      });
    }
  
  
 //-----untuk keterangan dari titik Point lokasi-------------------//
  
     function createMarker(point, name, address, telephone, lat, lon) {
      var marker = new GMarker(point);
       var html = '<b><a href="?nm='+ name +'&lt='+ lat +'">' + name + '</a></b> <br/>' + address + '<br/> Latitude :' + lat + '<br/> Longitude :' + lon;
      GEvent.addListener(marker, 'click', function() {
         marker.openInfoWindowHtml(html);
       });
       return marker;
     }
     
 //--untuk menampilkan keterangan lokasi pada bar kiri di interface
  
    function createBobotbarEntry(name, nilai, nilai_fas, nilai_uang_spp, nilai_uang_pangkal, nilai_gur, nilai_jarak) {
       var div = document.createElement('div');
       var html = '<b><font size="2">' + name + '</font></b><hr>Nilai Total : '+ nilai +'<br>Nilai Fasilitas : ' + nilai_fas + '<br>Nilai SPP : ' + nilai_uang_spp +'<br>Nilai Uang Pangkal : '+ nilai_uang_pangkal +'<br>Nilai Guru : '+nilai_gur+'<br>Nilai Jarak : '+nilai_jarak+'<hr>';
       div.innerHTML = html;
       div.style.cursor = 'pointer';
       div.style.marginBottom = '5px'; 
	   div.style.padding = '10px';
	   div.style.cssFloat = 'left';
	   div.style.position = 'relative';
	   div.style.width = '220px';
       GEvent.addDomListener(div, 'click', function() {
         GEvent.trigger(marker, 'click');
       });
       GEvent.addDomListener(div, 'mouseover', function() {
         div.style.backgroundColor = '#eee';
       });
       GEvent.addDomListener(div, 'mouseout', function() {
        div.style.backgroundColor = '#D7E0EA';
       });
       return div;
     }
     
     function createContentbarEntry(marker, name, address, telephone, distance, nilai, fas, sma, d3, s1, uang_pangkal, spp) {
       var div = document.createElement('div');
       var html = '<b>' + name + '</b><hr>Jarak : ' + distance.toFixed(1) + ' Km<br/>Alamat : ' + address + '<br>Telepon : ' + telephone + '<br>Jumlah Fasilitas : '+fas+'&nbsp;<a href="javascript:void(0)" id="'+name+'" onclick="javascript:getFas(this)">Tampilkan Fasilitas</a><div id="lihat_fasilitas"></div><br>Jumlah Guru SMA : '+sma+'<br>Jumlah Guru Diploma : '+d3+'<br>Jumlah Guru Sarjana : '+s1+'<br>Uang Pangkal : '+uang_pangkal+'<br>Uang SPP : '+spp+'<br><a href="javascript:void(0)" id="'+address+'" onclick="javascript:getID(this)" class="ambil_jalur">Rute Moda Transportasi<a><hr>';
       div.innerHTML = html;
       div.style.cursor = 'pointer';
       div.style.marginBottom = '5px';
	   div.style.padding = '10px'; 
       GEvent.addDomListener(div, 'click', function() {
         GEvent.trigger(marker, 'click');
       });
       GEvent.addDomListener(div, 'mouseover', function() {
         div.style.backgroundColor = '#eee';
       });
       GEvent.addDomListener(div, 'mouseout', function() {
        div.style.backgroundColor = '#FEE9E7';
       });
       return div;
     }
     //]]>

   function getID(theLink){
	    var data = theLink.id;

        jQuery.ajax({
            type: "GET",
            url: "rute_angkot.php?rute="+data,
            cache: false,
            success: function(html){
                jQuery("#angkot").html(html);
                jQuery("#angkot").fadeIn('slow',function() {
                setTimeout('doRequest()',30000);
            });
        }
     });
    }
	
	function getFas(theLink){
	    var data = theLink.id;

        jQuery.ajax({
            type: "GET",
            url: "get_fasilitas.php?nama="+data,
            cache: false,
            success: function(html){
                jQuery("#lihat_fasilitas").html(html);
                jQuery("#lihat_fasilitas").fadeIn('slow',function() {
                setTimeout('doRequest()',30000);
            });
        }
     });
    }
   </script>
  </head>

  <body onLoad="load()" onUnload="GUnload()">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">MFEP PAUD Kota Cimahi</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="#" id="tombol">Pencarian PAUD</a></li>
            <li><a href="?module=login.php">Login</a></li>
          </ul>
          <!--<form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>-->
        </div>
      </div>
    </div>
    <div class="banner">
    <img src="img/siswapaudvector.png">
    <p align="center" class="text_banner">Sistem Pendukung Keputusan<br> Pemilihan PAUD Formal<br> Kota Cimahi</p>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-1 col-md-10 main">
        
        <? $module = $_REQUEST['module'];
		
		if($module) {
			require ($module);
		} else { ?>
          <div class="container" style="max-width:1000px !important; padding:0px !important; margin-left:0px; margin-right:0px;">
          
      		<div class="jumbotron">
        		<h1>Selamat Datang!</h1>
        		<p>Sistem ini akan membantu anda, merekomendasikan PAUD Formal sesuai dengan Kriteria pemilihan PAUD Formal.</p>
      		</div>
            <div id="pencarian">
        <table align="center" cellspacing="5" id="login">
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td>
Alamat anda</td>
<td>:</td>
<td>
<input type="text" id="addressInput" class="form-control"/>
</td>
</tr>
<tr>
<td>
Jenis Sekolah
</td>
<td>:</td> 
<td>
<select id="jenis_sekolah" class="form-control">
<option value="">-- Pilih Jenis Sekolah --</option>
<option value="TK">TK</option>
<option value="RA">RA</option>
</select>
</td>
</tr>
<tr>
<td>
Radius maks (Km.)
</td>
<td>:</td>
<td>
<input type="text" id="radiusSelect" class="form-control">
</td>
</tr>
<tr>
<td>
Uang SPP
</td>
<td>:</td>
<td>
<select id="uang_spp" name="uang_spp" class="form-control">
<option value="">-- SPP --</option>
<option value="1">50.000 - 100.000</option>
<option value="2">100.000 - 200.000</option>
<option value="3">Lebih dari 200.000</option>
</select>
</td>
</tr>
<tr>
<td>
Uang Pangkal
</td>
<td>:</td>
<td>
<select id="uang_pangkal" name="uang_pangkal" class="form-control">
<option value="">-- Uang Pangkal --</option>
<option value="1">500.000 - 1.000.000</option>
<option value="2">1.000.000 - 2.000.000</option>
<option value="3">Lebih dari 2.000.000</option>
</select>
</td>
</tr>
<tr>
<td valign="top">
Jumlah Fasilitas
</td>
<td valign="top">:</td>
<td>
<!--<select id="jmlfasilitas" class="form-control">
<option value="">-- Jumlah Fasilitas --</option>
<option value="1">10 - 15</option>
<option value="2">4 - 10</option>
<option value="3">3</option>
</select>--> 
<!--<a href="javascript:void(0)" id="showfas" class="btnfas">Lihat Fasilitas</a>-->
<div id="pilihanfas">
<table width="100%">
<tr>
<td width="130px">
<input type="checkbox" id="cb1" name="cb1" value="arena indor">arena indor<br>
<input type="checkbox" id="cb2"  name="cb2" value="arena outdor">arena outdor<br>
<input type="checkbox" id="cb3"  name="cb3" value="rumah pohon">rumah pohon<br>
<input type="checkbox" id="cb4"  name="cb4" value="lab sains">lab sains<br>
<input type="checkbox" id="cb5"  name="cb5" value="ruang komputer">ruang komputer<br>
<input type="checkbox" id="cb6"  name="cb6" value="lingkungan aman">lingkungan aman<br>
<input type="checkbox" id="cb7"  name="cb7" value="perpustakaan">perpustakaan<br>
</td>
<td width="130px">
<input type="checkbox" id="cb8"  name="cb8" value="kolam pasir">kolam pasir<br>
<input type="checkbox" id="cb9"  name="cb9" value="kolam bola">kolam bola<br>
<input type="checkbox" id="cb10"  name="cb10" value="kolam renang">kolam renang<br>
<input type="checkbox" id="cb11"  name="cb11" value="wastafel">wastafel<br>
<input type="checkbox" id="cb12"  name="cb12" value="toilet bersih">toilet bersih<br>
<input type="checkbox" id="cb13"  name="cb13" value="white board">white board<br>
<input type="checkbox" id="cb14"  name="cb14" value="aula">aula<br>
</td>
<td width="130px">
<input type="checkbox" id="cb15"  name="cb15" value="ruang belajar">ruang belajar<br>
<input type="checkbox" id="cb16"  name="cb16" value="antar jemput">antar jemput<br>
<input type="checkbox" id="cb17"  name="cb17" value="ekstrakurikuler">ekstrakurikuler<br>
<input type="checkbox" id="cb18"  name="cb18" value="ruang seni">ruang seni<br>
<input type="checkbox" id="cb19"  name="cb19" value="tempat parkir">tempat parkir<br>
<input type="checkbox" id="cb20"  name="cb20" value="ruang kesehatan">ruang kesehatan<br>
<input type="checkbox" id="cb21"  name="cb21" value="mushola">mushola<br>
</td>
</tr></table>
</div>
</td>
</tr>

<tr>
<td>
Pendidikan Guru
</td>
<td>:</td>
<td>
<select id="pendidikanguru" class="form-control">
<option value="">-- Pendidikan guru --</option>
<option value="1">SMA</option>
<option value="6">Diploma</option>
<option value="7">Sarjana</option>
<option value="2">SMA + Diploma</option>
<option value="5">SMA + Sarjana</option>
<option value="3">Diploma + Sarjana</option>
<option value="4">SMA + Diploma + Sarjana</option>
</select>
</td>
</tr>

<tr>
<td>
</td>
<td></td>
<td>
<input class="btn btn-primary" id="submit" type="button" onClick="searchLocations()" value="Cari"/>
</td>
</tr>
<tr>
<td colspan="3">
<div class="maps" style="background-color:#fff; margin-top:25px; width:700px; font-family:Arial,sans-serif; font-size:11px; border:1px solid black; ">
<table>
<tbody>
<tr>
<!--<td width="200" valign="top">
<!--<div id="sidebar" style="overflow: auto; height: 300px; font-size: 11px; color: #000"></div>-->
<!--</td>-->
<td>
<div id="map" style="overflow: hidden; width:693px; height:300px"></div>
</td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>

</div>
<br />
<div class="header" align="center" style="background-image:url(images/header-image.png); padding:10px;"><strong>BOBOT PENILAIAN</strong></div>
<div id="bobot_nilai" class="bobot_nilai" style="background-color:#D7E0EA; height: 250px; display:none;"></div>
<br />
<div class="header" align="center" style="background-image:url(images/header-image.png); padding:10px;"><strong>SARAN KEPUTUSAN AKHIR</strong></div>
<div id="hasil_akhir" class="hasil_akhir" style="background-color:#FEE9E7"></div>
<div id="angkot"></div>

</td>
</tr>
</table>
        <!-- End of Tabel pencarian -->
        </div>
        <? } ?>    
    	  </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="src/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
  </body>
</html>