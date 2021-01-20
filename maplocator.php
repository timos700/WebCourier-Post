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
<div class="panel panel-default" style="width:100%; height:100%;" >
	<div class="panel-heading">
		<h3>Εύρεση Πλησιέστερου Καταστήματος</h3>
	</div>
	<div class="panel-body" style="width:100%; height:90%">
  
   <div>
         <label for="raddressInput">Πόλη ή Τ.Κ. :</label>
         <input type="text" id="addressInput" />

        <input type="button" id="searchButton" value="Search"/>
    </div>
    <div><select id="locationSelect" style="width: 10%; visibility: hidden"></select></div>
    <div id="map" style="width: 100%; height: 85%"></div>
    <script>
      var map;
      var markers = [];
      var infoWindow;
      var locationSelect;

        function initMap() {
          var greece = {lat: 38.525364, lng: 24.148532};
          map = new google.maps.Map(document.getElementById('map'), {
            center: greece,
            zoom: 7,
            mapTypeId: 'roadmap',
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
          });
          infoWindow = new google.maps.InfoWindow();

          searchButton = document.getElementById("searchButton").onclick = searchLocations;

          locationSelect = document.getElementById("locationSelect");
          locationSelect.onchange = function() {
            var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
            if (markerNum != "none"){
              google.maps.event.trigger(markers[markerNum], 'click');
            }
          };
        }

       function searchLocations() {
         var address = document.getElementById("addressInput").value;
         var geocoder = new google.maps.Geocoder();
         geocoder.geocode({
			 address: address,
			 componentRestrictions: {country: 'GR'}
			}, function(results, status) {
           if (status == google.maps.GeocoderStatus.OK) {
            searchLocationsNear(results[0].geometry.location);
           } else {
             alert(address + ' not found');
           }
         });
       }

       function clearLocations() {
         infoWindow.close();
         for (var i = 0; i < markers.length; i++) {
           markers[i].setMap(null);
         }
         markers.length = 0;

         locationSelect.innerHTML = "";
         var option = document.createElement("option");
         option.value = "none";
         option.innerHTML = "See all results:";
         locationSelect.appendChild(option);
       }

       function searchLocationsNear(center) {
         clearLocations();

         var searchUrl = 'mapxml/locator.php?lat=' + center.lat() + '&lng=' + center.lng();
         downloadUrl(searchUrl, function(data) {
            var xml = parseXml(data);
			var markerNodes = xml.documentElement.getElementsByTagName("marker");
			var bounds = new google.maps.LatLngBounds();
			for (var i = 0; i < markerNodes.length; i++) {
				var name = markerNodes[i].getAttribute('name');
				var street = markerNodes[i].getAttribute('street');
				var strno = markerNodes[i].getAttribute('strno');
				var city = markerNodes[i].getAttribute('city');
				var pc = markerNodes[i].getAttribute('pc');
				var phone = markerNodes[i].getAttribute('phone');
				var hub = markerNodes[i].getAttribute('hub');
				var latlng = new google.maps.LatLng(
					parseFloat(markerNodes[i].getAttribute("lat")),
					parseFloat(markerNodes[i].getAttribute("lon")));
				var text = "<p></p><p>Οδός: " + street + " " + strno + "</p>" +
				"<p>Πόλη: " + city + "</p>" +
				"<p>Τ.Κ.: " + pc + "</p>" +
				"<p>Τηλέφωνο: " + phone + "</p>" +
				"<p>Hub:: " + hub + "</p>";
				createMarker(latlng, name, text);
				bounds.extend(latlng);
			}
			map.fitBounds(bounds);
			map.setZoom(10);
			});
       }

       function createMarker(latlng, name, address) {
          var html = "<b>" + name + "</b> <br/>" + address;
          var marker = new google.maps.Marker({
            map: map,
            position: latlng
          });
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
          markers.push(marker);
        }

       function createOption(name, distance, num) {
          var option = document.createElement("option");
          option.value = num;
          option.innerHTML = name;
          locationSelect.appendChild(option);
       }

       function downloadUrl(url, callback) {
          var request = window.ActiveXObject ?
              new ActiveXObject('Microsoft.XMLHTTP') :
              new XMLHttpRequest;

          request.onreadystatechange = function() {
            if (request.readyState == 4) {
              request.onreadystatechange = doNothing;
              callback(request.responseText, request.status);
            }
          };

          request.open('GET', url, true);
          request.send(null);
       }

       function parseXml(str) {
          if (window.ActiveXObject) {
            var doc = new ActiveXObject('Microsoft.XMLDOM');
            doc.loadXML(str);
            return doc;
          } else if (window.DOMParser) {
            return (new DOMParser).parseFromString(str, 'text/xml');
          }
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