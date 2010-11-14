<?php
ini_set('display_errors', 'On');  
function print_head(){
?>


		<!DOCTYPE html>
		<html>
		<head>
		<title>Bikedom, a new way to share</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
		html { height: 100% }
	  	body { height: 100%; margin: 0px; padding: 0px }
	    #map_canvas { height: 100% }
	  	</style>
		<script type="text/javascript"
		      src="http://maps.google.com/maps/api/js?sensor=false">
		 </script>
		 <script type="text/javascript">
		    function initialize() {
			    var latlng = new google.maps.LatLng(-34.397, 150.644);
			    var myOptions = {
			     zoom: 8,
			     center: latlng,
			     mapTypeId: google.maps.MapTypeId.ROADMAP
			 	 };
			 	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			}

	  	</script>
		</head>  
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
