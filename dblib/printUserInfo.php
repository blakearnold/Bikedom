<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';

function print_info($user_login) {
require 'dbinfo.php';
// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$query_info = 'select name, phone_number from (account natural join people) where login=\'' . $user_login . '\'';
$parse_info = oci_parse($connection, $query_info);
if(!$parse_info) { die('Invalid query.'); }
$result_info = oci_execute($parse_info, OCI_DEFAULT);

if (!$result_info) {
	$e = oci_error();
	trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$array_info = oci_fetch_array($parse_info, OCI_BOTH);

echo("<tr><td><h4>Name</h4><td>$array_info[0]");
echo("<tr><td><h4>Phone</h4><td>$array_info[1]");

oci_close($connection);
}
?>

