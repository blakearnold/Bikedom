<?php
ini_set('display_errors', 'On');  
function print_head_start(){
?>


		<!DOCTYPE html>
		<html>
		<head>
		<title>Bikedom, a new way to share</title>
		<link rel="stylesheet" href="/style.css" type="text/css">
<?php
};
function print_header(){
?>

<div class="header">
<div class="mainhead"><a href="/bikedomHome.php" class='homelink'>Bikedom</a></div>
<div class="subhead">a new way to share</div>
<div class = "headlinks">
<a href="faq.php">FAQ</a>
<a href="account.php">My Account</a>
</div>
</div>
<?php
}


function print_footer(){
?>

<div class="footer">
<ul>
<li><a href="sitemap.php">Sitemap</a></li>
<li><a href="faq.php">FAQ</a></li>
</ul>

<div>
<?php
}
?>
