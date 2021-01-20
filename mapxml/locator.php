<?php

// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = 10;//km

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a mySQL server
$connection= new mysqli('localhost', "root", '');
if (!$connection) {
  die("Connection failed: " . $connection->connect_error);
}
mysqli_set_charset($connection, "utf8");

// Set the active MySQL database
$db_selected = mysqli_select_db($connection, "crdb");
if (!$db_selected) {
  die ("Connection failed: " . $connection->connect_error);
}

// Search the rows in the markers table
do{
	$query = "SELECT name, street, strno, city, pc, phone, lat, lon, hub, ( 6371 * acos( cos( radians('$center_lat') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('$center_lng') ) + sin( radians('$center_lat') ) * sin( radians( lat ) ) ) ) AS distance FROM point HAVING distance < '$radius' ORDER BY distance LIMIT 0 , 20";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Query Failed: " . $connection->connect_error);
		break;
	}
	$radius = $radius + 1;//increase radius by 1km
}while(mysqli_num_rows($result) == 0);

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("street", $row['street']);
  $newnode->setAttribute("strno", $row['strno']);
  $newnode->setAttribute("city", $row['city']);
  $newnode->setAttribute("pc", $row['pc']);
  $newnode->setAttribute("phone", $row['phone']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lon", $row['lon']);
  $newnode->setAttribute("hub", $row['hub']);
}
echo $dom->saveXML();
?>