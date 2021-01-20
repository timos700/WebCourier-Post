<!DOCTYPE html>
<html lang="el">
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	body{background-color:#1d1f21;}
	#map {
        height: 100%;
      }
	html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
</head>
<body>

<script>
function mmodal(p1) {
	$.post("track.php", {sid: p1}, function(response,status){
		$("#ccc").html(response);
	});
};
</script>

<?php


include('session/login.php');
include("navbar.php");
?>

<div id = "ccc" style="width:100%; height:90%;">
<div class="panel panel-default"  id = "ccc" style="width:100%; height:100%;" >
	<div class="panel-heading">
		<h3>Δίκτυο Καταστημάτων</h3>
	</div>
	<div class="panel-body" style="width:100%; height:85%">
  
    <div id="map" ></div>
	<script>

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(38.525364, 24.148532),
          zoom: 7
        });
        var infoWindow = new google.maps.InfoWindow;

          downloadUrl("mapxml/poutput.php", function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
			  var street = markerElem.getAttribute('street');
              var strno = markerElem.getAttribute('strno');
              var city = markerElem.getAttribute('city');
			  var pc = markerElem.getAttribute('pc');
			  var phone = markerElem.getAttribute('phone');
			  var hub = markerElem.getAttribute('hub');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lon')));

              var infowincontent = document.createElement('div');
              infowincontent.appendChild(document.createElement('br'));

              var text = "<p><h5>" + name + "</h5></p>" + 
				"<p>Οδός: " + street + " " + strno + "</p>" +
				"<p>Πόλη: " + city + "</p>" +
				"<p>Τ.Κ.: " + pc + "</p>" +
				"<p>Τηλέφωνο: " + phone + "</p>";
              var marker = new google.maps.Marker({
                map: map,
                position: point
              });
              marker.addListener('click', function() {
                infoWindow.setContent(text);
                infoWindow.open(map, marker);
              });
            });
          });
		  downloadUrl("mapxml/houtput.php", function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lon')));

              var infowincontent = document.createElement('div');
              infowincontent.appendChild(document.createElement('br'));

              var text = "<p><h5> Hub: " + name + "</h5></p>";
			  var image = 'https://www.stateinfoservices.com/pin.png';
              var marker = new google.maps.Marker({
                map: map,
                position: point,
				icon: image,
				label: "H"
              });
              marker.addListener('click', function() {
                infoWindow.setContent(text);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCs9vjUN0Qs2DDAXITRU_7aMRggdToc5R8&callback=initMap">
    </script>
	</div>
	</div>
	</div>

</body>
</html>
