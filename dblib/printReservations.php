<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';


$is_incoming = 'incoming';
$is_outgoing = 'outgoing';

function print_res($user_login, $type) {
require 'dbinfo.php';
include_once 'detAction.php';
global $is_incoming;
global $is_outgoing;

//get_reservation_status(9, $user_login);

// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

if(strcmp($type, $is_incoming)==0) {
	//$query_res = 'select * from reservation where ologin=\'' . $user_login . '\'';
	$query_res = 'select confirmation_num, deposit, TO_CHAR(start_date, \'YYYY/MM/DD hh24:mi\') as start_date, TO_CHAR(stop_date, \'YYYY/MM/DD hh24:mi\') as stop_date, n1.name as oname, n2.name as rname, bserial, start_date-sysdate as diff from reservation r, (select name, login from people natural join account) n1, (select name, login from people natural join account) n2 where r.ologin = n1.login and r.rlogin = n2.login and ologin = \'' . $user_login . '\''; 
	
}
else if(strcmp($type, $is_outgoing)==0) {
	//$query_res = 'select * from reservation where rlogin=\'' . $user_login . '\'';
	$query_res = 'select confirmation_num, deposit, TO_CHAR(start_date, \'YYYY/MM/DD hh24:mi\') as start_date, TO_CHAR(stop_date, \'YYYY/MM/DD hh24:mi\') as stop_date_char, n1.name as oname, n2.name as rname, bserial, start_date-sysdate as diff from reservation r, (select name, login from people natural join account) n1, (select name, login from people natural join account) n2 where r.ologin = n1.login and r.rlogin = n2.login and rlogin = \'' . $user_login . '\''; 
}
else {
	die('\'type\' variable incorrect');
}
$parse_res = oci_parse($connection, $query_res);
if(!$parse_res) { die('Invalid query.'); }

$result_res = oci_execute($parse_res, OCI_DEFAULT);

if (!$result_res) {
	$e = oci_error();
	trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
}



while ($row_res = oci_fetch_array($parse_res, OCI_BOTH)) {
	if($row_res[7] > 0) { $cell = '<td class=futurereserve>'; } else { $cell = '<td class=pastreserve>'; }
	echo("<tr>" . $cell . $row_res[0]);
	echo($cell . $row_res[1]);
	echo($cell . $row_res[2]);
	echo($cell . $row_res[3]);
	echo($cell . $row_res[4]);
	echo($cell . $row_res[5]);
	echo($cell . $row_res[6]);
	echo($cell);
	get_reservation_status($row_res[0], $user_login);
}

oci_close($connection);
}
?>
