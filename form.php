<html>
<body>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<form method ="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" align=center>
	<input id="input" type="text" name="userentered" placeholder="Username or Email" autofocus><br>
	<input id="input" type="password" name="passentered" placeholder="Password"><br>
	<input class="submitbutton" type="submit" name="submit" value="Log In">

</form>
</body>
</html>