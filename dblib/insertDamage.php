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
function insertDamage($owner, $reservation, $damage){
	
	global $connection, $username, $password, $database, $error;
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
	  $e = oci_error();
	  $error = htmlentities($e['message'], ENT_QUOTES);
	  return $error;
	}

	$queryMax = "Select ologin from reservation where confirmation_num=" . $reservation;
	$max = executeQuery($queryMax);
	if($error != ""){
		oci_close($connection);
		return $error;
	}
	$row = oci_fetch_row($max);
	if(!$row[0]){
		oci_close($connection);
		$error= "Reservation not found";
		return $error;
	}
	if($row[0] != $owner){

		oci_close($connection);
		$error= "You do not own this bike";
		return $error;
	}


	$queryDamage = "UPDATE pendingpayments
		set DAMAGE_FEE="
		. $damage
		. ", complete=1"	
		. " where CONFIRMATION_NUM="
		. $reservation
		
		;

// Select all the rows in the markers table
//	$error = $error . " ". $queryDamage;
executeQuery($queryDamage);
oci_commit($connection);
oci_close($connection);
return  $error;
}
?>
