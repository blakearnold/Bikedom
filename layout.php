<?php
ini_set('display_errors', 'On');  


function print_head_start(){
include 'siteInfo.php';
?>


		<!DOCTYPE html>
		<html>
		<head>
		<title>Bikedom, a new way to share</title>
		<link rel="stylesheet" href="<?php echo "$css" ?>/style.css" type="text/css">
<?php
};



function print_header(){
include 'siteInfo.php';
include 'helper.php'
?>
<div class="header">
<div class="mainhead"><a href="<?php echo $index ?>" class='homelink'>Bikedom</a></div>
<div class="subhead">a new way to share</div>
<div class = "headlinks">
<?php
if(isLoggedIn()){
	?>
	Welcome back <?php echo $_COOKIE['user']; ?>!
	<a href="logout.php">Logout</a>
<?php
}
?>
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

function print_buttons(){
?>

<div class="buttons"><a href="rent.php" class='button'>Rent A Bike</a>
<a href="list.php" class='button'>List A Bike</a></div><br />
<?php
}

function print_dateselect() {
?>

<option value="2010">2010</option> <option value="2011">2011</option></select> <select name="startmonth"><option value="01">01</option> <option value="02">02</option> <option value="03">03</option> <option value="04">04</option> <option value="05">05</option> <option value="06">06</option> <option value="07">07</option> <option value="08">08</option> <option value="09">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option></select> <select name="startday"><option value="01">01</option> <option value="02">02</option> <option value="03">03</option> <option value="04">04</option> <option value="05">05</option> <option value="06">06</option> <option value="07">07</option> <option value="08">08</option> <option value="09">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> </select>
<?php
}

function print_timeselecthour() {
?>

<option value="00">00</option> <option value="01">01</option> <option value="02">02</option> <option value="03">03</option> <option value="04">04</option> <option value="05">05</option> <option value="06">06</option> <option value="07">07</option> <option value="08">08</option> <option value="09">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option></select>

<?php
}

function print_timeselectminute() {
?>

<option value="00">00</option> <option value="15">15</option> <option value="30">30</option> <option value="45">45</option></select>

<?php
}

function print_account_sidebar(){
?>

<div class="sidebar">
<ul>
<li><a href="ownerDashboard.php">My Dashboard</a></li>
<li><a href="ownerBikes.php">My Bikes</a></li>
<li><a href="ownerTransactions.php">My Transactions</a></li>
<li><a href="ownerReservations.php">My Reservations</a></li>
<li><a href="ownerInformation.php">My Information</a></li>
</ul>

<?php

}

?>
