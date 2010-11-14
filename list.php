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
<div class="body">
<div class="form"><br />
<form name="listBike" action="dblib/listBike.php">
<table>
<tr><td>Lock serial number:<td><span style="font-family: mono">PHP to generate sequential number</span>
<tr><td>Lock combo:<td><input type="text" name="combo1" size="1" />-<input type="text" name="combo2" size="1" />-<input type="text" name="combo3" size="1" /><br />
<tr><td>Home latitude:<td><input type="text" name="lat" value="user-specified" /><br />
<tr><td>Home longitude:<td><input type="text" name="long" value="user-specified" /><br />
<tr><td>Home intersection:<td><input type="text" name="intersect" value="user-specified" /><br />
<tr><td>Rate:<td><input type="text" name="rate" value="user-specified" /><br />
<tr><td>Type:<td><select name="types"><option value="Mountain Bike">Mountain Bike</option><option value="Road Bike">Road Bike</option><option value="Hybrid Bike">Hybrid Bike</option></select><br />
<tr><td>Deposit required:<td><input type="text" name="combo" value="user-specified" /><br />
<tr><td><td><input type="submit" value="Submit" />
</table>
</form>
</div>

</div>

<?php print_footer() ?>

</body>

</html>
