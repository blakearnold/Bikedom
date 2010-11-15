<?php 
include 'layout.php';
include 'helper.php';
print_head_start();
?>
</head>
<body>
<?php
print_header();
?>
<div class="body">
<?php 
if(isLoggedIn()){ 
	?>
		You are already logged in as <?php echo $_COOKIE["user"]; ?>!
		<a href="logout.php">Logout?</a>
	<?php 
		} else { 
	?>

<div class="accountform">
<table width=500 align="center">
<col width=50%>
<col width=50%>
<tr><td colspan=2><h2>Login or Create Account</h2>
<tr><td colspan=2><div class=Login>
<h3>Login</h3>
<form name="input" action="loginCheck.php" method="post">
<tr><td>Username:<td><input type="text" name="user" /></br>
<tr><td>Password:<td><input type="password" name="pwd" /></br>
<input type="hidden" name="ref" value="<?php echo getenv("HTTP_REFERER"); ?>"> 
<input type="submit" value="Submit" />
</form>
</div><div class=Login>
<tr><td colspan=2><h3>Sign Up</h3>
<form name="signup" action="signup.php" method="post">
<tr><td>Username:<td><input type="text" name="user" /></br>

<tr><td>Password:<td><input type="password" name="pwd" /></br>

<tr><td>Retype Password:<td><input type="password" name="pwd2" /></br>

<tr><td>Name:<td><input type="text" name="name" /></br>

<tr><td>Email Address:<td><input type="text" name="email" /></br>

<input type="hidden" name="ref" value="<?php echo getenv("HTTP_REFERER"); ?>"> 
<input type="submit" value="Submit" />
</form></div></table>
<?php 
	} 
?>
</form> 

</div>

<?php print_footer() ?>

</body>

</html>
