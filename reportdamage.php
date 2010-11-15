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

<div class="reservationform">
<h2>Report damage for bike <?php 
echo $_GET["bikeId"];
?> from reservation <?php 
echo $_GET["confNum"];
?></h2>

<form method="post" action="/makereserve.php">
<table width=500 align="center">
<tr><td><textarea rows="10" cols=100>Damage description</textarea>
<tr><td><div class="buttons"><a href="" class='button2'>Submit Report</a></div>
</table>
</form>
</div>

<?php print_footer() ?>

</body>

</html>
