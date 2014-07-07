<? 
$addressInput = $_POST['addressInput'];
$radiusSelect = $_POST['radiusSelect'];
$jmlfasilitas = $_POST['jmlfasilitas'];
$pendidikanguru = $_POST['pendidikanguru'];

echo $addressInput." ".$radiusSelect." ".$jmlfasilitas." ".$pendidikanguru;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google API Mapa TEST IBNU</title>
<style type="text/css">
    body {
        font-family: sans-serif;
        font-size: 13px;
    }
    
    .kotak_pencarian {
        border: 1px solid #ccc;
        padding: 5px;
        margin-left: 0px;
        margin-right: 0px;
        background-color: #C0D0DA;
    }
    
    input {
        width: 500px;
        margin-top: 10px;
        height: 30px;
        padding: 4px;
        font-size: 15px;
    }
    
    input#submit {
        width: 542px;
        text-align: center;
        font-weight: bold;
    }
    select {
        width: 512px;
        height: 40px;
        text-align: center;
        font-weight: bold;
    }
    #map{
		width: 500px;
		height: 300px;
		padding: 10px;
    }
    </style>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA-Gq6foPILnL0gXPtmTcxLhSBazU3GxiNq3dXpyGawPD_3H4NXhQMHnjSg_ozuAgR-VQXc2l8okmegQ" type="text/javascript"></script>

<script type="text/javascript">
//<![CDATA[
var map;
var geocoder;
var addressInput="<?=$addressInput?>";
var radiusSelect="<?=$radiusSelect?>";

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
      var address = '<?=$addressInput?>';
      geocoder.getLatLng(address, function(latlng) {
        if (!latlng) {
          alert(address + ' not found');
        } else {
          searchLocationsNear(latlng);
        }
      });
    }
  
    function searchLocationsNear(center) {
      var radius = '<?=$radiusSelect?>';
      var searchUrl = 'genxml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
 GDownloadUrl(searchUrl, function(data) {
        var xml = GXml.parse(data);
        var markers = xml.documentElement.getElementsByTagName('marker');
        map.clearOverlays();
  
        var sidebar = document.getElementById('sidebar');
 sidebar.innerHTML = '';
        if (markers.length == 0) {
 sidebar.innerHTML = 'No results found.';
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
          var distance = parseFloat(markers[i].getAttribute('distance'));
          var point = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
                                  parseFloat(markers[i].getAttribute('lng')));
          
          var marker = createMarker(point, name, address, lat, lon);
                   
          map.addOverlay(marker);
          var sidebarEntry = createSidebarEntry(marker, name, address, telephone, distance);
          sidebar.appendChild(sidebarEntry);
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
       var html = '<a href="jalur_angkot.php?name='+ address +'"><b>' + name + '</b> (' + distance.toFixed(1) + ') Km<br/>' + address + '<br>Tel :' + telephone +'<hr>';
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
   </script>
   
</head>
<body onload="load()" onunload="GUnload()">
<center>
<h1>A-PAUD (Aplikasi Pencarian Pendidikan Anak Usia Dini)</h1>
Cari PAUD terdekat dari tempat anda <br/>
<div style="width:800px; font-family:Arial,sans-serif; font-size:11px; border:1px solid black">
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
</tbody>
</table>
</div>  
</center>  
</body>
</html>