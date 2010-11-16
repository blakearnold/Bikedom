<?php
ini_set('display_errors','On');
include 'layout.php';

$message = "Error updating.";

function updateCombo($bserial, $combo, $user_login) {
	require 'dblib/dbinfo.php';
	// Opens a connection to a MySQL server
	global $message;
	$connection=oci_connect($username, $password, $database);
	if (!$connection) {
		  $e = oci_error();
		  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$query_owner = 'select * from bikes natural join locks natural join bikeowner where login = \'' . $user_login . 	'\' and bserial = ' . $bserial;
	$parse_owner = oci_parse($connection, $query_owner);
	if(!$parse_owner) { die('invalid query'); }
	$result_owner = oci_execute($parse_owner, OCI_DEFAULT);
	if (!$result_owner) {
		$e = oci_error();
		trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	if(! ($row_owner = oci_fetch_array($parse_owner, OCI_BOTH))) {
		$message = "You don't own the bike with serial " . $bserial . " or this bike does not exist.";
	}
	else {
		$query_update = 'update locks set combo = \'' . $combo . '\' where lserial = ' . $row_owner[1];
		$parse_update = oci_parse($connection, $query_update);
		if(!$parse_update) { die('invalid query'); }
		$result_update = oci_execute($parse_update, OCI_DEFAULT);
		if (!$result_update) {
			$e = oci_error();
			trigger_error(htmlentries($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$message = "Combo updated successfully."
	}
	oci_close($connection);
	
}

echo("hello");
$bserial = $_POST['bserial'];
$combo = $_POST['newcombo'];
updateCombo($bserial, $combo, $_COOKIE['user']);


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
