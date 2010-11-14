<?php 
include 'layout.php'; 
print_head_start();
?>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
		html { height: 100% }
	  	body { height: 100%; margin: 0px; padding: 0px }
	    #map_canvas { height: 100% }
	  	</style>
		<script type="text/javascript"
		      src="http://maps.google.com/maps/api/js?sensor=false">
		 </script>
		 <script type="text/javascript" src="js/maps.js">
	  	</script>
</head>  
<body>

<?php print_header(); ?>
<body onload="load()">
<div id="map_canvas" style="width:100%; height:100%"></div>
</body>

<?php print_footer(); ?>

</body>

</html>
