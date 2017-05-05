<html>
<body>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php
if (!session_id()) //if session hasnt started, start session
	session_start();
require("dbc.php");//access database 
require("locations.php");//access equipment and level logs

if (!ISSET($_SESSION['conversation'])){
	$_SESSION['conversation']=false;
}
if (!ISSET($_SESSION['conversation'])) {
	$_SESSION['conversation1']=1;
}
if (!ISSET($_SESSION['continue'])) {
	$_SESSION['continue']=false;
}
if ($_SESSION['conversation']==false && $_SESSION['continue']==false){
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
<table id="tablecommands" center="align"><!--to place submit buttons directly under command bar-->
	<tr><td><font color="white"> </td>
	<td><input id="commandinput" type="text" name="command" placeholder="Commands" autofocus><br></td></tr>
	<tr><td></td>
	<td><input class="commandbutton" type="submit" name="perform" value="Do It">
	<input class="commandbutton" type="submit" name="save" value="Save Progress"></td></tr>
	<h3 class="helpbox">For help, type '?' or 'help'. For a hint, type 'hint'.	</h3>
	</body>
	</form>
	<?php 
	echo $help;
	echo $hint;
	echo $errormessage;
} 

if ($_SESSION['conversation']==true) {
			?>
			<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
			<td><input type="submit" <?php if ($level!="The Memories") { ?> class="choices" <?php } if ($level=="The Memories") { ?> class="choices2" <?php } ?> name="choice1" value="<?php echo $_SESSION['choice1']; ?>">
			
		<?php if ($_SESSION['choice2']!=""){ ?>
			<td><input type="submit" <?php if ($level!="The Memories") { ?> class="choices" <?php } if ($level=="The Memories") { ?> class="choices2" <?php } ?> name="choice2" value="<?php echo $_SESSION['choice2']; ?>"><br>
			<input type="text" class="hiddenchoices" name="hiddenchoice2" value="<?php echo $_SESSION['choice2']; ?>">
		<?php } ?>
		<input type="text" class="hiddenchoices" name="hiddenchoice1" value="<?php echo $_SESSION['choice1']; ?>">
			</body>
			<?php
	}
if ($_SESSION['continue']==true) {
	?>
	<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
		<td><input type="submit" class="commandbutton" name="continue" value="Continue">
	<?php		
}
if (!ISSET($_POST['continue'])){
	$continue=false;
}
if (ISSET($_POST['continue'])){
	$continue=true;
}
	
if (!ISSET($finalcommand)){ //conversation values
	$finalcommand="";
}
if (ISSET($_POST['choice1'])){
	$finalcommand=$_POST['hiddenchoice1'];
	$turn=true;
}if (ISSET($_POST['choice2'])){
	$finalcommand=$_POST['hiddenchoice2'];
	$turn=true;
}

if (ISSET($_POST['save'])) {
	$array_equipment=array();//declaring array that items will be pushed into 
	
	//if items are in inventory, push into array
	if ($_SESSION['flashlight']=="inventory") { //if flashlight was picked up, add to equipment
		array_push($array_equipment, "flashlight");
	} if ($_SESSION['letter']=="inventory") {
		array_push($array_equipment, "letter");
	} if ($_SESSION['bottle']=="inventory") {
		array_push($array_equipment, "bottle");
	} if ($_SESSION['key']=="inventory") {
		array_push($array_equipment, "key");
	} if ($_SESSION['pizza']=="inventory") {
		array_push($array_equipment, "pizza");
	} if ($_SESSION['book']=="inventory") {
		array_push($array_equipment, "book");
	} if ($_SESSION['money']=="inventory") {
		array_push($array_equipment, "money");
	}if ($_SESSION['spear']=="inventory") {
		array_push($array_equipment, "spear");
	}if ($_SESSION['dice']=="inventory") {
		array_push($array_equipment, "dice");
	}if ($_SESSION['fullbucket']=="inventory"){
		array_push($array_equipment, "fullbucket");
	}if ($_SESSION['emptybucket']=="inventory"){
		array_push($array_equipment, "emptybucket");
	} if ($_SESSION['baby']=="inventory") {
		array_push($array_equipment, "baby");
	}
	//implode array to be saved
		$save_equipment=implode(" ",$array_equipment);//
	
	//declare variables in which to be saved
	$save_level=$level;
	$save_location=$_SESSION['location'];
	$save_health=$_SESSION['health'];
	$save_code=$_SESSION['saveslot'];
	
	//Save Queries
	$savelevelquery="UPDATE `isu_game` . `gamedata` SET `level` = '$save_level' WHERE `gamedata` . `user_id` = '$id'";
	$savelocationquery="UPDATE `isu_game` . `gamedata` SET `location` = '$save_location' WHERE `gamedata` . `user_id` = '$id'";
	$saveequipmentquery="UPDATE `isu_game` . `gamedata` SET `equipment` = '$save_equipment' WHERE `gamedata` . `user_id` = '$id'";
	$savehealthquery="UPDATE `isu_game` . `gamedata` SET `health` = '$save_health' WHERE `gamedata` . `user_id` = '$id'";
	$saveslotquery="UPDATE `isu_game` . `gamedata` SET `saveslot` = '$save_code' WHERE `gamedata` . `user_id` = '$id'";
	mysqli_query($dbc, $savelevelquery) or DIE("Level Query Connection Error");
	mysqli_query($dbc, $savelocationquery) or DIE("Location Query Connection Error");
	mysqli_query($dbc, $saveequipmentquery) or DIE("Equipment Query Connection Error");
	mysqli_query($dbc, $savehealthquery) or DIE("Health Query Connection Error");
	mysqli_query($dbc, $saveslotquery) or DIE("Save Slot Query Connection Error");
	echo "<font color='green'> The game has been successfully saved! </font>";
}
?>
</html>