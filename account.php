<?php 
include 'layout.php';
print_head_start();
?>
</head>
<body>
<?php
print_header();
?>
<div class="body">
<?php 
if(!isset($_COOKIE["user"])){ 
	?>
		You are not logged in!
	<?php 
		header('Location: login.php');
		} else { 
	?>
<h2>Your account information:</h2>
<?php 
	} 
print_buttons();
?>

</div>

<?php print_footer() ?>

</body>

</html>
