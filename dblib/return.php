<?php
ini_set('display_errors','On');
include 'layout.php';
require 'dbinfo.php'


$message = "Error.";
	// Opens a connection to a MySQL server
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
		  $e = oci_error();
		  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	
	
	$conf_num = $_GET["conf"];
	
	$query_diff = 'select 24 * (stop_date - start_date) from reservation where confirmation_num = ' . $conf_num;
	
	$parse_diff = oci_parse($connection, $query_diff);
	if(!$parse_diff) { die('Invalid query'); }
	$result_diff = oci_execute($parse_diff, OCI_DEFAULT);
	if (!$result_diff) {
		$e = oci_error($stid);
		trigger_error(htmlentries($e['message'], ENT_QUOTES), 	E_USER_ERROR);
	}
	$array_diff = oci_fetch_array($parse_diff, OCI_BOTH);
	
	$hours = $array_diff[0];
	
	
	$query_rate = 'select rate from bikes natural join reservation where confirmation_num = '. $conf_num;
	$parse_rate = oci_parse($connection, $query_rate);
	if(!$parse_rate) { die("invalid query"); }
	$result_rate = oci_execute($parse_rate, OCI_DEFAULT);
	if(!$result_rate) {
		$e = oci_error($stid);
		trigger_error(htmlentries($e['message'], ENT_QUOTES), 	E_USER_ERROR);
	}
	$array_rate = oci_fetch_array($parse_rate, OCI_BOTH);
	$rate = $array_rate[0];	
	
	
	
	
	
	
	$renter_login = $_COOKIE['user'];
	
	$query_pay = 'insert into pendingpayments (confirmation_num, rlogin, damage_fee, rental_fee, complete) values (' . $conf_num . ',' . $renter_login . ', 0,' . $rate * $hours . ',0)';
$parse_pay = oci_parse($connection, $query_pay);
if(!$parse_pay) { die('invalid query'); }
$result_pay = oci_execute($parse_pay, OCI_DEFAULT);
if (!$result_pay) {
	$e = oci_error();
	trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
}
		
		message = "Marked returned successfully.";
oci_commit($connection);
oci_close($connection);
	



print_head_start();
?>
</head>
<body>
<?php
print_header();
?>
<div class="body">
<?php echo($message); ?>
</div>
<?php print_footer() ?>

</body>

</html>
