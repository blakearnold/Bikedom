<?php
function testUser($user, $pass){
include	'dbinfo.php';


// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Select all the rows in the markers table
$query = "SELECT login FROM account WHERE login='". $user ."' AND password='". $pass ."'";

$result = oci_parse($connection, $query);
if (!$result) {
	  die('Invalid query' );
}
$r =oci_execute($result, OCI_DEFAULT);
if (!$r) {
	$e = oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$row = oci_fetch_row($result);
oci_close($connection);
return $row[0];
}
?>
