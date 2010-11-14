<?php
ini_set('display_errors', 'On');  
function print_head_start(){
?>


		<!DOCTYPE html>
		<html>
		<head>
		<title>Bikedom, a new way to share</title>
<?php
};
function print_header(){
?>

<div class="header">
<h1>BIKEDOM</h1>
<div class="subhead">a new way to share</div>
<div class = "links">
<ul>
<li><a href="faq.php">FAQ</a></li>
<li><a href="account.php">My Account</a></li>
</ul>
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
