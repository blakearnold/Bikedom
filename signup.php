<?php
ini_set('display_errors','On');
include 'helper.php';
include 'dblib/insertUser.php';
include 'layout.php';
if(isLoggedIn()){
	redirect("bikedomHome.php");
}
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
$user = $_POST['user'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$phone = $_POST['phone'];
$name= $_POST['name'];
$q = verifyInput($user, $pwd, $pwd2, $phone, $name);
if(count($q) > 0){
	redirect('login.php?'.http_build_query($q));
} else {
	insertUser($_POST['user'], $_POST['pwd'], $_POST['name'], $_POST['phone']);
	setcookie("user", $_POST["user"], 0, "/");
}

/*
if(!isset($_POST['ref'])){
	redirect('bikedomHome.php');
} else{
	header ('Location: '. $_POST['ref']);
}*/
print_head_start();
?>
</head>
<body>
<?php
print_header();
?>
<div class="body">


<div class="signedup">
<p> Thanks for signing up! You can now list and rent bikes.
</p>
</div>
</div>

<?php print_footer() ?>

</body>

</html>
