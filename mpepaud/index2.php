
<html>
<head>
<title>.: MPE PAUD :.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
body {
	background-color:#999 !important;
}

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

</style>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA-Gq6foPILnL0gXPtmTcxLhSBazU3GxiNq3dXpyGawPD_3H4NXhQMHnjSg_ozuAgR-VQXc2l8okmegQ" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
 <script src="src/bootstrap.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$(".header").hide();	
	$("#lihat_fasilitas").hide();
	$("#pencarian").hide();
	
	$("#tombol").click(function() {
		$("#pencarian").show();	
		$("#utama").hide();	
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
      geocoder.getLatLng(address, function(latlng) {
        if (!latlng) {
          alert(address + ' not found');
        } else {
          searchLocationsNear(latlng);
        }
      });
    }
  
    function searchLocationsNear(center) {
      var radius = document.getElementById('radiusSelect').value;
      var jensek = document.getElementById('jenis_sekolah').value;
      var uang_spp = document.getElementById('uang_spp').value;
      var uang_pangkal = document.getElementById('uang_pangkal').value;
      var jmlfasilitas = document.getElementById('jmlfasilitas').value;
      var pendidikanguru = document.getElementById('pendidikanguru').value;
      var searchUrl = 'genxml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius +'&jenis_sekolah='+jensek+'&uang_spp='+uang_spp+'&uang_pangkal='+uang_pangkal+'&jmlfasilitas='+jmlfasilitas+'&pendidikanguru='+pendidikanguru;
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
        for (var i = 0; i < 3; i++) {
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
       var html = '<b>' + name + '</b><hr>Jarak : ' + distance.toFixed(1) + ' Km<br/>Alamat : ' + address + '<br>Telepon : ' + telephone + '<br>Jumlah Fasilitas : '+fas+'&nbsp;<a href="javascript:void(0)" id="'+name+'" onclick="javascript:getFas(this)">Tampilkan Fasilitas</a><div id="lihat_fasilitas"></div><br>Jumlah Guru SMA : '+sma+'<br>Jumlah Guru D3 : '+d3+'<br>Jumlah Guru S1 : '+s1+'<br>Uang Pangkal : '+uang_pangkal+'<br>Uang SPP : '+spp+'<br><a href="javascript:void(0)" id="'+address+'" onclick="javascript:getID(this)" class="ambil_jalur">Rute Moda Transportasi<a><hr>';
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
<body onLoad="load()" onUnload="GUnload()" bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
		<!-- Tabel Pencarian -->
        <br>
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
        <div id="utama">
        <? $module = $_REQUEST['module'];
		
		if($module) {
			require ($module);
		} else { ?>
          <p>Sistem ini Memberikan rekomendasi, PAUD Formal (Taman  Kanak &ndash; kanak dan Raudhathul Atfal) kepada Pencari PAUD Formal&nbsp; yang ada di kota cimahi.&#13;</p>
          <!--<p><center><input type="button" class="tombol" value="Cari PAUD Formal"></center></p>-->
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
<option value="0">-- Pilih Jenis Sekolah --</option>
<option value="TK">TK</option>
<option value="RA">RA</option>
</select>
</td>
</tr>
<tr>
<td>
Radius maks
</td>
<td>:</td>
<td>
<select id="radiusSelect" class="form-control">
<option value="1" selected>1</option>
<option value="5">5</option>
<option value="10">10</option>
<option value="25">25</option>
<option value="100">100</option>
<option value="200">200</option>
</select>
</td>
</tr>
<tr>
<td>
Uang SPP
</td>
<td>:</td>
<td>
<select id="uang_spp" name="uang_spp" class="form-control">
<option value="0">-- SPP --</option>
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
<option value="0">-- Uang Pangkal --</option>
<option value="1">500.000 - 1.000.000</option>
<option value="2">1.000.000 - 2.000.000</option>
<option value="3">Lebih dari 2.000.000</option>
</select>
</td>
</tr>
<tr>
<td>
Jumlah Fasilitas
</td>
<td>:</td>
<td>
<select id="jmlfasilitas" class="form-control">
<option value="0">-- Jumlah Fasilitas --</option>
<option value="1">10 - 15</option>
<option value="2">4 - 10</option>
<option value="3">3</option>
</select>
</td>
</tr>

<tr>
<td>
Pendidikan Guru
</td>
<td>:</td>
<td>
<select id="pendidikanguru" class="form-control">
<option value="0">-- Pendidikan guru --</option>
<option value="1">SMA</option>
<option value="2">SMA + Diploma</option>
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
<? } ?>