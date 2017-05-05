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
	require("dbc.php");
	require("inventory.php");

if ($showform==true){
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" align=center><br>
<input class="button1" type="submit" name="load" value="Load Game"><br>
<input class="button1" type="submit" name="newgame" value="New Game"><br>
<input class="button1" type="submit" name="options" value="Options"><br>
<input class="button1" type="submit" name="credits" value="Credits"><br>
<input class="button1" type="submit" name="exit" value="Exit to Login"><br>
</form>
<?php
}
	if(ISSET($_POST['load'])){
		//extract data from database 
		$loadgame_data_query="SELECT * FROM `gamedata` WHERE `user_id`='$id'";
		$loadgame_data_result=mysqli_query($dbc, $loadgame_data_query) or DIE ("Loading Query Error");
		
		//create variables with database information
		while($row=mysqli_fetch_array($loadgame_data_result)){ 
			$equipment=$row['equipment'];
			$location=$row['location'];
			$level=$row['level'];
			$health=$row['health'];
			$save_code=$row['saveslot'];
		}
		$sessionequipment=explode(" ", $equipment);
		//create variables from sessionequipment, if the value isnt in the array, make the not in the inventory, if it is, activate session
		if (in_array("flashlight", $sessionequipment)) {
			$_SESSION['flashlight']="inventory";
		}else {
			$_SESSION['flashlight']="ground";
		}if (in_array("letter", $sessionequipment)) {
			$_SESSION['letter']="inventory";
		}else {
			$_SESSION['letter']="ground";
		}if (in_array("bottle", $sessionequipment)) {
			$_SESSION['bottle']="inventory";
		}else {
			$_SESSION['bottle']="ground";
		}if (in_array("key", $sessionequipment)) {
			$_SESSION['key']="inventory";
		}else {
			$_SESSION['key']="ground";
		}if (in_array("pizza", $sessionequipment)) {
			$_SESSION['pizza']="inventory";
		}else {
			$_SESSION['pizza']="ground";
		}if (in_array("book", $sessionequipment)) {
			$_SESSION['book']="inventory";
		}else {
			$_SESSION['book']="ground";
		}if (in_array("money", $sessionequipment)) {
			$_SESSION['money']="inventory";
		}else {
			$_SESSION['money']="ground";
		}if (in_array("spear", $sessionequipment)) {
			$_SESSION['spear']="inventory";
		}else {
			$_SESSION['spear']="ground";
		}if (in_array("dice", $sessionequipment)) {
			$_SESSION['dice']="inventory";
		}else {
			$_SESSION['dice']="ground";
		}if (in_array("emptybucket", $sessionequipment)) {
			$_SESSION['emptybucket']="inventory";
		}else {
			$_SESSION['emptybucket']="ground";
		}if (in_array("fullbucket", $sessionequipment)) {
			$_SESSION['fullbucket']="inventory";
		}else {
			$_SESSION['fullbucket']="ground";
		}if (in_array("baby", $sessionequipment)) {
			$_SESSION['baby']="inventory";
		}else {
			$_SESSION['baby']="ground";
		}	
		
		$_SESSION['newgame']=false;//it is not a new game
		$_SESSION['conversation']=false; //there is no conversation active
		$_SESSION['continue']=false;//continue button will not be dislayed yet
		$_SESSION['c']=0; //reset and declare counter
		$_SESSION['saveslot']=$save_code;//creating global variables so they cant be lost
		$_SESSION['location']=$location;
		$_SESSION['health']=$health;
		$_SESSION['level']=$level;
		
		header("Location: main.php");//take to game
	}
	if (ISSET($_POST['newgame'])){
		//delete previous game information
		$delete_old_data_query="DELETE FROM `isu_game`.`gamedata` WHERE `gamedata`.`user_id` = '$id'";
		mysqli_query($dbc, $delete_old_data_query) or DIE ("Deleting Old Data Query Error");
		//create new profile information, starting from the beginning
		$newgame_data_query="INSERT INTO `isu_game`.`gamedata` (`gamedata_id`, `user_id`, `level`, `location`, `equipment`, `health`, `saveslot`) VALUES (NULL, '$id', 'Introduction', 'beginning', '', '5', '0')";
		$newgame_data_result=mysqli_query($dbc, $newgame_data_query) or DIE ("Creating New Game Query Error");
		//creating new variables with new database information
		while($row=mysqli_fetch_array($newgame_data_result)){ 
			$equipment=$row['equipment'];
			$location=$row['location'];
			$level=$row['level'];
			$health=$row['health'];
		}
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
		header("Location: logout.php"); //exit game
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