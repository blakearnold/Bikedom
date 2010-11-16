<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';

function print_bikes($user_login) {
require 'dbinfo.php';
// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$query_bikes = 'select bserial, type, rate, intersection, combo from (select * from ((bikes natural join bikeowner) natural join locations) natural join locks where login = \'' . $user_login . '\') order by bserial';
$parse_bikes = oci_parse($connection, $query_bikes);
if(!$parse_bikes) { die('Invalid query.'); }

$result_bikes = oci_execute($parse_bikes, OCI_DEFAULT);

if (!$result_bikes) {
	$e = oci_error();
	trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
}



while ($row_bikes = oci_fetch_array($parse_bikes, OCI_BOTH)) {
	echo("<tr><td>" . $row_bikes[0]);
	echo("<td>" . $row_bikes[1]);
	echo("<td>" . $row_bikes[2]);
	echo("<td>" . $row_bikes[3]);
	echo("<td>" . $row_bikes[4]);
}

oci_close($connection);
}
?>
