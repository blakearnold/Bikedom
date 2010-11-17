<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';

$is_incoming = 'incoming';
$is_outgoing = 'outgoing';

function print_res($user_login, $type) {
require 'dbinfo.php';
global $is_incoming;
global $is_outgoing;

// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

if(strcmp($type, $is_incoming)==0) {
	//$query_res = 'select * from reservation where ologin=\'' . $user_login . '\'';
	$query_res = 'select confirmation_num, deposit, start_date, stop_date, n1.name as oname, n2.name as rname, bserial from reservation r, (select name, login from people natural join account) n1, (select name, login from people natural join account) n2 where r.ologin = n1.login and r.rlogin = n2.login and ologin = \'' . $user_login . '\''; 
	
}
else {
	//$query_res = 'select * from reservation where rlogin=\'' . $user_login . '\'';
	$query_res = 'select confirmation_num, deposit, start_date, stop_date, n1.name as oname, n2.name as rname, bserial from reservation r, (select name, login from people natural join account) n1, (select name, login from people natural join account) n2 where r.ologin = n1.login and r.rlogin = n2.login and rlogin = \'' . $user_login . '\''; 
}
$parse_res = oci_parse($connection, $query_res);
if(!$parse_res) { die('Invalid query.'); }

$result_res = oci_execute($parse_res, OCI_DEFAULT);

if (!$result_res) {
	$e = oci_error();
	trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
}



while ($row_res = oci_fetch_array($parse_res, OCI_BOTH)) {
	echo("<tr><td>" . $row_res[0]);
	echo("<td>" . $row_res[1]);
	echo("<td>" . $row_res[2]);
	echo("<td>" . $row_res[3]);
	echo("<td>" . $row_res[4]);
	echo("<td>" . $row_res[5]);
	echo("<td>" . $row_res[6]);
}

oci_close($connection);
}
?>
