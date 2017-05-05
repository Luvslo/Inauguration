<html>
<body bgcolor="#212121">
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php 
if (!session_id()) //if session hasnt started, start session
	session_start();
if (!ISSET($updatedequipment)){
	$updatedequipment="";
}
if (ISSET($_SESSION['cli'])) {
	$showstuff=true;
	$id=$_SESSION['id'];
	require("locations.php");
	if (!ISSET($level)) {// so every backgrond box will change color
		$level=="Introduction";
		?>
		<div id="mainintroduction">
		<?php
	}
	if ($level=="Introduction") { 
		?>
		<div id="mainintroduction">
		<?php
	}if ($level=="Real World") {
		?>
		<div id="mainrealworld">
		<?php
	}if ($level=="The Island") {
		?>
		<div id="maintheisland">
		<?php
	}if ($level=="The City") {
		?>
		<div id="mainthecity">
		<?php
	}if ($level=="The Fire") {
		?>
		<div id="mainthefire">
		<?php
	}if ($level=="The Memories") {
		?>
		<div id="mainthememories">
		<?php
	}if ($level=="Home") {
		?>
		<div id="mainhome">
		<?php
	}
	
	require("ingamenav.php");
	echo "<br>";
	require("header.php");
	echo "<br>";
	require("dbc.php");
	require("inventory.php");


require("locations.php"); // needed to be below $rows in order to grab information without notice messages

//Displaying health
if ($level!="The Memories"){
echo "<h3><font color='white'> Health:"; 
for($x=0; $x < $_SESSION['health']; $x++) {
	echo "<img src='http://i.imgur.com/GbM1xvK.png' width='23px' height='23px'>";
}
echo "</h3>";
}if ($level=="The Memories"){
echo "<h3> Health:"; 
for($x=0; $x < $_SESSION['health']; $x++) {
	echo "<img src='http://i.imgur.com/GbM1xvK.png' width='23px' height='23px'>";
}
echo "</h3>";
}

//Displaying Equipment

echo "<h3>Equipment:";
echo $updatedequipment;
		//level 1 
if ($_SESSION['flashlight']=="inventory"){
	echo $flashlight;
}if ($_SESSION['dice']=="inventory"){
	echo $dice;
}
		//level 3 (no items in level 2)
if ($_SESSION['bottle']=="inventory"){
	echo $bottle;
}if ($_SESSION['spear']=="inventory"){
	echo $spear;
}
		//level 4
if ($_SESSION['money']=="inventory"){
	echo $money;
}if ($_SESSION['key']=="inventory"){
	echo $key;
}if ($_SESSION['pizza']=="inventory"){
	echo $pizza;
}if ($_SESSION['book']=="inventory"){
	echo $book;
}
		//level 5
if ($_SESSION['letter']=="inventory"){
	echo $letter;
}if ($_SESSION['fullbucket']=="inventory"){
	echo $fullbucket;
}if ($_SESSION['emptybucket']=="inventory"){
	echo $emptybucket;
} if ($_SESSION['baby']=="inventory") {
	echo $baby;
}
echo "</h3>";

//Displaying Level 
echo "<h3>Level:" . " " . $level . "</h3><br>";
//Displaying Location
if(!ISSET($_SESSION['location'])){
echo "<h2>Location:" . " <i> beginning";
}
if(ISSET($_SESSION['location'])){
echo "<h2>Location:" . " <i>" . $_SESSION['location'];
}
echo "</i></h2></h3>";
//Location explanation
echo $_SESSION['description'];
echo "<br><br><br>"; 

//Commands
require("commands.php");
	
	?>
	</div>
<?php
if ($level=="Introduction") { //change the background for every level
	$background1 = "http://media1.giphy.com/media/96FloqY8aYqwo/giphy.gif";
	//every background needs a specific background size to correspond effecively and look nicer
	?>
	<style type="text/css">
	body {
	background-image: url('<?php echo $background1;?>');
	background-size: 3000px 1300px;
	}
	</style>
	<?php
}
if ($level=="Real World") {
	$background2 = "http://wallpapers.7savers.com/gougane-barra-wallpapers_5227_1920x1200.jpg";
	?>
	<style type="text/css">
	body {
	background-image: url('<?php echo $background2;?>');
	background-size: 2500px 1300px;
	}
	</style>
	<?php
}
if ($level=="The Island") {
	$background3 = "http://freeenglishlessonplans.files.wordpress.com/2013/11/desert-island.jpg";
	?>
	<style type="text/css">
	body {
	background-image: url('<?php echo $background3;?>');
	background-size: 2000px 1050px;
	}
	</style>
	<?php
}
if ($level=="The City") {
	$background4 = "http://imgur.com/GB77S4a.png";
	?>
	<style type="text/css">
	body {
	background-image: url('<?php echo $background4;?>');
	background-size: 2500px 1300px;
	}
	</style>
	<?php
}
if ($level=="The Fire") {
	$background5 = "http://imgur.com/7Sudvdf.png";
	?>
	<style type="text/css">
	body {
	background-image: url('<?php echo $background5;?>');
	background-size: 2000px 1000px;
	}
	</style>
	<?php
}
if ($level=="The Memories") {
	$background6 = "http://imgur.com/v1hK4gA.png";
	?>
	<style type="text/css">
	body {
	background-image: url('<?php echo $background6;?>');
	background-size: 1900px 1300px;
	}
	</style>
	<?php
}
if ($level=="Home") {
	$background7 = "http://imgur.com/kd5MlM0.png";
	?>
	<style type="text/css">
	body {
	background-image: url('<?php echo $background7;?>');
	background-size: 2500px 1300px;
	}
	</style>
	<?php
}
} else {
	header("Location: isulogin.php");
}

?>
</body>
</html>