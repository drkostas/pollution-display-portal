<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rupoi";

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ($servername, $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
//$query = "SELECT DISTINCT s.onoma,s.kodikos,s.geogr_mikos,s.geogr_platos,d.eidos_ripou FROM stathmos s INNER JOIN  daily d on d.kodikos=s.kodikos WHERE 1 ORDER BY d.eidos_ripou";

$query = "SELECT onoma,kodikos,geogr_mikos,geogr_platos FROM stathmos WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("kodikos",$row['kodikos']);
  $newnode->setAttribute("name",$row['onoma']);
  $newnode->setAttribute("lat", $row['geogr_mikos']);
  $newnode->setAttribute("lng", $row['geogr_platos']);
  
}

echo $dom->saveXML();

?>

