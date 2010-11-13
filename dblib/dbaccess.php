
<?php
$username = "ab2929@ADB";
$password = "bikeLock";
$server = "w4111c.cs.columbia.edu"
function openConnection(){
	global $conn = oci_connect($username, $password, $server);
	if (!$conn) {
    	$e = oci_error();
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
}

function executeQuery(){

	// Perform the logic of the query
	global $r = oci_execute($stid);
	if (!$r) {
	    $e = oci_error($stid);
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
}

function cleanup(){

	oci_free_statement($stid);
	oci_close($conn);
}

function getAllBikes(){
	openConnection();	
	// Prepare the statement
	global $stid = oci_parse($conn, 'SELECT * FROM bikes');
	if (!$stid) {
	    $e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	executeQuery();
	// Fetch the results of the query
	print "<table border='1'>\n";
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		print "<tr>\n";
		foreach ($row as $item) {
			print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		}
		print "</tr>\n";
	}
	print "</table>\n";
	cleanup();
}

getAllBikes();

?>


