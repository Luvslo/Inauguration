<html>
<body>
<h2 align=center id="h2"><font color="#ffffff">Inauguration</font></h2>

<?php
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

require("form.php");
if (ISSET($_POST['go'])) {
	$_SESSION['id'] = 1;
	header("Location: isusignup.php");
}
?>
</body>
</html>
