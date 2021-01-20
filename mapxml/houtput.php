<?php

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server
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

// Select all the rows in the markers table
$query = "SELECT * FROM hub WHERE 1";
$result = mysqli_query($connection, $query);
if (!$result) {
  die("Connection failed: " . $connection->connect_error);
}


header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lon", $row['lon']);
}

echo $dom->saveXML();

?>