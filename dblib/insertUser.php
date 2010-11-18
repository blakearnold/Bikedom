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

function executeQuery($query){
	global $connection;
	// Opens a connection to a MySQL server
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
function testuser($user){
	
	global $connection, $username, $password, $database;
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	// Select all the rows in the markers table
	$query = "SELECT login FROM account WHERE login='". $user ."'";
	$max = executeQuery($query);
	$row = oci_fetch_row($max);
	oci_close($connection);
	return $row[0];
}
function insertUser($user, $pwd, $name, $number){
	
	$queryMax = "Select count(real_id) from people";
	$max = executeQuery($queryMax);
	$row = oci_fetch_row($max);
	$real_id = 1 + $row[0];

// Select all the rows in the markers table

	$queryPeople = "INSERT INTO PEOPLE (NAME, PHONE_NUMBER, REAL_ID) VALUES ('" . $name . "'," . $number . "," . $real_id . ")";
$queryAcc = "INSERT INTO ACCOUNT(LOGIN, PASSWORD, FUNDS, real_id) VALUES ('" . $user . "','" . $pwd . "'," . 100 . "," . $real_id . ")";


	global $connection, $username, $password, $database;
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
executeQuery($queryPeople);

executeQuery($queryAcc);

oci_commit($connection);
oci_close($connection);
}
?>
