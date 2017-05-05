<html>
<body>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<title>
Sign Up For Inauguration!
</title>
<?php require("loginnav.php");?> <br>
<h2 align=center id="h2"><font color="#ffffff">Sign Up For Inauguration!</font></h2>

<form method ="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"align=center id="signupform">
	<input id="input" type="text" name="newuser" placeholder="Username" autofocus><br>
	<input id="input" type="text" name="newemail" placeholder="Email"><br>
	<input id="input" type="password" name="newpass" placeholder="Password"><br>
	<input id="input" type="password" name="confirmpass" placeholder="Confirm Password"><br>
	<input class="submitbutton" type="submit" name="submit" value="Sign Up" align=center><br>
<?php 
$background = "http://images.medicaldaily.com/sites/medicaldaily.com/files/styles/headline/public/2015/01/01/snake-eyes-dice-roll.jpg?itok=QZw8DlhM";
?>
<style type="text/css">
body {
background-image: url('<?php echo $background;?>');
background-size: 1900px 1000px;
}

</style>
<?php 

if (!session_id()) //declare globals
	session_start();
if (!ISSET($_POST['submit'])) {	
	$newuser="";
	$newpass="";
	$confirmpass="";
	$newemail="";
	$errormessage="";
}
if (ISSET($_POST['submit'])) {	
	$newuser=$_POST['newuser'];
	$newpass=$_POST['newpass'];
	$confirmpass=$_POST['confirmpass'];
	$newemail=$_POST['newemail'];
}
require ("dbc.php");
if (ISSET($_POST['submit'])) {
	if($newuser!="" && $newpass !="" && $confirmpass!="" && $newemail!="") {
		if ($confirmpass==$newpass) {
			//if all info is entered and passwords match, create account
			$query="INSERT INTO `isu_game`.`users` (`user_id`, `username`, `password`, `signupdate`, `email`, `active`) VALUES (NULL, '$newuser', '$newpass', CURRENT_TIMESTAMP, '$newemail', '1')";
			mysqli_query($dbc, $query) or DIE("Error with Query");
			$querysearchid="SELECT * FROM `users` WHERE `username`='$newuser'";
			$searchid_result=mysqli_query($dbc, $querysearchid) or DIE ("Query error");
			
				while($row=mysqli_fetch_array($searchid_result)){ 
					$newuser_id=$row['user_id'];
				}
				
			$querydata="INSERT INTO `isu_game`.`gamedata` (`gamedata_id`, `user_id`, `level`, `location`, `equipment`, `health`, `saveslot`) VALUES (NULL, '$newuser_id', 'Introduction', 'beginning', '', '5', '')";;
			mysqli_query($dbc, $querydata) or DIE("Error with Query");
			header("Location: isulogin.php");
		}
	}
	if($newuser=="" or $newpass =="" or $confirmpass=="" or $newemail=="") {
		//not all of the information was entered, so create error message
		$errormessage="<font color=red>" . "Please enter all fields of information." . "</font>";
	}
}if ($confirmpass != $newpass) {
	//passwords do not match, so create error message
	$errormessage="<font color=red>" . "Sorry the passwords do not match." . "</font>";
} 
echo $errormessage;
?>
</body>
</html>