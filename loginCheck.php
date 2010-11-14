<?php
include 'helper.php';
if(isLoggedIn()){
	redirect("bikedomHome.php");
}
setcookie("user", $_POST["user"], 0, "/");
if(!isset($_POST['ref'])){
	redirect('bikedomHome.php');
} else{
	header ('Location: '. $_POST['ref']);
}
?>
