<?php
include 'helper.php';
include 'dblib/verifyUser.php';
if(isLoggedIn()){
	redirect("bikedomHome.php");
}
$usetest = testuser($_POST['user'], $_POST['pwd']);
if(isset($usetest)){
	setcookie("user", $_POST["user"], 0, "/");
} else {
	redirect('login.php?failed=true');
}
if(!isset($_POST['ref'])){
	redirect('bikedomHome.php');
} else{
	header ('Location: '. $_POST['ref']);
}
?>
