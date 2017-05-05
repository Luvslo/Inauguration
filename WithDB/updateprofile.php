<html>
<body bgcolor="#123E55" class="updateprofile">
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<div id="signuppage">
<?php
session_start();
require("ingamenav.php");
require("header.php");
require("dbc.php");
$query= "SELECT * FROM users";
$result=mysqli_query($dbc, $query) or DIE("Query Error");

if (ISSET($_POST['submituser'])) {
	$updateduser=$_POST['changeuser'];
	$id=$_SESSION['id'];
	$updateuserquery ="UPDATE `isu_game` . `users` SET `username` = '$updateduser' WHERE `users` . `user_id` = '$id'";
	mysqli_query($dbc, $updateuserquery) or DIE("Username Query Connection Error");
	header("Location: updateprofile.php"); //would not refresh without this
}
if (ISSET($_POST['submitpass'])) {
	$updatedpass=$_POST['changepass'];
	$id=$_SESSION['id'];
	$updatepassquery ="UPDATE `isu_game` . `users` SET `password` = '$updatedpass' WHERE `users` . `user_id` = '$id'";
	mysqli_query($dbc, $updatepassquery) or DIE("Password Query Connection Error");
	header("Location: updateprofile.php");
}
if (ISSET($_POST['submitemail'])) {
	$updatedemail=$_POST['changeemail'];
	$id=$_SESSION['id'];
	$updateemailquery ="UPDATE `isu_game` . `users` SET `email` = '$updatedemail' WHERE `users` . `user_id` = '$id'";
	mysqli_query($dbc, $updateemailquery) or DIE("Email Query Connection Error");
	header("Location: updateprofile.php");
}
while ($row=mysqli_fetch_array($result)) {
	$id=$row['user_id'];
	if ($id==$_SESSION['id']) {
		echo "<table align=center><tr>";
		echo "<br><h2 align=center><font color='#008AE6'>This is your profile information, " . $row['username'] . ".</font></h2>" . "<br>";
		echo "<td><b><font color='white'>" . "Username:" . "</b></td><td><font color='white'>" . $row['username'] . "<br></td></tr>";
		echo "<td><b><font color='white'>" . "Password:" . "</b></td><td><font color='white'>" . $row['password'] . "</td></tr>";
		echo "<td><b><font color='white'>" . "Email:" . "</b></td><td><font color='white'>" . $row['email'] . "</font></td></tr>";
		echo "</table>";
		$username = $row['username'];
		$password = $row['password'];
		$email = $row['email'];

	}
}
echo "<h4 align=center><font color='#008AE6'> Edit Your Profile</font></h4>";


	?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" align=center>
	<input id="input" type="text" name="changeuser" placeholder="<?php echo $username ?>">
	<input class="submitbutton" type="submit" name="submituser" value="Change"><br><br>
	<input id="input" type="text" name="changepass" placeholder="<?php echo $password ?>">
	<input class="submitbutton" type="submit" name="submitpass" value="Change"><br><br>
	<input id="input" type="text" name="changeemail" placeholder="<?php echo $email ?>">
	<input class="submitbutton" type="submit" name="submitemail" value="Change"><br><div style="line-height:1650%;"> <br> </div>
<?php if (!ISSET($_POST['deleteaccount'])){ ?>
	<input class="deletebutton" type="submit" name="deleteaccount" value="Delete Account" style="color:#B20000"> <?php 
}
?>
	</form>
<?php

if (ISSET($_POST['deleteaccount'])) {
	$_SESSION['delete']="yes";
	 if ($_SESSION['delete']=="yes") {
		echo "<h3 align=center><font color='B20000'> Are you sure? This process cannot be undone." . "<div style=line-height:50%;> <br> </div>";
		?>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" align=center>
		<input class="deletebutton" type="submit" name="yesdeleteaccount" value="Delete Account" style="color:#B20000">
		</form>
		<?php
		if (ISSET($_POST['yesdeleteaccount'])) {
			require("dbc.php");
			$query= "UPDATE `isu_game`.`users` SET `active` = '0' WHERE `users`.`user_id` = $id";
			mysqli_query($dbc, $query) or DIE("Error with Query");
			header("Location: isulogin.php");
		}
	}
}

?>
</div>
</html>	
	



