<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';

function get_bike_location() {
require 'dbinfo.php';
// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Select all the rows in the markers table
$query = "select l.intersection from bikes b, locations l where l.coord_long = b.coord_long AND l.coord_lat = b.coord_lat AND b.bserial = " . $_GET["bikeId"];

$result = oci_parse($connection, $query);
if (!$result) {
	  die('Invalid query' );
}

$r =  oci_execute($result, OCI_DEFAULT);
if (!$r) {
	$e = oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$toprint = oci_fetch_array($result, OCI_BOTH);

echo($toprint[0]);
oci_close($connection);
}
?>
