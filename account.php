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
print_buttons();
?>

<div class="accountform">
<table width=700 align="center">
<col width=50%>
<col width=50%>
<tr><td>New User<br /><br /><a href="newaccount.php" class='button2'>Create Account</a>
<td><br />Log in<br /><form><input type="text" name="username" value="username" /><br /><input type="password" name="pw" value="password"/></form>
</table>
</div>
</div>

<?php print_footer() ?>

</body>

</html>
