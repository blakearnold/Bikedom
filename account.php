<?php 
include 'layout.php';
include 'helper.php';
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
<h4>Your bikes:</h4>
<div class="accountform">
<table width=700 align="center">
<col width=10%>
<col width=25%>
<col width=40%>
<col width=25%>
<tr><td><h4>Bike ID</hr><td><h4>Reserved by</h4><td><h4>Time period</h4><td><h4>Cancel?</h4>
<tr><td>1<td>Martha_Kim<td class="pastreserve">2010-01-01 16:00 to<br />2010-01-01 21:00<td>
<tr><td>1<td>Martha_Kim<td class="futurereserve">2010-11-25 16:00 to<br />2010-11-25 21:00<td><div class="buttons"><a href="cancel.php" class='button2'>Cancel</a></div>
</table>
</div>
<h4>Your reservations:</h4>
<div class="accountform">
<table width=700 align="center">
<col width=10%>
<col width=25%>
<col width=40%>
<col width=25%>
<tr><td><h4>Bike ID</hr><td><h4>Reserved from</h4><td><h4>Time period</h4><td><h4>Cancel?</h4>
<tr><td>2<td>Paul_Blaer<td class="pastreserve">2010-01-01 16:00 to<br />2010-01-01 21:00<td>
<tr><td>3<td>Junfeng_Yang<td class="futurereserve">2010-11-27 16:00 to<br />2010-11-27 21:00<td><div class="buttons"><a href="cancel.php" class='button2'>Cancel</a></div>
</table>
</div>
</div>

<?php print_footer() ?>

</body>

</html>
