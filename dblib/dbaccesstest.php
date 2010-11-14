<?php 

ini_set('display_errors', 'On'); 
$db = "w4111c.cs.columbia.edu:1521/adb"; 
$conn = oci_connect("ab2929", "bikeLock", $db);
$stmt = oci_parse($conn, "select * from Bikes"); 
oci_execute($stmt, OCI_DEFAULT); 
while ($res = oci_fetch_row($stmt)) {
	echo "User Name: ". $res[0] ;
} 
oci_close($conn); ?>
