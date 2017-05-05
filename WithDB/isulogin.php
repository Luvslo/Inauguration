<html>
<body>
<?php require("loginnav.php"); ?> <br>
<h2 align=center id="h2"><font color="#ffffff">Inauguration</font></h2> 

<?php 
require ("dbc.php");
$errormessage="";
if (ISSET($_POST['submit'])) {
$userentered= $_POST['userentered'];
$passentered=$_POST['passentered'];
} if (!ISSET($_POST['submit'])) {
$userentered="";
$passentered="";
}

$background = "http://www.bocsig.ro/wp-content/uploads/2011/03/Inception-wallpaper-1920x1200-1.jpg";
?>
<style type="text/css">
body {
background-image: url('<?php echo $background;?>');
background-size: 1800px 1100px;
}
</style>
<?php 
if (!session_id()) //declare globals
	session_start();
	$query = "SELECT * FROM users";
	$dbc = mysqli_connect('localhost', 'root', 'root', 'isu_game') or DIE ('Could not connect to Database');
	$result = mysqli_query($dbc, $query) or DIE("Error with Query");

	//inserting information
	while ($row = mysqli_fetch_array($result)) {

		$userdatabase=$row['username'];
		$passdatabase=$row['password'];
		$emaildatabase=$row['email'];
		$active=$row['active'];
		
		if(ISSET($_POST['submit'])) {
			if ((($userentered==$userdatabase) and ($passentered==$passdatabase) and $active=="1") or (($userentered==$emaildatabase) and ($passentered==$passdatabase)) and $active=="1") {
					$_SESSION['cli'] = "correct"; //cli = correct login info
					$_SESSION['id'] = $row['user_id'];
					echo $_SESSION['id'];
					$userentered="";
					$passentered="";
					header("Location: index.php");
		
		}
	}
}

if(!ISSET($POST['submit'])) {
	$showform = true;
	$error = false;
}
 if($userdatabase!=$userentered or $passdatabase!=$passentered) { 
	$showform=true;
	if (ISSET($_POST['submit'])) {
		$error=true;
		$errormessage="Sorry, the username and password do not match.";
	} 
 }
	if($active!="1") { 
	$showform=true;
	if (ISSET($_POST['submit'])) {
		$error=true;
		$errormessage="Sorry, that account has been deactivated.";
	}
} if ($showform==true) {
	require("form.php");
} echo "<h4 align=center><font color=red>" . $errormessage . "</font></h4>";
if (ISSET($_POST['signup'])) {
	header("Location: isusignup.php");
}
?>
</body>
</html>