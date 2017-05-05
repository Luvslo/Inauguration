<html>
<body bgcolor=#000000>
<?php 
if (!session_id()) //if session hasnt started, start session
	session_start();
?>
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
		color: #ffffff;
		position: absolute;
				 
		-webkit-mask-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), color-stop(50%, rgba(0,0,0,.5)), to(rgba(0,0,0,1)));
		}
     

	.openingtitle2:after {
		content : 'INAUGURATION';
		color: #ffffff;
		text-shadow: 0 1px 0 black;
	}
     
    </style>
     <h1 class="openingtitle"> <a> &nbsp</h1><h1 class="openingtitle2" align=center> INAUGURATION </a> </h1>
</body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input class="submitbutton1" type="submit" name="mainmenu" value="Main Menu" align=center>
</form>
<?php 
if (ISSET($_POST['mainmenu'])){
	header("Location: index.php");
}
?>
</html>