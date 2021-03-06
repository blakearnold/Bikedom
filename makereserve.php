<?php
ini_set('display_errors','On');
include 'helper.php';
include 'dblib/insertReservation.php';
include 'layout.php';
forceLogin();

function verifyInput($user, $pwd, $pwd2, $phone, $name){
	$q = array();
	if(strlen($user) < 4):
		$q['user'] = 'length';
	endif;
	if(strlen($pwd) < 7):
		$q['pwd'] = 'length';
	endif;
	if(strlen($name) < 1 ):
		$q['name'] = 'length';
	endif;
	 if(strlen($phone) != 10 ):
		$q['phone'] = 'length';
	endif;
	if(strcmp($pwd, $pwd2)):
		$q['pwd'] = 'notMatch';
	endif;
	if(count($q) > 0){
		return $q;
	}
	$usetest = testuser($user);
	if(isset($usetest)){
		$q['user']='taken';
	}
	return $q;
}

$renter = $_COOKIE['user'];
$startDate = $_GET['startDate'];
$startTime = $_GET['startTime'];
$endDate = $_GET['endDate'];
$endTime= $_GET['endTime'];
$bserial = $_GET['bikeId'];

/*$q = verifyInput($user, $pwd, $pwd2, $phone, $name);
if(count($q) > 0){
	redirect('login.php?'.http_build_query($q));
*/
	$result = insertReservation($renter, $bserial, $startDate, $startTime, $endDate, $endTime);

/*
if(!isset($_GET['ref'])){
	redirect('bikedomHome.php');
} else{
	header ('Location: '. $_GET['ref']);
}*/
print_head_start();
?>
</head>
<body>
<?php
print_header();
?>
<div class="body">


<div class="Reserved">
<h2> Reserved </h2>
<?php if($result != "") { 
	echo "<p>Error: " . $result . "</p>";
} else { 
	echo "<p>You have successfully reserved this bike. You can check the status on your account page. </p>";
} ?>
</div>
</div>

<?php print_footer() ?>

</body>

</html>
