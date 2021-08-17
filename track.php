
<?php
include ("session/sqlconn.php");
		
$id = $_POST['sid'];
		
$query = "SELECT * FROM crdb.track where id = '$id' ORDER BY stamp DESC ";
$result1 = mysqli_query($conn, $query);
$query = "SELECT lat, lon, name, pack.status, pack.received, pack.delivered from crdb.point inner join crdb.pack on point.name = pack.stpoint where pack.packid = '$id'";
$result2 = mysqli_query($conn, $query);
$query = "SELECT lat, lon, name from crdb.point inner join crdb.pack on point.name = pack.tarpoint where pack.packid = '$id'";
$result3 = mysqli_query($conn, $query);
$query = "SELECT lat, lon, name from crdb.hub inner join crdb.track on hub.name = track.location where track.id = '$id' ORDER BY stamp DESC limit 0,1";
$result4 = mysqli_query($conn, $query);
$m1 = mysqli_fetch_array($result2);
$m2 = mysqli_fetch_array($result3);
if ($m1[3] == "Παραδόθηκε"){
	$m3 = $m2;
}else if (mysqli_num_rows($result4) == 0){
	$m3 = $m1;
}else{
	$m3 = mysqli_fetch_array($result4);
}
?>

<div class="panel panel-default">
<div class="panel-heading">
		<h3>Αναζήτηση Αποστολής με TrackID:  <?php echo $id; ?></h3>
</div>
<div class="panel-body">
<div class="col-md-6">
		
		<table class="table bg-success table-bordered table-hover">
		<caption>
		<h3>Κατάσταση αποστολής: <b><?php echo $m1[3]; ?></b></h3>
		<h4>Σημεία ελέγχου από τα οποία πέρασε το πακέτο:</h4>
		</caption>
		<tr>
			<th>Σημείο</th>
			<th>Ημερομηνία-'Ωρα</th>
		</tr>
		</thead>
		<tbody>
		<?php if ($m1[3] == "Παραδόθηκε"){ ?>
		<tr>
               <td><?php echo $m2[2] ?></td>
               <td><?php echo $m1[5] ?> (ΠΑΡΑΔΟΣΗ)</td>
        </tr>
		<?php } ?>
		<?php while ($row = mysqli_fetch_array($result1)) { ?>
		<tr>
               <td><?php echo $row[1] ?></td>
               <td><?php echo $row[2] ?></td>
        </tr>
		<?php } ?>
		<tr>
			<td><?php echo $m1[2] ?></td>
			<td><?php echo $m1[4] ?> (ΠΑΡΑΛΑΒΗ)</td>
		</tr>
		</tbody>
		</table>
		<div>
			<h4><br/><b>QR Code:</b></h4>
			<img src="http://localhost:1025/project/points/qrdir/<?php echo $id ?>.png" style="width:160px;height:160px;">
		</div>
		</div>
		<div class="col-md-6">
		<div id="map" style="width:100%; height:500px;" ></div>
		<script>

		function initMap() {
			var mark1 = {lat: <?php echo $m1[0] ?>, lng: <?php echo $m1[1] ?>};
			var mark2 = {lat: <?php echo $m2[0] ?>, lng: <?php echo $m2[1] ?>};
			var mark3 = {lat: <?php echo $m3[0] ?>, lng: <?php echo $m3[1] ?>};
			var mapc = {lat: -25.363, lng: 131.044};
			var map = new google.maps.Map(document.getElementById('map'), {
			center: new google.maps.LatLng(38.525364, 24.148532),
			zoom: 6
			});
			
			var iconBase = 'https://maps.google.com/mapfiles/kml/paddle/';
			
			var stpoint = new google.maps.Marker({
			position: mark1,
			map: map,
			label: "S"
			});
			stpoint.info = new google.maps.InfoWindow({
				content: '<p><b>Σημείο Παραλαβής:<br/> <?php echo $m1[2] ?></b></p>'
			});
			google.maps.event.addListener(stpoint, 'click', function() {
				stpoint.info.open(map, stpoint);
			});
			
			var tarpoint = new google.maps.Marker({
			position: mark2,
			map: map,
			label: "T"
			});
			tarpoint.info = new google.maps.InfoWindow({
				content: '<p><b>Σημείο Αποστολής:<br/> <?php echo $m2[2] ?></b></p>'
			});
			google.maps.event.addListener(tarpoint, 'click', function() {
				tarpoint.info.open(map, tarpoint);
			});
			
			var marker = new google.maps.Marker({
			position: mark3,
			map: map,
			icon: iconBase + 'grn-stars-lv.png'
			});
			
			marker.info = new google.maps.InfoWindow({
				content: '<p><b>Τρέχουσα τοποθεσία του πακέτου:<br/> <?php echo $m3[2] ?></b></p>'
			});

			google.maps.event.addListener(marker, 'click', function() {
				marker.info.open(map, marker);
			});
			  
		}
		$("#mmm").on("shown.bs.modal", function () {
			initMap();
		});
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=XXXXX&callback=initMap">
    </script>
	</div>
	</div>
	</div>
