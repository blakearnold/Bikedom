<?php
ini_set('display_errors', 'On');  
function print_head(){
?>


		<!DOCTYPE html>
		<html>
		<head>
		<title>Bikedom, a new way to share</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="/style.css" type="text/css">
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
<div class="mainhead">Bikedom</div>
<div class="subhead">a new way to share</div>
<div class = "headlinks">
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
?>
