<?php
echo "hey" . $_POST['user'];
if( isset($_COOKIE['user'])){
	echo "hey!";
	echo $_COOKIE['user'];
}
setcookie("user", $_POST["user"], 0, "/");
if($_POST['ref'] == ""){
	header( 'Location: bikedomHome.php' ) ;
} else{
	header ('Location:'. $_POST['ref']);
}
?>
