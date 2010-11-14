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
if(isset($_COOKIE["user"])){ 
	?>
		You are already logged in as <?php echo $_COOKIE["user"]; ?>!
		<a href="logout.php">Logout?</a>
	<?php 
		} else { 
	?>

<div class="accountform">
<table width=700 align="center">
<col width=50%>
<col width=50%>
<h2>Login or Create Account</h2>
<div class=Login>
<h2>Login</h2>
<form name="input" action="loginCheck.php" method="post">
Username: <input type="text" name="user" /></br>
Password: <input type="password" name="pwd" /></br>
<input type="hidden" name="ref" value="<?php echo getenv("HTTP_REFERER"); ?>"> 
<input type="submit" value="Submit" />
</form>
</div>
<h2>Sign Up</h2>
<form name="signup" action="signup.php" method="post">
Username: <input type="text" name="user" /></br>

Password: <input type="password" name="pwd" /></br>

Retype Password: <input type="password" name="pwd2" /></br>

Name: <input type="text" name="name" /></br>

Email Address: <input type="text" name="email" /></br>

<input type="hidden" name="ref" value="<?php echo getenv("HTTP_REFERER"); ?>"> 
<input type="submit" value="Submit" />
</form>
<?php 
	} 
?>
</form> 

</div>

<?php print_footer() ?>

</body>

</html>
