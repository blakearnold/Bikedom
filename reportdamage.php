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
<h2>Report damage for reservation <?php 
echo $_GET["confNum"];
?></h2>

<form method="get" action="reportDamages.php">
<table width=500 align="center">
<tr><td>Description:<textarea rows="10" cols=100>Damage description</textarea>
<tr><td>Cost of Repair:  $<input type="textbox" size = 4 name="cost" value=0 />
<tr><td><input type=submit value=submit />
<input type=hidden name="reservation" value="<?php echo $_GET["confNum"]; ?>" />

</table>
</form>
</div>

<?php print_footer() ?>

</body>

</html>
