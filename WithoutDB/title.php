<html>
<body>
<?php 
$background = "http://www.twitterevolutions.com/bgs/inception-twitter-background.jpg";
if (!session_id()) //if session hasnt started, start session
	session_start();
?>
<style type="text/css">
body {
background-image: url('<?php echo $background;?>');
background-size: 1800px 1100px;
}
</style>
<title>Inauguration</title>
 <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
 <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<style>

     
	.openingtitle {
		position: relative;
		font-size: 100px;
		color: #999999;
		margin-top: 0;
		font-family: 'Lobster', helvetica, arial;
	}
	.openingtitle2 {
		position: relative;
		font-size: 140px;
		margin-top: 0;
		font-family: "Verdana", Geneva, sans-serif;
    }
     
	.openingtitle2 a {
		text-decoration: none;
		color: #666;
		position: absolute;
				 
		-webkit-mask-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), color-stop(50%, rgba(0,0,0,.5)), to(rgba(0,0,0,1)));
		}
     

	.openingtitle2:after {
		content : 'INAUGURATION';
		color: #6666666;
		text-shadow: 0 1px 0 black;
	}
     
    </style>
     <h1 class="openingtitle"> <a> This is the</h1><h1 class="openingtitle2" align=center> INAUGURATION </a> </h1>
</body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input class="submitbutton1" type="submit" name="return" value="Resume Playing" align=center>
</form>
<?php 
if (ISSET($_POST['return'])){
	$_SESSION['level']="Real World";
	$_SESSION['location']="warehouse";
	$_SESSION['saveslot']=0013;
	header("Location: main.php");
}
?>
</html>