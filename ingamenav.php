<html>
<body>
<?php
if (!session_id()) //if session hasnt started, start session
	session_start();
?>
<style type="text/css"> 
	a {
	text-decoration: none;
	color:#B2B2B2;
	}
	a:hover {
	text-decoration: none;
	color:white;
	}
</style>
<?php
$id=$_SESSION['id'];
require("dbc.php");
$query= "SELECT * FROM users WHERE `user_id`='$id'";
$result=mysqli_query($dbc, $query) or DIE("Query Error");
while ($row=mysqli_fetch_array($result)) {
	$id=$row['user_id'];
	if ($id==$_SESSION['id']) {
		$username = $row['username'];

	}
}
?>
<table style="float:right">
<tr><td><a href="updateprofile.php">Welcome, <?php echo "<u>" . $username . "</u>" ?>. </a></td>
<td>| <a href="logout.php">Logout</a><br></td>
<td>| <a href="index.php">Main Page</a></td>
</tr>
</table>

<!--color:#008AE6; Just in case, I liked this blue-->
</body>
</html>