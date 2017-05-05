<html>
<body bgcolor=#000000>
<?php
if (!session_id()) //if session hasnt started, start session
	session_start();
?>
<title>Inauguration</title>
 <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
 <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
 <h1 class="openingtitle"> <a> &nbsp</h1><h1 class="openingtitle2" align=center> INAUGURATION </a> </h1>
</body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input class="submitbutton1" type="submit" name="mainmenu" value="Main Menu" align=center>
</form>
<?php
if (ISSET($_POST['mainmenu'])){
	header("Location: index.php");
}
?>
</html>
