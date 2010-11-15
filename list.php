<?php 
include 'layout.php';
include 'helper.php';
forceLogin();
print_head_start();
?>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<script type="text/javascript"
		      src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="js/mapList.js">
</script>
</head>
<body onload="load()">
<?php
print_header();
?>
Address or Landmark:<input id="address" type="textbox" name=address />
<input type="button" value="Search" onclick="codeAddress()" />
<div id="map_canvas" style="width:45%; height:45%"></div>
<div class="body">
<div class="form"><br />
<form name="listBike" action="dblib/listBike.php">
<table>
<tr><td>Lock combo:<td><input type="text" name="combo" size="5" /><br />
<tr><td>Home intersection:<td><input type="text" name="intersect" /><br />
<tr><td>Home latitude:<td><input type="text" id="lat" name="lat" value="" /><br />
<tr><td>Home longitude:<td><input type="text" id="lng" name="long" /><br />
<tr><td>Rate per hour:<td>$<input type="text" size="4" name="rate" />/hr<br />
<tr><td>Type:<td><select name="type"><option value="Mountain Bike">Mountain Bike</option><option value="Road Bike">Road Bike</option><option value="Hybrid Bike">Hybrid Bike</option></select><br />
<tr><td>Bike Value:<td>$<input type="text" size="3" name="deposit"/><br />
<input type=hidden name="user" value="<?php echo$_COOKIE['user'];?>" />
<tr><td><td><input type="submit" value="Submit" />
</table>
</form>
</div>


</div>

<?php print_footer() ?>

</body>

</html>
