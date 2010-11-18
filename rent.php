<?php 
include 'layout.php'; 
print_head_start();
?>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript"
	src="http://maps.google.com/maps/api/js?sensor=false">
	</script>
	<script type="text/javascript" src="js/maps.js">
	</script>
	<script src="js/date-functions.js" type="text/javascript"></script>
	<script src="js/datechooser.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/datechooser.css">
	<link rel="stylesheet" type="text/css" href="css/map.css">
	<!--[if lte IE 6.5]>
	<link rel="stylesheet" type="text/css" href="css/select-free.css"/>
	<![endif]-->
	</head>  
<body onload="load()">
<?php print_header(); ?>
<div id="sidebar">

<div class="mapform_start">
	Start Date: <input id="startdate" size="10" maxlength="10" name="startdate" type="text"><img src="calendar.gif" onclick="showChooser(this, 'startdate', 'chooserSpan3', 2010, 2011, 'Y-m-d', false);"> 

<div id="chooserSpan3" class="dateChooser select-free" style="display: none; visibility: hidden; width: 160px;"></div>
</div>
<div id="starttime">Start time<td><select name="starttimehour" id="starttimehour"><?php print_timeselecthour() ?>:<select name="starttimeminute" id="starttimeminute"><?php print_timeselectminute() ?></div>
<div class="mapform_end">
	End Date: <input id="enddate" size="10" maxlength="10" name="enddate" id="enddate" type="text"><img src="calendar.gif" onclick="showChooser(this, 'enddate', 'chooserSpan2', 2010, 2011, 'Y-m-d', false);"> 
	<div id="chooserSpan2" class="dateChooser select-free" style="display: none; visibility: hidden; width: 160px;"></div>
</div>
<div id="endtime">
	End time<select name="endtimehour" id="endtimehour"><?php print_timeselecthour() ?>:<select name="endtimeminute" id = "endtimeminute"><?php print_timeselectminute() ?>
</div>
<div>
<input type="button" value="Search" onclick="updateMap();">
</div>
</div>
<div id="map_canvas" ></div>

</body>

<?php print_footer(); ?>

</body>

</html>
