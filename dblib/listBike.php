<?php
ini_set('display_errors', 'On'); 
function parseToXML($htmlStr) 
{ 
	$xmlStr=str_replace('<','&lt;',$htmlStr); 
	$xmlStr=str_replace('>','&gt;',$xmlStr); 
	$xmlStr=str_replace('"','&quot;',$xmlStr); 
	$xmlStr=str_replace("'",'&#39;',$xmlStr); 
	$xmlStr=str_replace("&",'&amp;',$xmlStr); 
	return $xmlStr; 
} 

require 'dbinfo.php';

// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  echo "<bike></bike>";
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
function executeQuery($query){
	global $connection;
$result = oci_parse($connection, $query);
if (!$result) {
	  die('Invalid query' );
}
$r =oci_execute($result, OCI_DEFAULT);
/*
if (!$r) {
	$e = oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
*/
return $result;

}


$queryMax = "Select max(bserial) from bikes";
$max = executeQuery($queryMax);
$row = oci_fetch_row($max);
$bserial = 1 + $row[0];


$queryMax = "Select max(lserial) from locks";
$max = executeQuery($queryMax);
$row = oci_fetch_row($max);
$lserial = 1 + $row[0];
// Select all the rows in the markers table

$queryLock = "INSERT INTO LOCKS (LSERIAL, COMBO) VALUES (" . $lserial . ",'" . $_GET['combo'] . "')";
$queryLoc = "INSERT INTO LOCATIONS (COORD_LONG, COORD_LAT, Intersection) VALUES (" . $_GET['long'] . "," . $_GET['lat'] . ",'" . $_GET['intersect'] . "')";
$queryBike = "INSERT INTO BIKES (RATE, TYPE, COORD_LONG, COORD_LAT, BSERIAL, LSERIAL) VALUES(" . $_GET['rate'] . ",'" . $_GET['type'] . "'," . $_GET['long'] . "," . $_GET['lat'] . "," . $bserial . "," . $lserial . ")";
$queryOwner = "INSERT INTO BIKEOWNER (BSERIAL, LOGIN) VALUES(" . $bserial . ",'" . $_GET["user"] . "')";

executeQuery($queryLock);

executeQuery($queryLoc);
executeQuery($queryBike);
executeQuery($queryOwner);
oci_commit($connection);
oci_close($connection);

?>
Successfully added your bike to the database!
