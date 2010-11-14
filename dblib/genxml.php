<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';
function parseToXML($htmlStr) 
{ 
	$xmlStr=str_replace('<','&lt;',$htmlStr); 
	$xmlStr=str_replace('>','&gt;',$xmlStr); 
	$xmlStr=str_replace('"','&quot;',$xmlStr); 
	$xmlStr=str_replace("'",'&#39;',$xmlStr); 
	$xmlStr=str_replace("&",'&amp;',$xmlStr); 
	return $xmlStr; 
} 


// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  die('Not connected : ');
}

// Select all the rows in the markers table
$query = 'SELECT B.RATE, B."TYPE", B.COORD_LONG, B.COORD_LAT, L.INTERSECTION FROM BIKES B, LOCATIONS L WHERE L.coord_long = B.coord_long AND B.coord_lat = L.coord_lat';
$result = oci_parse($connection, $query);
if (!$result) {
	  die('Invalid query: ' );
}
oci_execute($result, OCI_DEFAULT);
header("Content-type: text/xml");
echo '<bikes>';
// Iterate through the rows, adding XML nodes for each
while ($row = oci_fetch_row($result)){

// ADD TO XML DOCUMENT NODE
	  echo '<bike ';
	  echo 'type="' . parseToXML($row[1]) . '" ';
	  echo 'address="' . parseToXML($row[4]) . '" ';
	  echo 'lat="' . $row[3] . '" ';
	  echo 'lng="' . $row[2] . '" ';
  	  echo 'rate="$' . $row[0] . '/hr" ';
	  echo '/>';
}

// End XML file
echo '</bikes>';
?>
