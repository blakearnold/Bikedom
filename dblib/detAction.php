<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';

function get_bike_location($conf_num, $user_id) {
require 'dbinfo.php';
// Opens a connection to a MySQL server
$connection=oci_connect($username, $password, $database);
if (!$connection) {
	  $e = oci_error();
	  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// save user login
$query_login = 'select a.login from account a where a.real_id = ' . $user_id;
$parse_login = oci_parse($connection, $query_login);
if (!$parse_login) { die('Invalid query'); }
$result_login = oci_execute($parse_login, OCI_DEFAULT);
if (!$result_login) {
	$e = oci_error($stid);
	trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$array_login = oci_fetch_array($parse_login, OCI_BOTH);
$user_login = $array_login[0];
if(!$array_login) { die('ERROR: User with realid = ' . $user_id . ' does not exist.'); }
//echo("determined user login to be: " . $user_login . " | ");



// if(rental end time > current time)
$query_diff = 'select sysdate - r.stop_date from reservation r where r.confirmation_num = ' . $conf_num;
$parse_diff = oci_parse($connection, $query_diff);
if (!$parse_diff) {
	die('Invalid query');
}

$result_diff = oci_execute($parse_diff, OCI_DEFAULT);
if (!$result_diff) {
	$e = oci_error($stid);
	trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$array_diff = oci_fetch_array($parse_diff, OCI_BOTH);

if($array_diff[0] > 0) {
	//if(rental number is in pending payments)
	$query_numin = 'select * from pendingpayments p where p.confirmation_num = ' . $conf_num;
	$parse_numin = oci_parse($connection, $query_numin);
	if(!$parse_numin) { die('Invalid query'); }
	$result_numin = oci_execute($parse_numin, OCI_DEFAULT);
	if(!$result_numin) {
		$e = oci_error($stid);
		trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$array_numin = oci_fetch_array($parse_numin, OCI_BOTH);
	if($array_numin) {
		// if(pending payments is complete)
		//echo("| checking if pendingpayments complete: $array_numin[0] $array_numin[1] $array_numin[2] $array_numin[3] $array_numin[4] | ");
		if($array_numin[4] == 1) {
			// handle renter
			if(strcmp($array_numin[0], $user_login)==0) { echo("paid"); }
			// handle owner
			else { echo("complete"); }
		}
		// pending payments not complete
		else {
			//echo("| checking strcmp($array_numin[1], $user_login)==0 | ");
			if(strcmp($array_numin[1], $user_login)==0) { echo("pending (waiting on bike owner)"); }
			// handle owner
			else { echo("verify damages"); }
		}			
	}
	else {
		// if rental number not in pending payments
		// since we don't have a pendingpayments result, we have to check for renter/owner status in reservations
		$query_renter = 'select r.rlogin from reservation r where r.confirmation_num = ' . $conf_num;
		$parse_renter = oci_parse($connection, $query_renter);
		if(!$parse_renter) { die('Invalid query'); }
		$result_renter = oci_execute($parse_renter, OCI_DEFAULT);
		if(!$result_renter) {
			$e = oci_error($stid);
			trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$array_renter = oci_fetch_array($parse_renter, OCI_BOTH);
		// handle renter
		if(strcmp($user_login, $array_renter[0])==0) { echo("mark returned"); }
		else { echo("report never returned"); }
	}
}
else {
	echo("rental not done yet");
}


oci_close($connection);
}
?>
