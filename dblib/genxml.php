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




if(isset($_GET["startDate"])){
$startDate = $_GET['startDate']; 
$startTime = $_GET['startTime']; 
$endDate = $_GET['endDate'];
$endTime= $_GET['endTime'];
	
	$query = 'SELECT B.RATE, B."TYPE", B.COORD_LONG, B.COORD_LAT, L.INTERSECTION, B.
BSERIAL FROM BIKES B, LOCATIONS L WHERE L.coord_long = B.coord_long AND B.coord_lat = L.coord_lat';

	$query2 = 'SELECT B.RATE, B."TYPE", B.COORD_LONG, B.COORD_LAT, L.INTERSECTION, B.BSERIAL 
		FROM BIKES B, LOCATIONS L, RESERVATION R 
		WHERE 	L.coord_long = B.coord_long AND 
				B.coord_lat = L.coord_lat AND
				R.BSERIAL = B.BSERIAL AND
				R.STOP_DATE
				>='
		. " to_date('" . $startDate . " " . $startTime ."','yyyy-mm-dd hh24:mi')"
		. " AND " 
		. " R.START_DATE <="
		. "to_date('" . $endDate . " " . $endTime ."','yyyy-mm-dd hh24:mi')";

$query = $query . " MINUS " . $query2;
} else {
// Select all the rows in the markers table
$query = 'SELECT B.RATE, B."TYPE", B.COORD_LONG, B.COORD_LAT, L.INTERSECTION, B.
BSERIAL FROM BIKES B, LOCATIONS L WHERE L.coord_long = B.coord_long AND B.coord_lat = L.coord_lat';
}
// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  echo "<bike></bike>";
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$result = oci_parse($connection, $query);
if (!$result) {
	  die('Invalid query' );
}
$r =oci_execute($result, OCI_DEFAULT);
if (!$r) {
	$e = oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

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
	  echo 'bserial="' . $row[5] . '" '; 
	  echo '/>';
}

// End XML file
echo '</bikes>';
oci_close($connection);
?>
