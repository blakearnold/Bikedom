<?php 
include 'layout.php';
include 'helper.php';
include 'dblib/detAction.php';
include 'dblib/printBikes.php';
include 'dblib/printUserInfo.php';
include 'dblib/printReservations.php';

forceLogin();
print_head_start();
?>
</head>
<body>
<?php
print_header();
?>
<div class="dashboard">
<h3>Your account information:</h3>
<h4>Your info:</h4>
<div class="accountform">
<table width=400 align="center">
<?php print_info($_COOKIE['user']) ?>
</table>
<h4>Your bikes:</h4>
<div class="accountform">
<table width=700 align="center">
<tr><td><h4>Serial</h4><td><h4>Type</h4><td><h4>Rate</h4><td><h4>Intersection</h4><td><h4>Combo</h4>
<?php print_bikes($_COOKIE['user']); ?>
</table>
</div>
<h4>Change lock combo:</h4>
<form name="changecombo" action="updateCombo.php" method="post">
Bike serial: <input type="text" name="bserial" /> New combo: <input type="text" name="newcombo" /> <input type="submit" value="Submit" /> </form>


<h4>Your incoming reservations:</h4>
<div class="accountform">
<table width=900 align="center">
<tr><td><h4>Confirmation</h4><td><h4>Deposit</h4><td><h4>Start</h4><td><h4>Stop</h4><td><h4>Owner</h4><td><h4>Renter</h4><td><h4>Serial</h4><td><h4>Status</h4>
<?php print_res($_COOKIE['user'], 'incoming') ?>


<!--<col width=10%>
<col width=20%>
<col width=25%>
<col width=20%>
<col width=25%>
<tr><td><h4>Bike ID</hr><td><h4>Reserved by</h4><td><h4>Time period</h4><td><h4>Confirmation #</h4><td><h4>Edit Status</h4>
<tr><td>1<td>Martha_Kim<td class="pastreserve">2010-01-01 16:00 to<br />2010-01-01 21:00<td>2<td><div class="buttons"><a href="reportdamage.php?bikeId=1&confNum=3" class='button2'>Report Damage</a></div>
<tr><td>1<td>Martha_Kim<td class="futurereserve">2010-11-25 16:00 to<br />2010-11-25 21:00<td><td><div class="buttons"><a href="cancel.php" class='button2'>Cancel</a></div>-->
</table>

</div>
<h4>Your outgoing reservations:</h4>
<div class="accountform">
<table width=900 align="center">
<tr><td><h4>Confirmation</h4><td><h4>Deposit</h4><td><h4>Start</h4><td><h4>Stop</h4><td><h4>Owner</h4><td><h4>Renter</h4><td><h4>Serial</h4><td><h4>Status</h4>
<?php print_res($_COOKIE['user'], 'outgoing') ?>
<!--<col width=10%>
<col width=20%>
<col width=25%>
<col width=15%>
<col width=15%>
<col width=15%>
<tr><td><h4>Bike ID</hr><td><h4>Reserved from</h4><td><h4>Time period</h4><td><h4>Combo</h4><td><h4>Conf Num</h4><td><h4>Cancel?</h4>
<tr><td>2<td>Paul_Blaer<td class="pastreserve">2010-01-01 16:00 to<br />2010-01-01 21:00<td><td>9<td>
<tr><td>3<td>Junfeng_Yang<td class="futurereserve">2010-11-27 16:00 to<br />2010-11-27 21:00<td><td>10<td><div class="buttons"><a href="cancel.php" class='button2'>Cancel</a></div>-->
</table>
</div>
</div>

<!--Test space:
<?php get_reservation_status(1, $_COOKIE['user']) ?>-->

<?php print_footer() ?>

</body>

</html>
