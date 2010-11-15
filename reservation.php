<?php 
include 'layout.php';
include 'helper.php';
include 'dblib/getbikeid.php';
forceLogin();
print_head_start();
?>
</head>
<body>
<?php
print_header();
?>

<div class="reservationform">
<h2>Reserve bike <?php 
echo $_GET["bikeId"];
?>!</h2>

<form method="post" action="/makereserve.php">
<table width=500 align="center">
<col width=50%>
<col width=50%>
<tr><td>Bike ID<td><?php echo $_GET["bikeId"]; ?>
<tr><td>Home Location<td><?php  get_bike_location()  ?>
<tr><td>Start date<td><select name="startyear"><?php print_dateselect() ?>
<tr><td>Start time<td><select name="starttimehour"><?php print_timeselecthour() ?>:<select name="starttimeminute"><?php print_timeselectminute() ?>
<tr><td>End date<td><select name="endyear"><?php print_dateselect() ?>
<tr><td>End time<td><select name="endtimehour"><?php print_timeselecthour() ?>:<select name="endtimeminute"><?php print_timeselectminute() ?>
<tr><td><td><input type="submit" value="Submit" />
</table>
</form>
</div>

<?php print_footer() ?>

</body>

</html>
