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

$error = "";

function executeQuery($query){
	global $connection, $error;
	// Opens a connection to a MySQL server
	$result = oci_parse($connection, $query);
	if (!$result) {
		die('Invalid query' );
	}
	$r =oci_execute($result, OCI_COMMIT_ON_SUCCESS);

if (!$r) {
	$e = oci_error($result);
	$error = htmlentities($e['message'], ENT_QUOTES);
}

return $result;
}
function testuser($user){
	
	global $connection, $username, $password, $database, $error;
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
	  $e = oci_error();
	  $error = htmlentities($e['message'], ENT_QUOTES);
	  return $error;
	}
	// Select
	$query = "SELECT login FROM account WHERE login='". $user ."'";
	$max = executeQuery($query);
	$row = oci_fetch_row($max);
	oci_close($connection);
	return $row[0];
}
function insertReservation($renter, $bserial, $startDate, $startTime, $endDate, $endTime){
	
	global $connection, $username, $password, $database, $error;
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
	  $e = oci_error();
	  $error = htmlentities($e['message'], ENT_QUOTES);
	  return $error;
	}
	$queryMax = "Select count(confirmation_num) from reservation";
	$max = executeQuery($queryMax);
	if($error != ""){
		oci_close($connection);
		return $error;
	}
	$row = oci_fetch_row($max);
	$confirmation = 1 + $row[0];


	$deposit = 100;
// Select all the rows in the markers table


	$queryRes= "INSERT INTO RESERVATION (CONFIRMATION_NUM, DEPOSIT, START_DATE, STOP_DATE, RLOGIN, BSERIAL) VALUES (" 
		. $confirmation 
		. "," 
		. $deposit
		. ","
		. "to_date('" . $startDate . " " . $startTime ."','yyyy-mm-dd hh24:mi')"
		. ","
		. "to_date('" . $endDate . " " . $endTime ."','yyyy-mm-dd hh24:mi')"
		. ","
		. "'" . $renter . "'"
		. ","
		. $bserial
		. ")";
executeQuery($queryRes);
oci_commit($connection);
oci_close($connection);
return  $error;
}
?>
