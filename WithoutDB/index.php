<html>
<body bgcolor="#333333">
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php
$background = "http://media1.giphy.com/media/96FloqY8aYqwo/giphy.gif";
?>
<style type="text/css">
body {
background-image: url('<?php echo $background;?>');
background-size: 3000px 1300px;
}
</style>
<?php
if (!session_id()) //if session hasnt started, start session
	session_start();
if (!ISSET($updatedequipment)){
	$updatedequipment="";
}if (!ISSET($showform)){
	$showform=true;
}if (ISSET($_POST['credits'])){
		$showform=false;
		$credits="<h3 align=center><font color=white>Thanks Mahoney. <br><br> I would also like to thank Scott and T Jones for always being there for me.</font></h3>";
}if (!ISSET($_POST['credits'])){
		$showform=true;
		$credits="";
}
if (ISSET($_SESSION['cli'])) {
	$showstuff=true;
	$id=$_SESSION['id'];

	?>
	<div id="main">
	<?php


	require("ingamenav.php");
	echo "<br>";
	require("header.php");
	echo "<br>";
	require("inventory.php");

if ($showform==true){
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" align=center><br>
<input class="button1" type="submit" name="newgame" value="New Game"><br>
<input class="button1" type="submit" name="options" value="Options"><br>
<input class="button1" type="submit" name="credits" value="Credits"><br>
<input class="button1" type="submit" name="exit" value="Exit to Login"><br>
</form>
<?php
}
	if (ISSET($_POST['newgame'])){
		$_SESSION['location']="beginning";//resetting variables in case old session is still in tact
		$_SESSION['level']="Introduction";
		$_SESSION['health']=5;
		$_SESSION['saveslot']=0; //reset save code if there is already a value in session
		$_SESSION['newgame']=true;//it is a new game

		$_SESSION['flashlight']="ground";//if new items are added, reset them here
		$_SESSION['letter']="ground";
		$_SESSION['bottle']="ground";
		$_SESSION['key']="ground";
		$_SESSION['pizza']="ground";
		$_SESSION['book']="ground";
		$_SESSION['money']="ground";
		$_SESSION['spear']="ground";
		$_SESSION['dice']="ground";
		$_SESSION['emptybucket']="ground";
		$_SESSION['fullbucket']="ground";
		$_SESSION['baby']="ground";

		header("Location: main.php");//take to game
	}
	if (ISSET($_POST['exit'])){
	}if (ISSET($_POST['options'])){
		header("Location: updateprofile.php"); //go to options/update profile page
	}if (ISSET($_POST['credits'])){
		//echo the credits
		?>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" align=center><br>
		<?php echo $credits; ?>
		<input class="creditsbutton" type="submit" name="return" value="Return"><br>
		</form>
		<?php
		if (ISSET($_POST['return'])){
			header("Location: index.php");
		}
}
} else {
	//if session is not started, or timed out, take them to the login page
	header("Location: isulogin.php");
}

?>
</body>
</html>
