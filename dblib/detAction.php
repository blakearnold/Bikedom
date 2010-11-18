<?php
ini_set('display_errors', 'On'); 
require 'dbinfo.php';

function get_reservation_status($conf_num, $user_login) {
	require 'dbinfo.php';
	// Opens a connection to a MySQL server
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
		  $e = oci_error();
		  trigger_error(htmlentities($e['message'], ENT_QUOTES), 	E_USER_ERROR);
	}
	
	// save user id
	$query_id = 'select a.real_id from account a where a.login = \'' . 	$user_login . '\'';
	$parse_id = oci_parse($connection, $query_id);
	if (!$parse_id) { die('Invalid query'); }
	$result_id = oci_execute($parse_id, OCI_DEFAULT);
	if (!$result_id) {
		$e = oci_error($stid);
		trigger_error(htmlentries($e['message'], ENT_QUOTES), 	E_USER_ERROR);
	}
	$array_id = oci_fetch_array($parse_id, OCI_BOTH);
	$user_id = $array_id[0];
	if(!$array_id) { die('ERROR: User with realid = ' . $user_id . ' 	does not exist.'); }	
	
	// if(rental end time > current time)
	$query_diff = 'select sysdate - r.stop_date from reservation r where 	r.confirmation_num = ' . $conf_num;
	$parse_diff = oci_parse($connection, $query_diff);
	if (!$parse_diff) {
		die('Invalid query');
	}
	
	$result_diff = oci_execute($parse_diff, OCI_DEFAULT);
	if (!$result_diff) {
		$e = oci_error($stid);
		trigger_error(htmlentries($e['message'], ENT_QUOTES), 	E_USER_ERROR);
	}
	$array_diff = oci_fetch_array($parse_diff, OCI_BOTH);
	
	if($array_diff[0] > 0) {
		//if(rental number is in pending payments)
		$query_numin = 'select * from pendingpayments p where 	p.confirmation_num = ' . $conf_num;
		$parse_numin = oci_parse($connection, $query_numin);
		if(!$parse_numin) { die('Invalid query'); }
		$result_numin = oci_execute($parse_numin, OCI_DEFAULT);
		if(!$result_numin) {
			$e = oci_error($stid);
			trigger_error(htmlentries($e['message'], ENT_QUOTES), 	E_USER_ERROR);
		}
		$array_numin = oci_fetch_array($parse_numin, OCI_BOTH);
		if($array_numin) {
			// if(pending payments is complete)
			if($array_numin[4] == 1) {
				// handle renter
				if(strcmp($array_numin[0], $user_login)==0) { echo	("paid"); }
				// handle owner
				else { echo("complete"); }
			}
			// pending payments not complete
			else {
				if(strcmp($array_numin[1], $user_login)==0) { echo	("pending (waiting on bike owner)"); }
				// handle owner
				else { echo("verify damages"); }
			}			
		}
		else {
			// if rental number not in pending payments
			// since we don't have a pendingpayments result, we have to 	check for renter/owner status in reservations
			$query_renter = 'select r.rlogin from reservation r where 	r.confirmation_num = ' . $conf_num;
			$parse_renter = oci_parse($connection, $query_renter);
			if(!$parse_renter) { die('Invalid query'); }
			$result_renter = oci_execute($parse_renter, OCI_DEFAULT);
			if(!$result_renter) {
				$e = oci_error($stid);
				trigger_error(htmlentries($e['message'], ENT_QUOTES), 	E_USER_ERROR);
			}
			$array_renter = oci_fetch_array($parse_renter, OCI_BOTH);
			// handle renter
			$return_button = "<div class=\"buttons\"><a href=\"dblib/return.php?conf=" . $conf_num . "\" class='button2'>Mark Returned</a></div>";
			if(strcmp($user_login, $array_renter[0])==0) { echo($return_button); }
			else { echo("report never returned"); }
		}
	}
	else {
		echo("rental not done yet");
	}
	
	
	oci_close($connection);
}
?>
