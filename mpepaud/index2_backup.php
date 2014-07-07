 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google API Mapa TEST IBNU</title>
<link rel="stylesheet" href="inc/css/styles.css" type="text/css" />
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA-Gq6foPILnL0gXPtmTcxLhSBazU3GxiNq3dXpyGawPD_3H4NXhQMHnjSg_ozuAgR-VQXc2l8okmegQ" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

    $(".maps").hide();
    $("#angkot").hide();
    $("#hasil_akhir").hide();

  $("#submit").click(function() {
    $("#login").hide();
    $(".maps").show();
    $("#hasil_akhir").show();
  });

  $("#kembali").click(function() {
    $("#login").show();
    $(".maps").hide();
    $("#angkot").hide();
    $("#hasil_akhir").hide();
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
  
        var sidebar = document.getElementById('sidebar');
        var hasil = document.getElementById('hasil_akhir');
        sidebar.innerHTML = '';
        hasil.innerHTML = '';
        if (markers.length == 0) {
            sidebar.innerHTML = 'No results found.';
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
          var sidebarEntry = createSidebarEntry(marker, name, address, telephone, distance);
          sidebar.appendChild(sidebarEntry);
          bounds.extend(point);
          
        }
        
        for (var i = 0; i < 3; i++) {
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
  
    function createSidebarEntry(marker, name, address, telephone, distance) {
       var div = document.createElement('div');
       var html = '<b>' + name + '</b> (' + distance.toFixed(1) + ') Km<br/>' + address + '<br>Tel :' + telephone +'<br><a href="#" id="'+address+'" onclick="javascript:getID(this)" class="ambil_jalur">Rute Moda Transportasi<a><hr>';
       div.innerHTML = html;
       div.style.cursor = 'pointer';
       div.style.marginBottom = '5px'; 
       GEvent.addDomListener(div, 'click', function() {
         GEvent.trigger(marker, 'click');
       });
       GEvent.addDomListener(div, 'mouseover', function() {
         div.style.backgroundColor = '#eee';
       });
       GEvent.addDomListener(div, 'mouseout', function() {
        div.style.backgroundColor = '#fff';
       });
       return div;
     }
     
     function createContentbarEntry(marker, name, address, telephone, distance, nilai, fas, sma, d3, s1, uang_pangkal, spp) {
       var div = document.createElement('div');
       var html = '<b>' + name + '</b><hr>Bobot Nilai : '+nilai+'<br>Jarak : ' + distance.toFixed(1) + ' Km<br/>Alamat : ' + address + '<br>Telepon : ' + telephone + '<br>Jumlah Fasilitas : '+fas+'<br>Jumlah Guru SMA : '+sma+'<br>Jumlah Guru D3 : '+d3+'<br>Jumlah Guru S1 : '+s1+'<br>Uang Pangkal : '+uang_pangkal+'<br>Uang SPP : '+spp+'<hr>';
       div.innerHTML = html;
       div.style.cursor = 'pointer';
       div.style.marginBottom = '5px'; 
       GEvent.addDomListener(div, 'click', function() {
         GEvent.trigger(marker, 'click');
       });
       GEvent.addDomListener(div, 'mouseover', function() {
         div.style.backgroundColor = '#eee';
       });
       GEvent.addDomListener(div, 'mouseout', function() {
        div.style.backgroundColor = '#fff';
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
   </script>

</head>
<body onload="load()" onunload="GUnload()">
<center>
<h1>A-PAUD (Aplikasi Pencarian Pendidikan Anak Usia Dini)</h1>
<table id="login">
<tr>
<td colspan="3"><img src="images/header.jpg"></td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td>
Alamat anda</td>
<td>:</td>
<td>
<input type="text" id="addressInput" class="inputan"/>
</td>
</tr>
<tr>
<td>
Jenis Sekolah
</td>
<td>:</td> 
<td>
<select id="jenis_sekolah" class="inputan">
<option value="PAUD">PAUD</option>
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
<select id="radiusSelect" class="inputan">
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
<select id="uang_spp" name="uang_spp" class="inputan">
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
<select id="uang_pangkal" name="uang_pangkal" class="inputan">
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
<select id="jmlfasilitas" class="inputan">
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
<select id="pendidikanguru" class="inputan">
<option value="0">-- Pendidikan guru --</option>
<option value="1">SMA</option>
<option value="2">SMA + Diploma</option>
<option value="3">SMA + Diploma + Sarjana</option>
</select>
</td>
</tr>

<tr>
<td>
</td>
<td></td>
<td>
<input id="submit" type="button" onclick="searchLocations()" value="Cari"/>
</td>
</tr>
</table>
<div class="maps" style="background-color:#fff; margin-top:25px; width:800px; font-family:Arial,sans-serif; font-size:11px; border:1px solid black; ">
<table>
<tbody>
<tr>
<td width="200" valign="top">
<div id="sidebar" style="overflow: auto; height: 300px; font-size: 11px; color: #000"></div>
</td>
<td>
<div id="map" style="overflow: hidden; width:580px; height:300px"></div>
</td>
</tr>
<tr>
<td></td>
<td align="right"><input id="kembali" class="kembali" type="button" value="CARI KEMBALI"/>  </td>
</tr>
</tbody>
</table>
</div>
<br />
<div class="header"><strong>SARAN KEPUTUSAN AKHIR</strong></div>
<div id="hasil_akhir" class="hasil_akhir"></div>
<div id="angkot"></div>
</center>
</body>
</html>