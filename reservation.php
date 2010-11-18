<?php 
include 'layout.php';
include 'helper.php';
include 'dblib/getbikeid.php';
//include 'dblib/bike.php';
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
<h3>Please Confirm</h3>
<form method="post" action="makereserve.php?<?php echo http_build_query($_GET)?>">
<table width=500 align="center">
<col width=50%>
<col width=50%>
<tr><td>Bike ID<td><?php echo $_GET["bikeId"]; ?>
<tr><td>Home Location<td><?php  get_bike_location()  ?>
<tr><td>Start date<td><?php  echo $_GET["startDate"] ?>
<tr><td>Start time<td><?php  echo $_GET["startTime"]?>
<tr><td>End date<td><?php  echo $_GET["endDate"]?>
<tr><td>End time<td><?php  echo $_GET["endTime"]?>
<tr><td><td><input type="submit" value="Submit" />
</table>
</form>
</div>

<?php print_footer() ?>

</body>

</html>
