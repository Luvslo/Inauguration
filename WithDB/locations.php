<html>
<?php
require("dbc.php");
if (!session_id()) //if session hasnt started, start session
	session_start();
if (!ISSET($finalcommand)){
	$finalcommand="";
}
if (!ISSET($_SESSION['c'])){
	$_SESSION['c']=0;
}

//Level 1 items
if (!ISSET($_SESSION['flashlight'])){ //default positions for all equipment
$_SESSION['flashlight']="ground";	
}if (!ISSET($_SESSION['dice'])){
$_SESSION['dice']="ground";	
}

//There are no items in level 2

//Level 3 items
if (!ISSET($_SESSION['bottle'])){
$_SESSION['bottle']="ground";	
}if (!ISSET($_SESSION['note'])){
$_SESSION['note']="ground";	
}if (!ISSET($_SESSION['spear'])){
$_SESSION['spear']="ground";	
}

//Level 4 items
if (!ISSET($_SESSION['money'])){
$_SESSION['money']="ground";	
}if (!ISSET($_SESSION['key'])){
$_SESSION['key']="ground";	
}if (!ISSET($_SESSION['pizza'])){
$_SESSION['pizza']="ground";	
}if (!ISSET($_SESSION['book'])){
$_SESSION['book']="ground";	
}

//Level 5 items
if (!ISSET($_SESSION['letter'])){
$_SESSION['letter']="ground";	
} if (!ISSET($_SESSION['baby'])){
$_SESSION['baby']="ground";
} if (!ISSET($_SESSION['emptybucket'])){
$_SESSION['emptybucket']="ground";
}if (!ISSET($_SESSION['fullbucket'])){
$_SESSION['fullbucket']="ground";
}

if ((!ISSET($_SESSION['location'])) && (!ISSET($_POST['command']))) {
	$started=0; //upon startup, started is 0
}if ($_SESSION['location']=="beginning" && (!ISSET($_POST['command']))) {
	$started=0;
}
if ((ISSET($_SESSION['location'])) && (ISSET($_POST['command']))) {
	$started=1; //after first move, started is 1
	$command=$_POST['command']; //command value was sometimes randomly lost if not declared on this page
} if (!ISSET($_SESSION['unknown_command'])) {
	$_SESSION['unknown_command']="";//if there is no value in unknown command, there isnt an unknown command
} if (!ISSET($command)){
	$command="";
	$help="";
	$hint="";
} if (!ISSET($errormessage)) {
	$errormessage="";
} if (!ISSET($_SESSION['passedalley'])) {
	$_SESSION['passedalley']=false;
}

if (ISSET($_POST['choice1'])){ //declaring variables if a conversation is ongoing
	$finalcommand=$_POST['hiddenchoice1'];
	$turn=true;
}if (ISSET($_POST['choice2'])){
	$finalcommand=$_POST['hiddenchoice2'];
	$turn=true;
}
$level=$_SESSION['level'];
$name="Jacob";

if ($command!="?" or $command!="help"){ //help command
	$help="";
}if ($command!="hint"){ //hint command
	$hint="";
}
if ($command=="?" or $command=="help"){
	$help="Stuck? Need a little help? <br>Well let me explain this concept of this game for you. Inauguration relies on passing from one dream level to the next one. To do this, you need to complete the current dream. A goal will be set, and if a goal was not set, then the dream will be more linear, and once the story is complete, you will move to the next dream level. 
<br> The command bar reads commands in a 'function, key' way. So if the command is 'go south', the function is go, and the key, is south. Your character will move south. A key could also be in the form of an object, but in this case, the function would have to be take, or pick up, etc.(pick up sticks).	";
} if ($command=="hint"){
	$hint=$_SESSION['hint'];
}

//Level One: Introduction

if ($level=="Introduction"){


if (($command=="" && $started=0) or ($_SESSION['newgame']==true) or ($_SESSION['saveslot']==0)) {

	$_SESSION['location']="beginning"; //these location variables were lost if not used with session, need globals
	$_SESSION['flashlight']="ground";	
	$_SESSION['description']="You're in a pitch black room. There is no sound what-so-ever, although you swear you hear a certain
	classical song, or lullaby in the back of your mind. There is a faint light a little ways away in 
	front of you.";
	$_SESSION['saveslot']="0000";
	$_SESSION['hint']="If the lights the only thing you see, it must be important. Go towards it.";
	$_SESSION['conversation']=false; //a conversation is not taking place
	$_SESSION['continue']=false;//so continue button doesnt pop up
	$_SESSION['newgame']=false; //so session wont be in a loop with the first description and location
}
if (($_SESSION['location']=="beginning") && ($command=="walk towards light" or $command=="walk forward" or $command=="walk forwards" or $command=="go forward" or $command=="go towards it" or $command=="go towards light") or $_SESSION['saveslot']==1) {
	$_SESSION['location']="above flashlight";
	$_SESSION['description']="You reach the light. It's a flashlight.";
	$_SESSION['saveslot']="0001";
	$_SESSION['hint']="To interact, you need to have it. ";
} 
if (($_SESSION['location']=="above flashlight") && ($command=="pick it up" or $command=="pick up flashlight" or $command=="pick up") or ($_SESSION['saveslot']==2)) {
	$_SESSION['location']="above flashlight";
	$_SESSION['flashlight']="inventory";
	$_SESSION['description']="You pick up the flashlight.";
	$_SESSION['saveslot']="0002";
	$_SESSION['hint']="What would you do when want the flashlight to emit light?";
} 
if (($_SESSION['location']=="above flashlight") && ($command=="turn it on" or $command=="turn on" or $command=="use flashlight" or $command=="turn on flashlight") or ($_SESSION['saveslot']==3)) {
	$_SESSION['location']="blank canvas, middle of crowd";
	$_SESSION['description']="The flashlight wont turn on. Instead, the whole room lights up, blindingly bright. As your vision clears, 
	you notice a flat, blank canvas. Filled with hundreds, nearly thousands of people, crowded around you. You look down, there is some weird button on the ground.";
	$_SESSION['saveslot']="0003";
	$_SESSION['hint']="What do you do with buttons?";
	} 
if (($_SESSION['location']=="blank canvas, middle of crowd") && ($command=="talk" or $command=="press button" or $command=="press" or $command=="use button" or $command=="button" or $command=="push button" or $command=="push") or ($_SESSION['saveslot']==4)) {
	$_SESSION['location']="blank canvas, middle of crowd with path";
 	$_SESSION['description']="The crowd separates, opening up one clear and open passageway. To the north, a closed door.";
	$_SESSION['saveslot']="0004";
	$_SESSION['hint']="Where do you want to <b><i> Go? </i></b>";
	}
if ((($_SESSION['location']=="blank canvas, middle of crowd with path") && ($command=="walk towards the door" or $command=="go north" or $command=="north" or $command=="go towards door")) or ($_SESSION['saveslot']=="0005")) {
	$_SESSION['location']="in front of the door";
 	$_SESSION['description']="You walk towards the door. You notice that the door is practically non-existent, almost as if you're
	imagining it, yet it's still there. ";
	$_SESSION['saveslot']="0005";
	$_SESSION['hint']="You gotta get past this closed door. How do you get passed a closed door?";
} 
if (($_SESSION['location']=="in front of the door" && $command=="walk through the door" or  $command=="open door") or ($_SESSION['saveslot']=="0006")) {
	$_SESSION['location']="white room";
 	$_SESSION['description']="The door crumbles at your touch, fading away into nothing. You walk through, into a white room. Two men are
	visable, sitting at a table, staring at you.";
	$_SESSION['saveslot']="0006";
	$_SESSION['hint']="They are still far away, so you want to keep " . "<b><i>" . "go" . "</b></i>" . "ing. Oh look I got an email. It's a <b><i> forward. </b></i>";
} 
if ((($_SESSION['location']=="white room") && ($command=="walk towards them" or $command=="talk to them" or $command=="walk forwards" or $command=="walk forward" or $command=="go forward")) or ($_SESSION['saveslot']=="0007")) {
	$_SESSION['location']="white room, closed off";
 	$_SESSION['description']="You walk towards them. A ferocious cannon noise is heard behind you, and as you turn your head to check, the canvas is 
	gone, and the white room is now closed off, no exit. You turn your head back to face the men, and yet they aren't there. The room
	is now empty, yet you notice a pair of dice right beside your feet.";
	$_SESSION['saveslot']="0007";
	$_SESSION['hint']="You need to have them before you can use them. ";
}
if (($_SESSION['location']=="white room, closed off" && $command=="pick up dice") or ($_SESSION['saveslot']=="0008")) {
	$_SESSION['location']="white room, closed off";
 	$_SESSION['description']="You pick up the pair of dice.";
	$_SESSION['saveslot']="0008";
	$_SESSION['hint']="Roll the dice.";
	$_SESSION['dice']="inventory";
}
if ((($_SESSION['location']=="white room, closed off") && ($command=="roll dice" or $command=="use dice" or $command=="roll" or $command=="roll the dice")) or ($_SESSION['saveslot']=="0009")) {
	$_SESSION['location']="free fall";
 	$_SESSION['description']="You roll the dice. Snake eyes. Moments after the dice hit the ground, the ground shatters, and you immediately 
	fall through. It does not seem like you'll ever stop falling, there is no noticeable bottom. The song you thought you were 
	hearing, is now turning into soft whispers. The whispers are frightening, will you listen, or ignore them?";
	$_SESSION['saveslot']="0009";
	$_SESSION['hint']="Listen or ignore. ";
}if (($_SESSION['location']=="free fall" && $command=="listen") or ($_SESSION['saveslot']=="0010")) {
	$_SESSION['location']="free fall, listening";
 	$_SESSION['description']="You try your hardest to focus on the whispers. You listen closely. Its time to <i> Wake Up </i>";
	$_SESSION['saveslot']="0010";
	$_SESSION['hint']="What are they saying?";
}if (($_SESSION['location']=="free fall" && $command=="ignore") or ($_SESSION['saveslot']=="0011")) {
	$_SESSION['location']="free fall, listening";
 	$_SESSION['description']="You try to ignore the whispers, but they are inevitable. They get louder and louder. Its time to <i> Wake Up </i>";
	$_SESSION['saveslot']="0011";
	$_SESSION['hint']="What are they saying?";
}if (($_SESSION['location']=="free fall, listening" && $command=="wake up") or ($_SESSION['saveslot']=="0012")) {
	$_SESSION['location']="the inauguration";
 	$_SESSION['description']="";
	$_SESSION['saveslot']="0012";
	header("Location: title.php");
}


elseif($command!="" && $started=1) {
	$_SESSION['unknown_command']="Sorry I do not understand that.";
}
}

//Level 2 

if ($level=="Real World") {



	if (($_SESSION['location']=="warehouse") or ($_SESSION['saveslot']=="0013")) {
		$_SESSION['location']="warehouse";
		$_SESSION['description']="You wake up, and get up from the chair, pulling a wire off thats attached to your forehead. Confused, you look around the 
		room. You hear talking behind the door to your East, and there are no other exits. ";
		$_SESSION['saveslot']="0013";
		$_SESSION['conversation']=false;
		$_SESSION['conversation1']=0;
		$_SESSION['hint']="There's only one door in one direction, and you have to go somewhere.";
		
	}
	
	
	
	//Start Dialogue
	if (($_SESSION['location']=="warehouse") && ($command=="east" or $command=="go east" or $command=="walk east" or $command=="walk to door") or ($_SESSION['saveslot']=="0014")) {
		$_SESSION['conversation']=true;
		$_SESSION['choice1']="Yes";
		$_SESSION['choice2']="";
		$_SESSION['location']="Domenico's Office";
		$_SESSION['description']="You walk up to the door, a sign reads <i> 'Domenico's Office' </i>. You enter, you notice an Irish flag hanging up on the wall. Maybe you're in Ireland. When you stop your daydreaming, you notice the man staring at you. 
		<br><br> Dom: <i>'Ahh, " . $name . ", I see that you found your way in. Look, we have a little proposition for you. Would you like to hear it?'</i>";
		$_SESSION['saveslot']="0014";
		$_SESSION['conversation1']=1;
	}
	if ((($_SESSION['location']=="Domenico's Office") && ($finalcommand=="Yes") && ($turn==true)) or ($_SESSION['saveslot']=="0015")) {
		$_SESSION['choice1']="I think so";
		$_SESSION['choice2']="Inception? What's That?";
		$_SESSION['location']="Domenico's Office ";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: Come on, lets go for a little walk. Inauguration. The beginning of... a new system. Have you heard about inception?";
		$_SESSION['saveslot']="0015";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="Domenico's Office ") && ($finalcommand=="Inception? What's That?") && ($turn==true)) or ($_SESSION['saveslot']=="0016")) {
		$_SESSION['choice1']="Yes that sounds sweet";
		$_SESSION['choice2']="No that doesn't sound right";
		$_SESSION['location']="Domenico's hallway";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>Alright, well the idea of inception is travelling through one's mind through dreams, and planting an idea
		inside of their subconscious. here will always be a safe-key in your subconscious, so you know you're always dreaming. For example, a top will never stop spinning, and rolling a pair of dice will always have an outcome of snake eyes.
		What we're trying to do here is above and beyond that. We're trying to travel into the target's subconscious, and destroy an entire strand of memories. Once we do this, is when we will perform the inception. Does this interest you, " . $name . "?'</i>";
		$_SESSION['saveslot']="0016";
		$_SESSION['conversation1']=1;
		$turn=false;
		
	}	
		if (ISSET($_POST['choice1'])){ // these must be declared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="Domenico's Office ") && ($finalcommand=="I think so") && ($turn==true)) or ($_SESSION['saveslot']=="0017")) {
		$_SESSION['choice1']="Yes that sounds sweet";
		$_SESSION['choice2']="No that doesn't sound right";
		$_SESSION['location']="Domenico's hallway";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>Alright, so you know that the idea of inception is travelling through one's mind through dreams, and planting an idea
		inside of their subconscious. And how there will always be a safe-key in your subconscious, so you know you're always dreaming right? For example, a top will never stop spinning, and rolling a pair of dice will always have an outcome of snake eyes.
		What we're trying to do here is above and beyond that. We're trying to travel into the target's subconscious, and destroy an entire strand of memories. Once we do this, is when we will perform the inception. Does this interest you, " . $name . "?'</i>";
		$_SESSION['saveslot']="0017";
		$turn=false;

	}	
		if (ISSET($_POST['choice1'])){ // these must be declared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}

	if ((($_SESSION['location']=="Domenico's hallway") && ($finalcommand=="Yes that sounds sweet")) or ($_SESSION['saveslot']=="0018")) {
		$_SESSION['choice1']="Yeah, keep going";
		$_SESSION['choice2']="Not really";
		$_SESSION['location']="in front of the stairs";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'Perfect, I'm really happy we're on the same page here now. So heres the details. The target's name is <b>Carter Ladd</b>, he owns the multi-billion dollar company, AROS.
		Ladd built the company from the ground up with his wife Jennifer. On a buisness flight a few weeks ago, Jennifer's plane went down, and  Ladd is so devastated that he cannot run his company any longer. 
		The problem with this, is that AROS funds our research, and no other company thinks this is worth while. Plus, we may be able to scam a couple more million off of em. You following?'</i>";
		$_SESSION['saveslot']="0018";
		$turn=false;
	}	
		if (ISSET($_POST['choice1'])){ // these must be declared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}

	if ((($_SESSION['location']=="infront of the stairs") && ($finalcommand=="Not really")) or ($_SESSION['saveslot']=="0023")) {
		$_SESSION['location']="walking up the stairs";
		$_SESSION['choice1']="How can you get me home?";
		$_SESSION['choice2']="";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'You know what, it doesnt even matter. All that matters is that my company is going to stay in business. And you're gonna go home.'</i>";
		$_SESSION['saveslot']="0023";
		$turn=false;
	}
		if (ISSET($_POST['choice1'])){ // these must be declared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="Domenico's hallway") && ($finalcommand=="How can you get me home?")) or ($_SESSION['saveslot']=="0024")) {
		$_SESSION['choice1']="Alright, Goodnight Dom";
		$_SESSION['choice2']="";
		$_SESSION['location']="some bedroom";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'Money is a very powerful thing my friend. It can do wonders. Go to sleep now. When you wake up in the morning, go downstairs, to the right, and go straight out the doors. There will a car waiting for you. The chauffeur, Harold, will already be in there. 
		He'll take you where you need to go. Ladd is taking his private jet back to the states, and since we're a major part of his company, we'll have full and easy access to him. The flight from Dublin to California is about ten and a half hours, so use your time wisely.<br><br>
		We'll drug all of our drinks, and once we're out, our inside man will hook us up to the connector, and we'll all be dreaming the same dream, there its up to you to figure out how to perform the Inauguration. Now, get some sleep.<br><br>
		Oh yeah, my name's Dom.'</i>";
		$_SESSION['saveslot']="0024";
		$turn=false;
		$_SESSION['conversation']=false;
	}
		if (ISSET($_POST['choice1'])){ // these must be declared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="Domenico's hallway") && ($finalcommand=="No that doesn't sound right")) or ($_SESSION['saveslot']=="0019")) {
		$_SESSION['choice1']="What could go wrong?";
		$_SESSION['choice2']="";
		$_SESSION['location']="in front of the stairs";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'Suck it up buttercup. We know everthing about you and who you are. We know what you've done and why. If you want to get back there, you're going to listen to me. <br><br>So heres the details. The target's name 
		is <b>Carter Ladd</b>, he owns the multi-billion dollar company, AROS.Ladd built the company from the ground up with his wife Jennifer. On a buisness flight a few weeks ago, Jennifer's plane went down, and  Ladd is so devastated that he cannot run his company any longer. 
		The problem with this, is that AROS funds our research, and no other company thinks this is worth while. Plus, we may be able to scam a couple more million off of em. And there's only a few things that can go wrong.'</i>";
		$_SESSION['saveslot']="0019";
		$turn=false;
	}
		if (ISSET($_POST['choice1'])){ // these must be declared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}

	if ((($_SESSION['location']=="in front of the stairs") && ($finalcommand=="Yeah, keep going")) or ($_SESSION['saveslot']=="0020")) {
		$_SESSION['location']="walking up the stairs";
		$_SESSION['choice1']="Okay, I'm not worried";
		$_SESSION['choice2']="So how do we get to Ladd?";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'Well, usually when you dream, you'll just wake up if you die. And when youre dreaming, your mind can actually process ideas faster, and the further you are into dreams and levels, the slower real time will
		move in relation to dream time. One hour in the dream is equal to five minutes in real time. One hour in a deeper level will equal five minutes in the dream level above it. And so on. <br><br> In order to perform the Inauguration, you will have to be under the influence of a powerful sedative. 
		This sedative will actually not allow you to wake up until the effects ware off. This means if you die.. you can't wake up. Your mind has nowhere to go, so it will send itself off to <i> limbo </i> ,  the deepest level of dreaming.
		If you lose sense of reality, you will also get lost inside your dreams. You'll be sent to limbo, and you wont know the difference between that and actually living. <br><br> Basically, if you mess up, you'll dream forever. And you dont want that.'</i>";
		$_SESSION['saveslot']="0020";
		$turn=false;
	}		
		if (ISSET($_POST['choice1'])){ // these must be declared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}

	if ((($_SESSION['location']=="in front of the stairs") && ($finalcommand=="What could go wrong?")) or ($_SESSION['saveslot']=="0021")) {
		$_SESSION['location']="some bedroom";
		$_SESSION['choice1']="Alright, Goodnight Dom";
		$_SESSION['choice2']="";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'Okay well first, I should tell you this. Usually when you dream, you'll just wake up if you die. And when youre dreaming, your mind can actually process ideas faster, and the further you are into dreams and levels, the slower real time will
		move in relation to dream time. One hour in the dream is equal to five minutes in real time. One hour in a deeper level will equal five minutes in the dream level above it. And so on. <br><br> In order to perform the Inauguration, you will have to be under the influence of a powerful sedative. 
		This sedative will actually not allow you to wake up until the effects ware off. This means if you die.. you can't wake up. Your mind has nowhere to go, so it will send itself off to <i> limbo </i> ,  the deepest level of dreaming.
		If you lose sense of reality, you will also get lost inside your dreams. You'll be sent to limbo, and you wont know the difference between that and actually living. <br><br> Basically, if you mess up, you'll dream forever. And you dont want that.'</i>";
		$_SESSION['saveslot']="0021";
		$turn=false;
		
	}
		if (ISSET($_POST['choice1'])){ // these must be delcared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}

	if ((($_SESSION['location']=="walking up the stairs") && ($finalcommand=="Okay, I'm not worried")) or ($_SESSION['saveslot']=="0022")) {
		$_SESSION['location']="some bedroom";
		$_SESSION['choice1']="Okay, Goodnight Dom";
		$_SESSION['choice2']="";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'Perfect, go to sleep now. When you wake up in the morning, go downstairs, to the right, and go straight out the doors. There will a car waiting for you. The chauffeur, Harold, will already be in there. 
		He'll take you where you need to go. Ladd is taking his private jet back to the states, and since we're a major part of his company, we'll have full and easy access to him. The flight from Dublin to California is about ten and a half hours, so use your time wisely.<br><br>
		We'll drug all of our drinks, and once we're out, our inside man will hook us up to the connector, and we'll all be dreaming the same dream, there its up to you to figure out how to perform the Inauguration. Now, get some sleep.<br><br>
		Oh yeah, my name's Dom.'</i>";
		$_SESSION['saveslot']="0022";
		$turn=false;
	}
		if (ISSET($_POST['choice1'])){ // these must be delcared again or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;

		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}

	if ((($_SESSION['location']=="walking up the stairs") && ($finalcommand=="So how do we get to Ladd?")) or ($_SESSION['saveslot']=="0025")) {
		$_SESSION['location']="some bedroom";
		$_SESSION['choice1']="Okay, Goodnight Dom";
		$_SESSION['choice2']="";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i>'Here's the plan. When you wake up in the morning, go downstairs, to the right, and go straight out the doors. There will a car waiting for you. The chauffeur, Harold, will already be in there. 
		He'll take you where you need to go. Ladd is taking his private jet back to the states, and since we're a major part of his company, we'll have full and easy access to him. The flight from Dublin to California is about ten and a half hours, so use your time wisely.<br><br>
		We'll drug all of our drinks, and once we're out, our inside man will hook us up to the connector, and we'll all be dreaming the same dream, there its up to you to figure out how to perform the Inauguration. Now, get some sleep.<br><br>
		Oh yeah, my name's Dom.'</i>";
		$_SESSION['saveslot']="0025";
		$turn=false;
	}
	
	//End Dialogue
	
	if ((($_SESSION['location']=="some bedroom") && ($finalcommand=="Okay, Goodnight Dom")) or ($_SESSION['saveslot']=="0026")) {
		$_SESSION['conversation']=false;
		$_SESSION['location']="some bedroom";
		$_SESSION['description']="Dom leaves the room. You look around, the room is very bare. There's a mattress on the ground, no bed frame. Looking at the bed, even though its really bare, reminds you of how exhausted you are, even for dreaming all day.";
		$_SESSION['saveslot']="0026";
		$turn=false;
		$_SESSION['hint']="If you're tired, you should sleep.";
	}if ((($_SESSION['location']=="some bedroom") && ($command=="go to sleep" or $command=="sleep" or $command=="go to bed" or $command=="go to sleep" or $command=="use bed")) or ($_SESSION['saveslot']=="0027")) {
		$_SESSION['location']="bed";
		$_SESSION['description']="You go to bed.";
		$_SESSION['continue']=true;
		$continue=false;
		$_SESSION['saveslot']="0027";
		$turn=false;
	}		if (!ISSET($_POST['continue'])){ //to display continue button, must be reset because locations is linked before commands, so this is seen first
				$continue=false;
			}
			if (ISSET($_POST['continue'])){
				$continue=true;
	} if ((($_SESSION['location']=="bed") && ($continue==true)) or ($_SESSION['saveslot']=="0028")) {
		$_SESSION['location']="some bedroom";
		$_SESSION['description']="You wake up to a blasting alarm. It's 8:30. You're laying in bed.";
		$_SESSION['continue']=false;
		$continue=false;
		$_SESSION['saveslot']="0028";
		$_SESSION['hint']="The alarm is still going.";
	}if ((($_SESSION['location']=="some bedroom") && ($command=="turn off alarm" or $command=="turn it off" or $command=="stop alarm")) or ($_SESSION['saveslot']=="0029")) {
		$_SESSION['location']="top of the stairs";
		$_SESSION['description']="You turn off the alarm. You remember Dom's orders. You get up, walk out of the room, and stand by the top of the stairs.";
		$_SESSION['saveslot']="0029";
		$_SESSION['hint']="You didn't read the conversation, you just skipped ahead didn't you? Go downstairs.";
	}if ((($_SESSION['location']=="top of the stairs") && ($command=="walk down the stairs" or $command=="walk downstairs" or $command=="walk" or $command=="walk down stairs" or $command=="go downstairs" or $command=="go down the stairs" or $command=="go down stairs")) or ($_SESSION['saveslot']=="0030")) {
		$_SESSION['location']="bottom of the stairs";
		$_SESSION['description']="You reach the bottom of the stairs. You forgot how small this warehouse really is. There are two closed doors, one to the left, and one to the right.";
		$_SESSION['saveslot']="0030";
		$_SESSION['hint']="Gotta go either left, or right.";
	}if ((($_SESSION['location']=="bottom of the stairs") && ($command=="open" or $command=="open door" or $command=="open the door" or $command=="open doors" or $command=="walk through door")) or ($_SESSION['saveslot']=="0031")) {
		$_SESSION['location']="bottom of the stairs";
		$_SESSION['description']="Which one?";
		$_SESSION['saveslot']="0031";
		$_SESSION['hint']="Gotta go either left, or right.";
	}if ((($_SESSION['location']=="bottom of the stairs") && ($command=="open the right door" or $command=="right door" or $command=="open the door to the right" or $command=="open right door" or $command=="right" or $command=="go right" or $command=="walk right" or $command=="turn right")) or ($_SESSION['saveslot']=="0032")) {
		$_SESSION['location']="long hallway";
		$_SESSION['description']="You open the door to the right. It goes into an empty hallway. You see a big door at the end of the hallway, it looks like it goes outside.";
		$_SESSION['saveslot']="0032";
		$_SESSION['hint']=" towards door.";
	}if ((($_SESSION['location']=="bottom of the stairs") && ($command=="open the left door" or $command=="left door" or $command=="open the door to the left" or $command=="open left door" or $command=="left" or $command=="go left" or $command=="walk left" or $command=="turn left")) or ($_SESSION['saveslot']=="0033")) {
		$_SESSION['location']="long hallway";
		$_SESSION['description']="You open the door to the left. It's the bathroom. Nice one. You walk out and go through the right door. It goes into an empty hallway. You see a big door at the end of the hallway, it looks like it goes outside.";
		$_SESSION['saveslot']="0033";
		$_SESSION['hint']="go towards door.";
	}if ((($_SESSION['location']=="long hallway") && ($command=="walk forward" or $command=="walk towards the door" or $command=="open door" or $command=="walk" or $command=="walk towards door" or $command=="go outside" or $command=="forward" or $command=="go towards door")) or ($_SESSION['saveslot']=="0034")) {
		$_SESSION['location']="outside limo";
		$_SESSION['description']="You continue walking and reach the door. You open it and go outside. You see a limo coming to pick you up, which looks fairly odd as you're in a worn out warehouse. You walk towards the limo door.";
		$_SESSION['saveslot']="0034";
		$_SESSION['hint']="You have to get in the limo to get somewhere.";
	}if ((($_SESSION['location']=="outside limo") && ($command=="open door" or $command=="get in" or $command=="get in the limo" or $command=="open limo door" or $command=="get in limo" or $command=="open the limos door" or $command=="open the limo door")) or ($_SESSION['saveslot']=="0035")) {
		$_SESSION['location']="inside limo";
		$_SESSION['description']="You get in the limo. The driver looks at you and says, <br><br> '<i> Hello there, you must be " . $name . ".' </i> <br><br> You: Yeah that's me! and you must be ... _______!";
		$_SESSION['saveslot']="0035";
		$_SESSION['hint']="Once again, you weren't listening to the previous conversation were you? What did Dom say the drivers name was?";
		$_SESSION['continue']=false;
		if (ISSET($_POST['perform'])) {
			$_SESSION['c']=$_SESSION['c'] + 1;
			$command="";
		}
	}if ((($_SESSION['location']=="inside limo") && ($command!="Harold" or $command!="harold" or $command!="open door" or $command!="get in" or $command!="get in the limo" or $command!="open limo door" or $command!="get in limo" or $command!="open the limos door" or $command!="open the limo door") && $_SESSION['c']>=3) or ($_SESSION['saveslot']=="0037")) {
		$_SESSION['location']="inside limo";
		$_SESSION['description']=" <i> 'Hello there, you must be " . $name . ".' </i> <br><br> You: 'Yeah that's me! and you must be " . $command . "!' <br><br> Harold: <i> 'Uhh.. my name is Harold.. Ill just get you to the airport.' </i><br><br> The drive seems long, and since you got woken up rather earlier than you're used to, you figure that you don't
		need to stay awake for Harold, so you can either go to sleep, or enjoy the ride.";
		$_SESSION['saveslot']="0037";
		$_SESSION['continue']=false;
		$_SESSION['hint']="Wow you forgot his name, you should probably enjoy the ride so you can't be any more rude";

	}
	if ((($_SESSION['location']=="inside limo") && ($command=="Harold" or $command=="harold") && $_SESSION['c']>=3) or ($_SESSION['saveslot']=="0036")) {
		$_SESSION['location']="inside limo";
		$_SESSION['description']=" <i> 'Hello there, you must be " . $name . ".' </i> <br><br> You: 'Yeah that's me! and you must be Harold!' <br><br> Harold: <i> 'Thats me! Ill get you to the airport as fast as possible.' </i><br><br> The drive seems long, and since you got woken up rather earlier than you're used to, you figure that you don't
		need to stay awake for Harold, so you can either go to sleep, or enjoy the ride.";
		$_SESSION['saveslot']="0036";
		$_SESSION['c']=0;
		$_SESSION['continue']=false;
		$_SESSION['hint']="Hey, you remembered! So you can either <i> go to sleep </i> or <i> enjoy the ride </i>";
	}
	if ((($_SESSION['location']=="inside limo") && ($command=="sleep" or $command=="go to sleep")) or ($_SESSION['saveslot']=="0038")) {
		$_SESSION['location']="driving";
		$_SESSION['description']="You quickly fall asleep.";
		$_SESSION['saveslot']="0038";
		$_SESSION['continue']=true;
		$_SESSION['c']=0; // resetting the value for later
	}if ((($_SESSION['location']=="inside limo") && ($command=="enjoy the ride" or $command=="enjoy ride")) or ($_SESSION['saveslot']=="0040")) {
		$_SESSION['location']="driving";
		$_SESSION['description']="You try to enjoy the ride. You then realize you're way too tired and you quickly fall asleep anyways.";
		$_SESSION['saveslot']="0040";
		$_SESSION['continue']=true;
		$_SESSION['c']=0; //resetting the value for later
	}
	if (!ISSET($_POST['continue'])){ //to display continue button, must be reset because locations is linked before commands, so this is seen first
				$continue=false;
			}
			if (ISSET($_POST['continue'])){
				$continue=true;
	}if ((($_SESSION['location']=="driving") && ($continue==true)) or ($_SESSION['saveslot']=="0041")) {
		$_SESSION['location']="the private jet";
		$_SESSION['description']="You wake up a couple hours later. It looks like you're at the airport. Instead of taking the normal route to the terminals, Harold pulls into a small alley, which opens up into a private plane containment. <br><br> You get onto the private jet, and take your seat. The pilot makes an announcement.. <br><br> <i> 'Goodmorning everyone! You are currently on AEOS flight 341, on route to California, USA.
		A flight of 10 hours and 30 minutes., giving an approximate time of arrival of 9pm. Please <b> buckle up </b> and have a great flight.' <i>";
		$_SESSION['saveslot']="0041";
		$_SESSION['hint']="When in doubt, be <i> bold </i>";
		$_SESSION['continue']=false;
		$continue=false;
		$_SESSION['c']=0;
	}if ((($_SESSION['location']=="the private jet") && ($command=="buckle up" or $command=="buckle")) or ($_SESSION['saveslot']=="0042")) {
		$_SESSION['location']="the private jet, talking to the attendant";
		$_SESSION['description']="You buckle up and prepare for the flight. The plane takes off. A couple of hours into the flight, the flight attendant comes up to you. <br><br><i> 'What would you like to drink sir?' </i>";
		$_SESSION['saveslot']="0042";
		$_SESSION['hint']="She'll get you anything that you want in the world.";
		$_SESSION['continue']=false;
		if (ISSET($_POST['perform'])) {
			$_SESSION['c']=$_SESSION['c'] + 1;
			$command="";
		}
	}if ((($_SESSION['location']=="the private jet, talking to the attendant") && ($command!="buckle up" or $command!="buckle") && $_SESSION['c']>=4) or ($_SESSION['saveslot']=="0043")) {
		$_SESSION['location']="the commencement";
		$command=$_POST['command']; //command value was randomly lost with the previous "!=", needed to be declared here
		$_SESSION['description']="<i> And here's your " . $command . " sir.' </i><br><br> Now, you have the " . $command . ", and the Inauguration has begun...";
		$_SESSION['continue']=true; 
		$continue=false;
		$_SESSION['saveslot']="0043";

	}if (!ISSET($_POST['continue'])){ //to display continue button, must be reset because locations is linked before commands, so this is seen first
				$continue=false;
			}
			if (ISSET($_POST['continue'])){
				$continue=true;
	}if ((($_SESSION['location']=="the commencement") && ($continue==true)) or ($_SESSION['saveslot']=="0044")) {
		$continue=false;
		$_SESSION['continue']=false;
		//End level
		$_SESSION['level']="The Island"; 
		$_SESSION['location']="the shore";
		$_SESSION['saveslot']="0044";
		header("Location: main.php"); //must refresh the page when changing levels or else previous location and description will stay
	}
	
}


//Level 3
if ($level=="The Island"){

	if ((($_SESSION['location']=="the shore")) or ($_SESSION['saveslot']=="0045")) {
		$health=5; //resets after every level, level two was the first where you can lose health
		$continue=false;
		$_SESSION['continue']=false;
			if (ISSET($_POST['command'])) {
				$command=$_POST['command']; //command value was randomly lost with the previous "!=", needed to be declared here
			}
		$_SESSION['level']="The Island"; 
		$_SESSION['location']="the shore";
		$_SESSION['description']="You wake up. Laying down the shore of some beach. You look around, and there is no sign of life what-so-ever. To the south, is a forest. But to the north, you see an intriguing little bottle, that has been washed up on the shore.";
		$_SESSION['saveslot']="0045";
		$_SESSION['hint']="The bottle seem's pretty important. Go in that direction.";
	} if ((($_SESSION['location']=="the shore") && ($command=="go north" or $command=="north" or $command=="towards bottle")) or ($_SESSION['saveslot']=="0046")) {
		$_SESSION['location']="the edge of the shore";
		$_SESSION['description']="You walk towards the bottle. It looks like there is a piece of paper inside.";
		$_SESSION['saveslot']="0046";
		$_SESSION['hint']="To use it, you need to pick it up.";
	}if ((($_SESSION['location']=="the edge of the shore") && ($command=="pick it up" or $command=="pick up bottle" or $command=="take bottle" or $command=="pick up")) or ($_SESSION['saveslot']=="0047")) {
		$_SESSION['location']="the edge of the shore";
		$_SESSION['bottle']="inventory";
		$_SESSION['description']="You pick up the bottle with the note inside.";
		$_SESSION['saveslot']="0047";
		$_SESSION['hint']="If you want to read the note, open bottle.";
	}if ((($_SESSION['location']=="the edge of the shore") && ($command=="open bottle" or $command=="read paper" or $command=="read note" or $command=="use bottle" or $command=="open the bottle")) or ($_SESSION['saveslot']=="0048")) {
		$_SESSION['location']="the edge of the shore";
		$_SESSION['description']="You open the bottle, and read the note... <br><br> <i> 'I miss you Daddy. I miss Mummy too. Its been like two whole months. Grandma and Grandpa's is fun, but they're not you. We've been asking about you two, and nobody will explain where you went to. When are you coming home? Please come home. -Charlotte' </i><br><br>You decide to keep
		the bottle in case you want to read it later. You figure that the note was from Ladd's Daughter. You think about your kids, Vanessa, and Shaun, and you get this, strange feeling. It doesn't feel too good. You absolutely need to get this job done now, you need to see them. Whatever it takes. <br><br> You look south, towards the forest.";
		$_SESSION['saveslot']="0048";
		$_SESSION['hint']="The forest is to your south, go there.";
	}if ((($_SESSION['location']=="the shore") && ($command=="go south" or $command=="south" or $command=="go towards forest" or $command=="walk towards forest" or $command=="walk south")) or ($_SESSION['saveslot']=="0067")) {
		$_SESSION['location']="the edge of the forest";
		$_SESSION['description']="You walk into the forest. To your west, you can faintly see that there is a family of deer. To your east, there is a coconut tree. While thinking of the possibilities, a spear spawns in front of you, and you pick it up. It is a dream, after all.";
		$_SESSION['saveslot']="0067";
		$_SESSION['hint']="Go wherever you want my friend.";
		$_SESSION['spear']="inventory";
	}if ((($_SESSION['location']=="the edge of the shore") && ($command=="go south" or $command=="south" or $command=="go towards forest" or $command=="walk towards forest" or $command=="walk south")) or ($_SESSION['saveslot']=="0049")) {
		$_SESSION['location']="the edge of the forest";
		$_SESSION['description']="You walk into the forest. To your west, you can faintly see that there is a family of deer. To your east, there is a coconut tree. While thinking of the possibilities, a spear spawns in front of you, and you pick it up. It is a dream, after all.";
		$_SESSION['saveslot']="0049";
		$_SESSION['hint']="Go wherever you want my friend.";
		$_SESSION['spear']="inventory";
	}if ((($_SESSION['location']=="the edge of the forest") && ($command=="go west" or $command=="go towards deer" or $command=="go after deer" or $command=="hunt deer" or $command=="west")) or ($_SESSION['saveslot']=="0050")) {
		$_SESSION['location']="the test";
		$_SESSION['description']="You slowly walk towards the west, trying not to frighten the deer, or give away your position. Slowly, you get close enough to be able to attack. <br><br> As you're getting ready, you feel warm air being blown down your neck, and a growl... Scared to look behind you, you slowly step forward and turn around, to face a black bear, twice the size of you.";
		$_SESSION['saveslot']="0050";
		$_SESSION['hint']="Violence is not always the best option. But running? If you're brave. That's scarier than the bear.";
	}if ((($_SESSION['location']=="the edge of the forest") && ($command=="go east" or $command=="go towards coconuts" or $command=="get coconuts" or $command=="find coconuts" or $command=="east")) or ($_SESSION['saveslot']=="0051")) {
		$_SESSION['location']="the test";
		$_SESSION['description']="You walk towards the east, choosing the coconuts over harming an animal. Slowly, you look for the positions of the coconuts in the tree, and get ready to throw your spear. <br><br> As you're getting ready, you feel warm air being blown down your neck, and a growl... Scared to look behind you, you slowly step forward and turn around, to face a black bear, twice the size of you.";
		$_SESSION['saveslot']="0051";
		$_SESSION['hint']="Violence is not always the best option. But running? If you're brave. That's scarier than the bear.";
	}if ((($_SESSION['location']=="the test") && ($command=="attack bear" or $command=="attack" or $command=="attack the bear" or $command=="throw spear" or $command=="throw the spear" or $command=="fight the bear" or $command=="fight bear" or $command=="fight" or $command=="throw the spear at the bear" or $command=="throw the spear at bear")) or ($_SESSION['saveslot']=="0052")) {
		$_SESSION['location']="the test";
		$_SESSION['description']="You try to attack the bear. Wrong choice. Sensing your actions, the bear attacks you first, severely damaging you.";
		$health=$health-3;
		$_SESSION['saveslot']="0052";
		$_SESSION['hint']="Maybe don't hit it again. Either run, or be nice to it.";
	}if ((($_SESSION['location']=="the test") && ($command=="run" or $command=="run away" or $command=="run from the bear" or $command=="back away" or $command=="start running")) or ($_SESSION['saveslot']=="0053")) {
		$_SESSION['location']="the test, running, obstacle one";
		$_SESSION['description']="You run from the bear, and it begins running right behind you. With your adrenaline rushing, you notice a fallen branch, yet still connected to the tree, about 20 meters ahead. It looks as if you can either slide under it, jump over it, or take the long way around.";
		$_SESSION['saveslot']="0053";
		$_SESSION['hint']="Jump, Slide, or walk around.";
	}if ((($_SESSION['location']=="the test, running, obstacle one") && ($command=="slide under branch" or $command=="slide" or $command=="slide under the branch" or $command=="slide under it" or $command=="run around" or $command=="take long way around" or $command=="go around")) or ($_SESSION['saveslot']=="0055")) {
		$_SESSION['location']="the test, running, obstacle two";
		$_SESSION['description']="You successfully get around the branch, which actually slows down the bear. But coming up, there are two paths, one going up a hill, and one going down. You may lose speed if you go up the hill, but you can see where the path is headed. Going down the hill, will allow you to run faster, but you cannot see where the path may lead.";
		$_SESSION['saveslot']="0055";
		$_SESSION['hint']="Run up hill, or run down hill?";
	}if ((($_SESSION['location']=="the test, running, obstacle one") && ($command=="jump over branch" or $command=="jump" or $command=="jump over the branch" or $command=="jump over it")) or ($_SESSION['saveslot']=="0056")) {
		$_SESSION['location']="the test";
		$_SESSION['description']="You try to jump over the branch, but instead, you trip and fall, hurting yourself. The bear catches up to you. It does not move. It does not attack. It actually seems rather friendly.";
		$_SESSION['saveslot']="0056";
		$_SESSION['hint']="What do you do with a cute, friendly animal who wants attention?";
	}if ((($_SESSION['location']=="the test, running, obstacle two") && ($command=="go up hill" or $command=="run up hill" or $command=="second path" or $command=="run up")) or ($_SESSION['saveslot']=="0057")) {
		$_SESSION['location']="the test";
		$_SESSION['description']="You run up the path with the upwards hill. You lose lots of speed and the bear quickly catches up, scared, you trip and fall. The bear waits. You get up, and it doesn't move. IT doesn't attack. IT seems rather friendly.";
		$_SESSION['saveslot']="0057";
		$_SESSION['hint']="What do you do with a cute, friendly animal who wants attention? Just pet it.";
	}if ((($_SESSION['location']=="the test, running, obstacle two") && ($command=="go down hill" or $command=="run down hill" or $command=="first path" or $command=="run down")) or ($_SESSION['saveslot']=="0058")) {
		$_SESSION['location']="the test, running, obstacle three";
		$_SESSION['description']="You run down the hill and quickly gain speed, it seems like you're losing the bear, but then as you pull out of the forest, you're standing directly in front of the ocean. You can run left, back into the forest, or right, along the shore.";
		$_SESSION['saveslot']="0058";
		$_SESSION['hint']="There's two things you can do here.";
	}if ((($_SESSION['location']=="the test, running, obstacle three") && ($command!="go down hill" or $command!="run down hill" or $command!="first path" or $command!="run down")) or ($_SESSION['saveslot']=="0059")) {
		$_SESSION['location']="the test";
		$_SESSION['description']="Before you can move, the bear is directly in front of you. You can no longer run. The bear does not move. It does not attack. It actually seems rather friendly.";
		$_SESSION['saveslot']="0059";
		$_SESSION['hint']="What do you do with a cute, friendly animal who wants attention? Just pet it.";
	}if ((($_SESSION['location']=="the test") && ($command=="befriend bear" or $command=="befriend" or $command=="stay still" or $command=="dont move" or $command=="be nice" or $command=="be friendly" or $command=="pet the bear" or $command=="move closer" or $command=="get closer" or $command=="talk to the bear" or $command=="talk" or $command=="pet bear" or $command=="pet it" or $command=="pet")) or ($_SESSION['saveslot']=="0054")) {
		$_SESSION['location']="the test";
		$_SESSION['description']="You slowly walk towards the bear. It does not move at all. You try and talk to it, and it responds well. You get closer, and then, you pet the bear. Slowly, everything around you turns white, until it's only you and then the bear, and then it's only you. Everything feels so relaxed. Almost as if you could just sleep, and dream And as it turns out, that's exactly what you do.";
		$_SESSION['saveslot']="0054";
		$_SESSION['spear']="ground";//items are lost when another level is entered 
		$_SESSION['flashlight']="ground";
		$_SESSION['continue']=true; 
		$continue=false;

	}	
	

	
	if (!ISSET($_POST['continue'])){ //to display continue button, must be reset because locations is linked before commands, so this is seen first
				$continue=false;
			}
			if (ISSET($_POST['continue'])){
				$continue=true;
		}
		if ((($_SESSION['location']=="the test") && ($continue==true)) or ($_SESSION['saveslot']=="0060")) {
		$continue=false;
		$_SESSION['continue']=false;
		$_SESSION['level']="The City";
		$_SESSION['location']="the room";
		$_SESSION['saveslot']="0060";
		header("Location: main.php"); //must refresh the page when changing levels or else previous location and description will stay
	}
	//End Level
}


//Level 4
if ($level=="The City") {
		
		//healing
		if ($_SESSION['pizza']=="inventory") {
			if ($command=="eat pizza" or $command=="pizza" or $command=="heal" or $command=="pizza plox") {
				$_SESSION['health']=$_SESSION['health']+5;
				$_SESSION['pizza']="ground";
				$command=="";
			}
		}
		
	if (($_SESSION['location']=="the room") or ($_SESSION['saveslot']=="0061")) {
		$_SESSION['description']="You come to in a small, cornered off room. There is a door in front of you.";
		$_SESSION['saveslot']="0061";
		$_SESSION['hint']="Maybe open that door.";
		$_SESSION['location']="safehouse";
	}	if ((($_SESSION['location']=="safehouse") && ($command=="open door" or $command=="open the door" or $command=="go to door" or $command=="door")) or ($_SESSION['saveslot']=="0062")) {
		$_SESSION['description']="You walk through the door. You see Dom waiting for you.";
		$_SESSION['saveslot']="0062";
		$_SESSION['location']="safehouse";
		$_SESSION['conversation']=true; //start dialogue
		$turn=false;
		$_SESSION['choice1']="Dom!";
		$_SESSION['choice2']="";
		$_SESSION['location']="safehouse";
		$_SESSION['conversation1']=1;
	}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="safehouse") && ($finalcommand=="Dom!") && ($turn==true)) or ($_SESSION['saveslot']=="0063")) {
		$_SESSION['choice1']="How do we get there?";
		$_SESSION['choice2']="";
		$_SESSION['location']="safehouse";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: There you are! how was your commencement? Ah never mind. This dream we're in, this is Ladd's most feared memory. Its when he was kidnapped by Sony's gang. His memory ends when he is rescued, so all we have to do is go get him, and he'll even be able to come to the next dream levels with us. 
		Right now, he is being held at some barn aross town. ";
		$_SESSION['saveslot']="0063";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="safehouse") && ($finalcommand=="How do we get there?") && ($turn==true)) or ($_SESSION['saveslot']=="0068")) {
		$_SESSION['choice1']="I'm the architect? What does that mean?";
		$_SESSION['choice2']="";
		$_SESSION['location']="safehouse";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: That's all up to you. You're the architect here.";
		$_SESSION['saveslot']="0068";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="safehouse") && ($finalcommand=="I'm the architect? What does that mean?") && ($turn==true)) or ($_SESSION['saveslot']=="0064")) {
		$_SESSION['choice1']="Okay, let's go";
		$_SESSION['choice2']="";
		$_SESSION['location']="safehouse";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: <i> 'You're creating the dream. You didn't know that? Ladd's the dreamer, he transfers the ideas to you, and you create them into something amazing. Why do you think we brought you in? <br><br> Oh yeah, you'll need this, just in case, money still has value in dreams. Now get going.' </i>";
		$_SESSION['saveslot']="0064";
		$turn=false;
		$_SESSION['money']="inventory";
	}	if ((($_SESSION['location']=="safehouse") && ($finalcommand=="Okay, let's go")) or ($_SESSION['saveslot']=="0065")) {
		$_SESSION['location']="outside safehouse";
		$_SESSION['saveslot']="0065";
		$continue=false;
		$_SESSION['conversation']=false;
	//end dialogue
	}	
	
//start open world gameplay
	
		if ($_SESSION['location']=="outside safehouse" or $_SESSION['saveslot']=="0070") {
			$_SESSION['description']="You walk outside. To your south, you see the library. To your west, there are visible town houses, though they look worn out, and not like a place where you would want to be. To your east, you see East Side Marios. Eh Batta Boom Batta Bing!";
			$_SESSION['saveslot']="0070";
			$_SESSION['hint']="<i> go (direction) </i>";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go south" or $command=="go to library" or $command=="south" or $command=="library" or $command=="go towards library" or $command=="walk to library" && $_SESSION['c']>=3) {
					$_SESSION['location']="library";
					$_SESSION['c']=0;
					$command=""; //commands have to be reset. if not, then game will skip over locations, since many are the same command
					
				}if ($command=="go east" or $command=="go to east side marios" or $command=="east" or $command=="east side marios" or $command=="go towards east side marios" or $command=="walk to east side marios" && $_SESSION['c']>=3) {
					$_SESSION['location']="east side marios";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go west" or $command=="go to town houses" or $command=="west" or $command=="town houses" or $command=="go towards town houses" or $command=="walk to town houses" && $_SESSION['c']>=3) {
					$_SESSION['location']="town houses";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go north" or $command=="go back" && $_SESSION['c']>=3) {
					$errormessage="The door has locked. It is not possible to get back inside.";
					$_SESSION['c']=0;
					$command="";
					
				}
		}	
		if ($_SESSION['location']=="library") {
			$_SESSION['description']="You reach the library. All lights are off, and it looks closed, but it looks like there is a book on the ground, and if you go up the stairs, you'll reach it. The town hall is just meters away, in front of you. A road curves off to your left, down Marietta Street, and heads to what looks like a hockey arena. In the other direction, a very dark, sketchy, alley is present.";
			$_SESSION['saveslot']="0071";
			$_SESSION['hint']="<i> go (direction) </i> I think that book sounds pretty interesting. Or if not, the alley is to your right, or your west, since you're facing south. The area is to your left, or your east.";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;

				}
				if ($command=="go up the stairs" or $command=="grab book" or $command=="book" or $command=="stairs" or $command=="go up stairs" or $command=="go to book" && $_SESSION['c']>=3) {
					$_SESSION['location']="library, above book.";
					$_SESSION['c']=0;
					$_SESSION['saveslot']=="0072";
					$command="";
					
				}if ($command=="go forward" or $command=="go to town hall" or $command=="forward" or $command=="town hall" or $command=="go towards town hall" or $command=="walk to town hall" && $_SESSION['c']>=3) {
					$_SESSION['location']="town hall";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go left" or $command=="go to hockey arena" or $command=="left" or $command=="hockey arena" or $command=="go towards hockey arena" or $command=="walk to hockey arena" or $command=="turn left" or $command=="turn on marietta street" or $command=="turn on Marietta Street" or $command=="turn left on marietta steet" && $_SESSION['c']>=3) {
					$_SESSION['location']="hockey arena";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go right" or $command=="go to alley" or $command=="right" or $command=="alley" or $command=="go towards alley" or $command=="walk to alley" && $_SESSION['c']>=3) {
					$_SESSION['location']="alley";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="turn around" or $command=="go back" && $_SESSION['c']>=3) {
					$_SESSION['location']="outside safehouse";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="library, above book") {
			$_SESSION['book']="inventory"; 
			$_SESSION['description']="You walk up the stairs and pick up the book. You look through it, every single page is completely blank, except the very last page. It reads... <br><br><i> 'Dear Daddy, its been two years now, and you still haven't told me where you went, or where, or why. S' started school last week, and you missed it. You're missing everything about our lives, 
			and all we're doing is sitting here, and missing you. Please come home soon, Daddy.' -Charlotte </i><br><br> These notes continue to hit home for you. It's like you and Ladd were in the exact same position. <br><br> 
			The town hall is just meters away, you'll have to go forward to reach it. A road curves off to your left, down Marietta Street, and heads to what looks like a hockey arena. 
			In the other direction, a very dark, sketchy, alley is present.";
			$_SESSION['saveslot']="0072";
			$_SESSION['hint']="<i> go (direction) </i> I think that book sounds pretty interesting. Or if not, the alley is to your right, or your west, since you're facing south. The area is to your left, or your east.";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;

				}
				if ($command=="go forward" or $command=="go to town hall" or $command=="forward" or $command=="town hall" or $command=="go towards town hall" or $command=="walk to town hall" && $_SESSION['c']>=3) {
					$_SESSION['location']="town hall";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go left" or $command=="go to hockey arena" or $command=="left" or $command=="hockey arena" or $command=="go towards hockey arena" or $command=="walk to hockey arena" or $command=="turn left" or $command=="turn on marietta street" or $command=="turn on Marietta Street" or $command=="turn left on marietta steet" && $_SESSION['c']>=3) {
					$_SESSION['location']="hockey arena";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go right" or $command=="go to alley" or $command=="right" or $command=="alley" or $command=="go towards alley" or $command=="walk to alley" && $_SESSION['c']>=3) {
					$_SESSION['location']="alley";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go north" or $command=="go back" && $_SESSION['c']>=3) {
					$_SESSION['location']="library";
					$_SESSION['c']=0;
					$command="";
					
				}
		}
		if ($_SESSION['location']=="town hall" or $_SESSION['saveslot']=="0073") {
			$_SESSION['description']="You reach the town hall. The town hall is surrounded by a giant metal fence, but you can faintly see the barn in the background. It looks like the only way to get through, is by going through the alley. The alley is to your north-west, and a lake is to your east.";
			$_SESSION['saveslot']="0073";
			$_SESSION['hint']="<i> go (direction) </i> You need to get to the safe house, the only way to do that is through the alley. Go north-west";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go north-west" or $command=="go north west" or $command=="go northwest" or $command=="alley" or $command=="go to alley" or $command=="walk to alley" or $command=="north west" or $command=="north-west" && $_SESSION['c']>=3) {
					$_SESSION['location']="alley";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go east" or $command=="go to lake" or $command=="east" or $command=="lake" or $command=="go towards lake" or $command=="walk to lake" && $_SESSION['c']>=3) {
					$_SESSION['location']="lake";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go north" or $command=="go to library") {
					$_SESSION['location']="library";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="east side marios") {
			$_SESSION['description']="You reach East Side Marios. You go in, and order a pizza. To your left, you see a staircase going down, with a sign that says 'PROPER PERSONELLE ONLY'. Straight ahead, is the door to go out. You see that it leads to the hockey arena. To your right, the exit, going towards the safehouse.";
			$_SESSION['pizza']="inventory";
			$_SESSION['hint']="<i> go (direction) </i> Let's just say that you have the required authority.";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="turn left" or $command=="go down stairs" or $command=="left" or $command=="go to sign" or $command=="go towards staircase" && $_SESSION['c']>=3) {
					$_SESSION['location']="secret passage";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go straight ahead" or $command=="go to hockey arena" or $command=="straight ahead" or $command=="hockey arena" or $command=="go towards hockey arena" or $command=="walk to hockey arena" && $_SESSION['c']>=3) {
					$_SESSION['location']="hockey arena";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="turn right" or $command=="go to safehouse" or $command=="right" or $command=="safehouse" or $command=="go towards safehouse" or $command=="walk to safehouse" && $_SESSION['c']>=3) {
					$_SESSION['location']="outside safehouse";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="secret passage" or $_SESSION['saveslot']=="0075") {
			$_SESSION['description']="You figure out that you're in some sort of secret passage. A tunnel sign reads 'CLIFF'. Continue to cliff? Or go back?";
			$_SESSION['saveslot']="0075";
			$_SESSION['hint']="<i> go (direction) </i> Take my word for it, cliff.";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="continue to cliff" or $command=="continue" or $command=="cliff" or $command=="go to cliff" or $command=="go towards cliff" && $_SESSION['c']>=3) {
					$_SESSION['location']="cliff";
					
					$_SESSION['c']=0;
					$command="";
				}if ($command=="go back" or $command=="back" or $command=="return" or $command=="east side marios" && $_SESSION['c']>=3) {
					$_SESSION['location']="east side marios";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="cliff" && $_SESSION['key']=="ground" or $_SESSION['saveslot']=="0076") {
			$_SESSION['description']="You reach the cliff. The first thing you notice, is a chest right in front of you. There is also a zip line behind that, which looks like it will take you straight to the town hall.";
			$_SESSION['saveslot']="0076";
			$_SESSION['hint']="<i> go (direction) </i> A chest will usually have something important inside. Open it. Then, (go to zip line)";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="open chest" or $command=="chest" or $command=="go to chest" or $command=="go chest" && $_SESSION['c']>=3) {
					$_SESSION['location']="cliff";
					$_SESSION['description']="You open the chest. Inside, there is a key. You pick up the key. Behind the chest is the zip line, it looks like it will take you to the town hall."; 
					$_SESSION['key']="inventory";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="zip line" or $command=="zip line" or $command=="go to zip line" or $command=="go chest" && $_SESSION['c']>=3) {
					$_SESSION['location']="town hall";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if (($_SESSION['location']=="cliff" && $_SESSION['key']=="inventory") or $_SESSION['saveslot']=="0077") {
			$_SESSION['description']="You reach the cliff. There is a zip line in front of you, which looks like it will take you straight to the town hall. If you turn and go north west, you'll go down a hill.";
			$_SESSION['saveslot']="0077";
			$_SESSION['hint']="<i> go (direction) </i> (go to zip line)";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="zip line" or $command=="zip line" or $command=="go to zip line" or $command=="go chest" && $_SESSION['c']>=3) {
					$_SESSION['location']="lake, zip line";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go back" or $command=="back" or $command=="return" or $command=="secret passage" && $_SESSION['c']>=3) {
					$_SESSION['location']="secret passage";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go north west" or $command=="north west" or $command=="go to hill" or $command=="hill" or $command=="go to the hill" && $_SESSION['c']>=3) {
					$_SESSION['location']="hill";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="lake, zip line" or $_SESSION['saveslot']=="0078") {
			$_SESSION['description']="You zip line down. You had no source of safety, so as youre going down, you slip off and fall into the water, deeply injuring yourself, with the impact, and temperature of the water. You swim back to shore. To your right is the town hall, and if you turn around you'll reach the hockey arena.";
			$_SESSION['saveslot']="0078";
			$_SESSION['health']=$_SESSION['health']-3;
			$_SESSION['hint']="<i> go (direction) </i> The town hall would be your best bet.";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="behind you" or $command=="go behind you" or $command=="go to hockey arena" or $command=="hockey arena" or $command=="turn around" && $_SESSION['c']>=3) {
					$_SESSION['location']="hockey arena";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go right" or $command=="right" or $command=="go to town hall" or $command=="town hall" && $_SESSION['c']>=3) {
					$_SESSION['location']="town hall";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="lake" or $_SESSION['saveslot']=="0079") {
			$_SESSION['description']="You get to the lake. To your right is the town hall, and behind you is the hockey arena.";
			$_SESSION['saveslot']="0079";
			$_SESSION['hint']="<i> go (direction) </i> The town hall would be your best bet. But if you want, hockey arena would be (turn around)";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="behind you" or $command=="go behind you" or $command=="go to hockey arena" or $command=="hockey arena" or $command=="turn around" && $_SESSION['c']>=3) {
					$_SESSION['location']="hockey arena";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go right" or $command=="right" or $command=="go to town hall" or $command=="town hall" && $_SESSION['c']>=3) {
					$_SESSION['location']="town hall";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="hockey arena" or $_SESSION['saveslot']=="0080") {
			$_SESSION['description']="You get to the hockey arena. Keep going north, and you'll reach East Side Marios. South, and you'll be at the lake. Go east, and you'll reach the library. A hill is sitting opposite of the library. ";
			$_SESSION['saveslot']="0080";
			$_SESSION['hint']="<i> go (direction) </i>";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="north" or $command=="go north" or $command=="go to east side marios" or $command=="east side marios" && $_SESSION['c']>=3) {
					$_SESSION['location']="east side marios";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go west" or $command=="west" or $command=="go to library" or $command=="library" && $_SESSION['c']>=3) {
					$_SESSION['location']="library";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go south" or $command=="south" or $command=="go to lake" or $command=="lake" && $_SESSION['c']>=3) {
					$_SESSION['location']="lake";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go east" or $command=="east" or $command=="go to the hill" or $command=="hill" or $command=="go to hill" && $_SESSION['c']>=3) {
					$_SESSION['location']="hill";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="hill" or $_SESSION['saveslot']=="0081") {
			$_SESSION['description']="You reach a hill. If you continue going up, you'll end up hitting a cliff, and if you go right, you'll hit the hockey arena.";
			$_SESSION['saveslot']="0081";
			$_SESSION['hint']="<i> go (direction) </i> or <i> (location) </i>";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="continue" or $command=="go up hill" or $command=="continue going up" or $command=="up" or $command=="cliff" && $_SESSION['c']>=3) {
					$_SESSION['location']="cliff";
					$_SESSION['c']=0;	
					$command="";
					
				}if ($command=="go right" or $command=="right" or $command=="turn right" or $command=="go to hockey arena" or $command=="hockey arena" && $_SESSION['c']>=3) {
					$_SESSION['location']="hockey arena";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="town houses" or $_SESSION['saveslot']=="0082") {
			$_SESSION['description']="You reach a really sketchy neighbourhood. Old houses have been burned down, and the smell of drugs are in the air. To make it all better, directly in front of you, is an alley. A dark, scary alley. If you go left, you'll reach the outside of the safehouse.";
			$_SESSION['saveslot']="0082";
			$_SESSION['hint']="<i> go (direction) </i> in front of you = go forward";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go forward" or $command=="forward" or $command=="go to alley" or $command=="alley" or $command=="go to dark alley" or $command=="dark alley" && $_SESSION['c']>=3) {
					$_SESSION['location']="alley";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go left" or $command=="left" or $command=="go outside safehouse" or $command=="safehouse" or $command=="go to safehouse" && $_SESSION['c']>=3) {
					$_SESSION['location']="outside safehouse";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if (($_SESSION['location']=="alley" && $_SESSION['passedalley']==false) or $_SESSION['saveslot']=="0083"){
			$_SESSION['description']="You walk into the alley. You instantly realize that it was a mistake. A group of hoodlums come out of the darkness. And come up to talk to you. <br><br> 'What cha think you doin here man? This is our territory. Our land. Who do ya think ya are?'";
			$_SESSION['saveslot']="0083";
			$_SESSION['hint']="<i> go (direction) </i>";
			$_SESSION['location']="alley";
			
			$_SESSION['conversation']=true;
			$turn=false;
			$_SESSION['choice1']="I'm very sorry, I'm just trying to get home!";
			$_SESSION['choice2']="You got beef homes?";
			$_SESSION['passedalley']=false;
		}if (($_SESSION['location']=="alley" && $_SESSION['passedalley']==true) or $_SESSION['saveslot']=="0094"){
			$_SESSION['description']="You walk into the alley. The gang remembers you, and let you be. You walk to the end of the alley. To the east, is the barn house.";
			$_SESSION['saveslot']="0094";
			$_SESSION['hint']="<i> go (direction) </i>";
			$_SESSION['location']="end of alley";
			$_SESSION['conversation']=false;
			$turn=false;
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go east" or $command=="east" or $command=="go towards barn" or $command=="barn" && $_SESSION['c']>=3) {
					$_SESSION['location']="barn";
					$_SESSION['c']=0;
				} if ($command=="go north" or $command=="go back" or $command=="north" or $command=="turn around" && $_SESSION['c']>=3) {
					$_SESSION['location']="barn";
					$_SESSION['c']=0;
				}
		}

		
		
		//Gang dialog
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}	if ((($_SESSION['location']=="alley") && ($finalcommand=="I'm very sorry, I'm just trying to get home!") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0084")) {
		$_SESSION['choice1']="Look I dont want any trouble";
		$_SESSION['choice2']="I have money if that's what you're looking for?";
		$_SESSION['location']="alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'You just want to go home? Ohhhh boo hoo homie, some of us aint got no homes! You can't just come into the hood, flaunting all that cash around!'";
		$_SESSION['saveslot']="0084";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}if ((($_SESSION['location']=="alley") && ($finalcommand=="Look I dont want any trouble") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0092")) {
		$_SESSION['choice1']="No I am not, Im sorry.";
		$_SESSION['choice2']="";
		$_SESSION['location']="alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'Look man, you can't just go around like that! This is our territory! Do you think you're one of us or something?'";
		$_SESSION['saveslot']="0092";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}if ((($_SESSION['location']=="alley") && ($finalcommand=="I have money if that's what you're looking for?") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0093")) {
		$_SESSION['choice1']="Alright, here you are.";
		$_SESSION['choice2']="";
		$_SESSION['location']="alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'Deal, gimme all you got and you can pass without trouble.'";
		$_SESSION['saveslot']="0093";
		$_SESSION['money']="ground";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if ((($_SESSION['location']=="alley") && ($finalcommand=="You got beef homes?") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0085")) {
		$_SESSION['choice1']="No I am not, Im sorry.";
		$_SESSION['choice2']="Nah man, this is the real me!";
		$_SESSION['location']="alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'Ya I do got beef actually, who do you think you are walkin around like that? You tryna mock me son?";
		$_SESSION['saveslot']="0085";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}	if ((($_SESSION['location']=="alley") && ($finalcommand=="Nah man, this is the real me!") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0086")) {
		$_SESSION['choice1']="No I am not, Im sorry.";
		$_SESSION['choice2']="Yo man how's Johnny boy doinnn?";
		$_SESSION['location']="alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'Oh that's the real you huh? What kind of gangstas do you know round here?";
		$_SESSION['saveslot']="0086";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}if ((($_SESSION['location']=="alley") && ($finalcommand=="No I am not, Im sorry.") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0087")) {
		$_SESSION['choice1']="Alright, here you are.";
		$_SESSION['choice2']="No way!";
		$_SESSION['location']="alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'You know what man, gimme all the cash you got on ya and I'll let you go wherever you got to.";
		$_SESSION['saveslot']="0087";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}if ((($_SESSION['location']=="alley") && ($finalcommand=="Yo man how's Johnny boy doinnn?") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0088")) {
		$_SESSION['choice1']="Thank You!";
		$_SESSION['choice2']="";
		$_SESSION['location']="alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'Holy cow man no way, you know my boy Johnny!? Sorry for all the trouble man, please, get to wherever you gotta go.";
		$_SESSION['saveslot']="0088";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}if ((($_SESSION['location']=="alley") && ($finalcommand=="No way!") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0089")) {
		$_SESSION['conversation']=false;
		$_SESSION['location']="end of alley";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Hoodlum: 'You know what man, gimme all the cash you got on ya and I'll let you go wherever you got to.";
		$_SESSION['saveslot']="0089";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if ((($_SESSION['location']=="alley") && ($finalcommand=="Alright, here you are.") && ($turn==true) && ($_SESSION['passedalley']==false)) or ($_SESSION['saveslot']=="0090")) {
		$_SESSION['location']="end of alley";
		$_SESSION['conversation']=false;
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> You walk south, passed the alley. To the east, is the barn house.";
		$_SESSION['saveslot']="0090";
		$_SESSION['passedalley']=true;
		$_SESSION['money']="ground";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}if ((($_SESSION['location']=="alley") && ($finalcommand=="Thank You!")) && ($_SESSION['passedalley']==false)) {
		$_SESSION['location']="end of alley";
		$_SESSION['conversation']=false;
		$_SESSION['passedalley']=true;
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be delcared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}if ((($_SESSION['location']=="end of alley") && ($_SESSION['passedalley']==true)) or ($_SESSION['saveslot']=="0091")) {
		$_SESSION['conversation']=false;
		$_SESSION['location']="end of alley";
		$_SESSION['description']="You walk south, passed the alley. To the east, is the barn house.";
		$_SESSION['saveslot']="0091";
			if (ISSET($_POST['perform'])) {
				$_SESSION['c']=$_SESSION['c'] + 1;
			}
			if ($command=="go east" or $command=="east" or $command=="go towards barn" or $command=="barn" && $_SESSION['c']>=3) {
				$_SESSION['location']="barn";
				$_SESSION['c']=0;
			} if ($command=="go north" or $command=="go back" or $command=="north" or $command=="turn around" && $_SESSION['c']>=3) {
				$_SESSION['location']="town houses";
				$_SESSION['c']=0;
			}
		}if ((($_SESSION['location']=="barn") && ($_SESSION['key']!="inventory")) or ($_SESSION['saveslot']=="0092")) {
		$_SESSION['location']="barn";
		$_SESSION['description']="You go to the barn and you can hear Ladd on the inside. You try and open the gate. You realize that there is a lock, and that you need to find the key to get in.";
		$_SESSION['saveslot']="0092";
		$_SESSION['hint']="The key isn't going to be anywhere around here, go back.";
			if (ISSET($_POST['perform'])) {
				$_SESSION['c']=$_SESSION['c'] + 1;
			}
			if ($command=="go back" or $command=="turn around" or $command=="alley" or $command=="town houses" && $_SESSION['c']>=3) {
				$_SESSION['location']="town houses";
				$_SESSION['c']=0;
			} if (($command=="unlock it" or $command=="unlock gate" or $command=="open gate" or $command=="open" or $command=="go inside" && $_SESSION['c']>=3)) {
				$errormessage="You need the key to do that.";
				$_SESSION['c']=0;
			} 
		}if ((($_SESSION['location']=="barn") && ($_SESSION['key']=="inventory")) or ($_SESSION['saveslot']=="0093")) {
		$_SESSION['location']="inside barn";
		$_SESSION['description']="You go to the barn and you can hear Ladd on the inside. You try and open the gate. You realize that there is a lock, but, you have the key.";
		$_SESSION['saveslot']="0093";
		$_SESSION['hint']="the gate is locked, to get inside, you need to unlock it.";
			if (ISSET($_POST['perform'])) {
				$_SESSION['c']=$_SESSION['c'] + 1;
			}
			if (($command=="unlock it" or $command=="unlock gate" or $command=="open gate" or $command=="open" or $command=="go inside" && $_SESSION['c']>=3) or $_SESSION['saveslot']=="0094") {
				$_SESSION['location']="inside barn";
				$_SESSION['description']="You unlock the gate and go into the barn, you see Ladd all tied up.";
				$_SESSION['saveslot']="0094";
				$_SESSION['hint']="You should help Ladd.";
				$_SESSION['c']=0;
			} 
		}if ($_SESSION['location']=="inside barn") {
		$_SESSION['description']="You get into the barn. You see Ladd tied up in the corner.";
		$_SESSION['hint']="Dom said that all you need to do to pass this dream level, is to help Ladd.";
			if (ISSET($_POST['perform'])) {
				$_SESSION['c']=$_SESSION['c'] + 1;
			}
			if (($command=="untie ladd" or $command=="untie Ladd" or $command=="help ladd" or $command=="help Ladd" or $command=="get ladd" or $command=="ladd" or $command=="Ladd" && $_SESSION['c']>=3)) {
				$_SESSION['location']="inside barn";
				$_SESSION['description']="You untie Ladd, and the dream shatters...";
				$_SESSION['hint']="You should help Ladd.";
				$_SESSION['saveslot']="0095";
				$_SESSION['c']=0;
				$_SESSION['continue']=true;
				$continue=false;
			} 
		} 
			if (!ISSET($_POST['continue'])){ //to display continue button, must be reset because locations is linked before commands, so this is seen first
				$continue=false;
			}
			if (ISSET($_POST['continue'])){
				$continue=true;
		}
		if ((($_SESSION['location']=="inside barn") && ($continue==true)) or ($_SESSION['saveslot']=="0096")) {
		$continue=false;
		$_SESSION['continue']=false;
		$_SESSION['level']="The Fire";
		$_SESSION['location']="beginning bedroom";
		$_SESSION['saveslot']="0096";
		$_SESSION['pizza']="ground";
		$_SESSION['key']="ground";
		$_SESSION['flashlight']="ground";
	}
	//End Level
}
	

//Level 5
if ($level=="The Fire") {
	
	if ($_SESSION['location']=="beginning bedroom") {
			$_SESSION['description']="It seems like a very pleasant sleep. But all of a sudden, you smell this rush of.. burnt toast. You wake up, and whatever house you're in, is burning to the ground. You need to get out.<br><br> You jump out of the bed, You've never been in this house before, 
			so this may be pretty difficult to maneuver. You notice two doors, the one to your right is the door to get out of the master bedroom, the other one, to your left, looks like a bathroom. Without thinking, you grab some letter from your night stand.";
			$_SESSION['hint']="<i> You may need something from the bathroom for later. </i>";
			$_SESSION['letter']="inventory";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go right" or $command=="right" or $command=="go to first door" or $command=="right" or $command=="first door" or $command=="right door" or $command=="open right door" && $_SESSION['c']>=3) {
					$_SESSION['location']="hallway";
					$_SESSION['c']=0;
					$command=""; //commands have to be reset. if not, then game will skip over locations, since many are the same command
					
				}if ($command=="go left" or $command=="go to bathroom" or $command=="left" or $command=="bathroom" or $command=="second door" or $command=="go to second door" && $_SESSION['c']>=3) {
					$_SESSION['location']="bathroom";
					$_SESSION['c']=0;
					$command="";
					
				}
		}	if ($_SESSION['location']=="master bedroom") {
			$_SESSION['description']="You go into the bedroom. You notice two doors, the one to your right is the door to get out of the master bedroom, the other one, to your left, looks like a bathroom. Without thinking, you grab some letter from your night stand.";
			$_SESSION['hint']="<i> You may need something from the bathroom for later. </i>";
			
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go right" or $command=="right" or $command=="go to first door" or $command=="right" or $command=="first door" or $command=="right door" or $command=="open right door" && $_SESSION['c']>=3) {
					$_SESSION['location']="hallway";
					$_SESSION['c']=0;
					$command=""; //commands have to be reset. if not, then game will skip over locations, since many are the same command
					
				}if ($command=="go left" or $command=="go to bathroom" or $command=="left" or $command=="bathroom" or $command=="second door" or $command=="go to second door" && $_SESSION['c']>=3) {
					$_SESSION['location']="bathroom";
					$_SESSION['c']=0;
					$command="";
					
				}
		}	
		if ($_SESSION['location']=="hallway") {
			$_SESSION['description']="You run out of the master bedroom door. You're now in some hallway. At the end of this hallway, there is a child's bedroom, and a staircase. Your direct instinct as a father is to check the room, what if there's a kid? His house is burning down!";
			$_SESSION['hint']="(check bedroom)(go downstairs)(go to master bedroom)";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="check bedroom" or $command=="check room" or $command=="bedroom" or $command=="go to bedroom" or $command=="go to kids room" or $command=="kids room" or $command=="room" && $_SESSION['c']>=3) {
					$_SESSION['location']="kids bedroom";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go forward" or $command=="go straight" or $command=="forward" or $command=="go downstairs" or $command=="stairs" or $command=="down stairs" && $_SESSION['c']>=3) {
					$_SESSION['location']="staircase";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go into master bedroom" or $command=="go back into master bedroom" or $command=="go to master bedroom" or $command=="master bedroom" && $_SESSION['c']>=3) {
					$_SESSION['location']="master bedroom";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="bathroom") {
			$_SESSION['description']="You walk into the bathroom. You see a bucket on the floor, it may be handy if you need to put out a fire.";
			$_SESSION['hint']="go back if you want to get back to the bedroom.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="fill up bucket" or $command=="fill bucket with water" or $command=="fill bucket" or $command=="take bucket" or $command=="bucket" or $command=="pick up bucket" && $_SESSION['c']>=3) {
					$_SESSION['fullbucket']="inventory";
					$_SESSION['description']="You take the bucket and fill it up with water.";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go back" or $command=="turn around" or $command=="back" or $command=="bedroom" or $command=="return" or $command=="walk to hockey arena" && $_SESSION['c']>=3) {
					$_SESSION['location']="master bedroom";
					$_SESSION['c']=0;
					$command="";
				}					
		}if ($_SESSION['location']=="kids bedroom" && $_SESSION['baby']=="inventory") {
			$_SESSION['description']="You already have the baby so there's no need to go in. To the east, is the staircase, and to the north, the master bedroom.";
			$_SESSION['hint']="Go downstairs.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go east" or $command=="go downstairs" or $command=="downstairs" or $command=="use stairs" or $command=="east" && $_SESSION['c']>=3) {
					$_SESSION['location']="staircase";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go north" or $command=="go to master bedroom" or $command=="master bedroom" or $command=="north" && $_SESSION['c']>=3) {
					$_SESSION['location']="master bedroom";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="kids bedroom" && $_SESSION['baby']!="inventory") {
			$_SESSION['description']="You run into the kids room. You hear crying from the corner, you look in, and its a baby. A baby! You instantly pick up the baby and put him on your shoulder's. Be careful. You walk out the door. To the east, is the staircase, and to the north, the master bedroom.";
			$_SESSION['hint']="'go to master bedroom' if you want to get back to the bedroom.";

				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go east" or $command=="go downstairs" or $command=="downstairs" or $command=="use stairs" or $command=="east" && $_SESSION['c']>=3) {
					$_SESSION['location']="staircase";
					$_SESSION['baby']="inventory";
					$_SESSION['c']=0;
					$command="";
					
				}if ($command=="go north" or $command=="go to master bedroom" or $command=="master bedroom" or $command=="north" && $_SESSION['c']>=3) {
					$_SESSION['location']="master bedroom";
					$_SESSION['baby']="inventory";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="staircase" && $_SESSION['fullbucket']!="inventory") {
			$_SESSION['description']="You try and go down the staircase, but it is completely covered in fire. It looks like you only have three options, jump down the stairs, walk down the stairs, or slide down the railing.";
			$_SESSION['hint']="You wont win in this situation.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="jump" or $command=="jump down" or $command=="jump down the stairs" or $command=="jump down stairs" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen after jump";
					$_SESSION['health']=$_SESSION['health']-1;
					$_SESSION['c']=0;
					$command="";
				}if ($command=="walk" or $command=="walk down" or $command=="walk down the stairs" or $command=="walk down stairs" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen after walk";
					$_SESSION['health']=$_SESSION['health']-2;
					$_SESSION['c']=0;
					$command="";
				}if ($command=="slide" or $command=="slide down" or $command=="slide down the railing" or $command=="slide down railing" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen after slide";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="staircase" && $_SESSION['fullbucket']=="inventory" or $_SESSION['emptybucket']=="inventory") {
			$_SESSION['description']="You try and go down the staircase, but it is completely covered in fire. Luckily, you got that bucket of water. You pour the water on the fire, and now, the path is clear. Keep going down?";
			$_SESSION['fullbucket']="ground";
			$_SESSION['emptybucket']="inventory";
			$_SESSION['hint']="yes or no";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go down" or $command=="go downstairs" or $command=="downstairs" or $command=="use stairs" or $command=="keep going" or $command=="ya" or $command=="yes" or $command=="yea" or $command=="yeah" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen";
					$_SESSION['description']="You take the bucket and fill it up with water.";
					$_SESSION['c']=0;
					$command="";
					
				}
		}if ($_SESSION['location']=="kitchen") {
			$_SESSION['description']="You reach the kitchen. You look back, the staircase just collapsed from all the fire and the pressure from you walking down, so you are unable to go back. If you go south, youll get to a room which looks like a living room. If you go east, you'll get to the fridge, and the sink is to the west.";
			$_SESSION['hint']="There may be something to eat in the fridge to heal, go to fridge.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go forward" or $command=="south" or $command=="go south" or $command=="go to the living room" or $command=="go to living room" or $command=="living room" or $command=="walk to living room" && $_SESSION['c']>=3) {
					$_SESSION['location']="living room";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="east" or $command=="go east" or $command=="go towards the fridge" or $command=="go to fridge" or $command=="fridge" or $command=="walk to fridge" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen, the fridge";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="west" or $command=="go west" or $command=="go towards sink" or $command=="sink" && $_SESSION['c']>=3) {
					$_SESSION['location']="sink";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="kitchen after jump") {
			$_SESSION['description']="You jump down the stairs. You forget about the baby, and it nearly falls off, but you have ninja reflexes so you saved it. Though the jump harms you through the fire and the impact. <br><br> You reach the kitchen. You look back, the staircase just collapsed from all the fire and the pressure from you walking down, so you are unable to go back. If you go south, youll get to a room which looks like a living room. If you go east, you'll get to the fridge, and the sink is to the west.";
			$_SESSION['hint']="You may heal from the fridge";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go forward" or $command=="south" or $command=="go south" or $command=="go to the living room" or $command=="go to living room" or $command=="living room" or $command=="walk to living room" && $_SESSION['c']>=3) {
					$_SESSION['location']="living room";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="east" or $command=="go east" or $command=="go towards the fridge" or $command=="go to fridge" or $command=="fridge" or $command=="walk to fridge" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen, the fridge";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="west" or $command=="go west" or $command=="go towards sink" or $command=="sink" && $_SESSION['c']>=3) {
					$_SESSION['location']="sink";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="kitchen after slide") {
			$_SESSION['description']="You slide down the burning stairs, and you come off without a scratch. <br><br> You reach the kitchen. You look back, the staircase just collapsed from all the fire and the pressure from you walking down, so you are unable to go back. If you go south, youll get to a room which looks like a living room. If you go east, you'll get to the fridge, and the sink is to the west.";
			$_SESSION['hint']="You may heal from the fridge";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go forward" or $command=="south" or $command=="go south" or $command=="go to the living room" or $command=="go to living room" or $command=="living room" or $command=="walk to living room" && $_SESSION['c']>=3) {
					$_SESSION['location']="living room";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="east" or $command=="go east" or $command=="go towards the fridge" or $command=="go to fridge" or $command=="fridge" or $command=="walk to fridge" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen, the fridge";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="west" or $command=="go west" or $command=="go towards sink" or $command=="sink" && $_SESSION['c']>=3) {
					$_SESSION['location']="sink";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="kitchen after walk") {
			$_SESSION['description']="You walk down the burning stairs, what's wrong with you? At least the baby is okay. The fire burns you severly. <br><br> You reach the kitchen. You look back, the staircase just collapsed from all the fire and the pressure from you walking down, so you are unable to go back. If you go south, youll get to a room which looks like a living room. If you go east, you'll get to the fridge, and the sink is to the west.";
			$_SESSION['hint']="You may heal from the fridge";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go forward" or $command=="south" or $command=="go south" or $command=="go to the living room" or $command=="go to living room" or $command=="living room" or $command=="walk to living room" && $_SESSION['c']>=3) {
					$_SESSION['location']="living room";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="east" or $command=="go east" or $command=="go towards the fridge" or $command=="go to fridge" or $command=="fridge" or $command=="walk to fridge" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen, the fridge";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="west" or $command=="go west" or $command=="go towards sink" or $command=="sink" && $_SESSION['c']>=3) {
					$_SESSION['location']="sink";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="kitchen, the fridge") {
			$_SESSION['description']="You go and open the fridge, The baby on your back stops you from taking anything with you, and you know, so does the fire. But you see an apple, and you have time for a bite. Or go back. ";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="eat" or $command=="eat apple" or $command=="apple" or $command=="bite apple" or $command=="go to living room" or $command=="living room" or $command=="walk to living room" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen";
					$_SESSION['health']=$_SESSION['health']+1;
					$_SESSION['c']=0;
					$command="";
				}if ($command=="go back" or $command=="back" or $command=="return") {
					$_SESSION['location']="kitchen";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="living room") {
			$_SESSION['hint']="You can always refill a bucket, water always takes out fire.";
			$_SESSION['description']="You walk into the living room. Behind you, is the kitchen. To your right, there is the front door. There is no space to open it though, as the door knob and door itself is covered in fire.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="right" or $command=="go right" or $command=="open door" or $command=="go towards the door" or $command=="go to door" or $command=="turn right" or $command=="door" && $_SESSION['c']>=3) {
					$_SESSION['location']="door";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="kitchen" or $command=="turn around" or $command=="go to kitchen" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="sink") {
			$_SESSION['hint']="Go back.";
			$_SESSION['description']="You walk to the sink. You fill the bucket up with water.";
			$_SESSION['fullbucket']="inventory";
			$_SESSION['emptybucket']="ground";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="go back" or $command=="back" or $command=="return" && $_SESSION['c']>=3) {
					$_SESSION['location']="kitchen";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="door" && $_SESSION['fullbucket']!="inventory") {
			$_SESSION['hint']="If you don't want to get hurt, try and get a bucket, filled with water, and come back. (open door) or (go back)";
			$_SESSION['description']="You walk towards the door. It is completely on fire. You can either try to open it and risk hurting yourself, or go back and try to find something to stop the fire.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="open door" or $command=="door" or $command=="try to open door" && $_SESSION['c']>=3) {
					$_SESSION['location']="outside, burned hand";
					$_SESSION['health']=$_SESSION['health']-2;
					$_SESSION['c']=0;
					$command="";
				}if ($command=="go back" or $command=="return" or $command=="find something" && $_SESSION['c']>=3) {
					$_SESSION['location']="living room";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="door" && $_SESSION['fullbucket']=="inventory") {
			$_SESSION['hint']="Open the door.";
			$_SESSION['fullbucket']="ground";
			$_SESSION['emptybucket']="inventory";
			$_SESSION['description']="You walk towards the door. It is completely on fire.Though you do have a bucket of water, and you pour it on the door. You are now able to open it.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="open door" or $command=="door" or $command=="try to open door" && $_SESSION['c']>=3) {
					$_SESSION['location']="outside";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="outside") {
			$_SESSION['hint']="Get in.";
			$_SESSION['description']="You walk outside. The first thing you see is a car. You walk towards the car door.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="get in" or $command=="get in the car" or $command=="open door" or $command=="open car door" && $_SESSION['c']>=3) {
					$_SESSION['location']="inside the car";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="go back" or $command=="return" or $command=="back" && $_SESSION['c']>=3) {
					$_SESSION['location']="door";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="outside, burned hand") {
			$_SESSION['hint']="Get in.";
			$_SESSION['description']="You burn your hand badly when trying to open the door. You walk outside. The first thing you see is a car. You walk towards the car door.";
				if (ISSET($_POST['perform'])) {
					$_SESSION['c']=$_SESSION['c'] + 1;
				}
				if ($command=="get in" or $command=="get in the car" or $command=="open door" or $command=="open car door" && $_SESSION['c']>=3) {
					$_SESSION['location']="inside the car";
					$_SESSION['c']=0;
					$command="";
				}if ($command=="go back" or $command=="return" or $command=="back" && $_SESSION['c']>=3) {
					$_SESSION['location']="door";
					$_SESSION['c']=0;
					$command="";
				}
		}if ($_SESSION['location']=="inside the car") {
			$_SESSION['continue']=true;
			$continue=false;
			$_SESSION['location']="end dream";
			$_SESSION['baby']="ground"; //values are reset upon new level 
			$_SESSION['fullbucket']="ground";
			$_SESSION['emptybucket']="ground";
			$_SESSION['description']="You get in the car, Dom was waiting for you. <br><br> You: 'You made me go through a burning house all by myself while you just sat in the car?!' <br><br> Dom:'Yeah, You see that sleeping Ladd in the back? Well he dreams of this every night. With these sedatives, we're able to change his mind. You just lived this dream of his, so he will never have to dream it again. <br><br> This is how he woke up the morning his wife died. And I think you just kidnapped his son.'";
		}	

	
		if (!ISSET($_POST['continue'])){ //to display continue button, must be reset because locations is linked before commands, so this is seen first
				$continue=false;
			}
			if (ISSET($_POST['continue'])){
				$continue=true;
		}
		if (($_SESSION['location']=="end dream") && ($continue==true)) {
		$continue=false;
		$_SESSION['continue']=false;
		$_SESSION['level']="The Memories";
		$_SESSION['location']="the white room";
		header("Location: main.php"); //must refresh the page when changing levels or else previous location and description will stay
	}
}


//Level 6 

if ($level=="The Memories"){
	
		if ($_SESSION['location']=="the white room") {
		$_SESSION['description']="The dream didn't even collapse, everything simply faded to white. This dream feels a little different... ";
		$_SESSION['location']="the white room";
		$_SESSION['choice1']="Hey Dom?";
		$_SESSION['choice2']="";
		$_SESSION['conversation']=true;
		$turn=false;
	}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the white room") && ($finalcommand=="Hey Dom?") && ($turn==true)) {
		$_SESSION['choice1']="This is it, isn't it?";
		$_SESSION['choice2']="";
		$_SESSION['location']="the white room";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: 'Yeah Buddy?' ";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}	
	if (($_SESSION['location']=="the white room") && ($finalcommand=="This is it, isn't it?") && ($turn==true)) {
		$_SESSION['choice1']="How do we do that?";
		$_SESSION['choice2']="";
		$_SESSION['location']="the white room";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: 'Yep. This is the Inauguration. All we have to do now, is relive the key memories Ladd had with his wife, and then change the very first one.' ";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the white room") && ($finalcommand=="How do we do that?") && ($turn==true)) {
		$_SESSION['choice1']="That seems a little harsh, doesn't it?";
		$_SESSION['choice2']="";
		$_SESSION['location']="the white room";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: 'Well first of all, we have to start the dream. Once that happens, Ladd will do all the dreaming for us. He'll take us to the very first memory he has of the two of them, and we just have to make sure they never meet.' ";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the white room") && ($finalcommand=="That seems a little harsh, doesn't it?") && ($turn==true)) {
		$_SESSION['choice1']="...Okay.";
		$_SESSION['choice2']="";
		$_SESSION['location']="the white room";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> Dom: 'We're here to make sure our business, stays in business. We do not care about Ladd's petty little feelings. If anything w'll be doing him a favour by stopping him from being such a baby. Now shut up, and build the world, architect.' ";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the white room") && ($finalcommand=="...Okay.") && ($turn==true)) {
		$_SESSION['choice1']="Continue.";
		$_SESSION['choice2']="";
		$_SESSION['location']="Ladds dreams";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> You build the basis of the dream, the outline. Ladd fills it with everything inside of him, his heart and his mind. You see how devastated he was over how she passed on. Yet you see how happy he was to have known her. You see how they were best friends. You see them having a child and sharing that bond. You see the legend of how they started their business and their successes. You see their wedding, and how happy they were. Now they're in their teens, and their tweens. ";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="Ladds dreams") && ($finalcommand=="Continue.") && ($turn==true)) {
		$_SESSION['choice1']="Continue";
		$_SESSION['choice2']="";
		$_SESSION['location']="the decision";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> You build the basis of the dream, the outline. Ladd fills it with everything inside of him, his heart and his mind. You see how devastated he was over how she passed on. Yet you see how happy he was to have known her. You see how they were best friends. You see them having a child and sharing that bond. You see the legend of how they started their business and their successes. You see their wedding, and how happy they were. Now they're in their teens, and their tweens. ";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="Ladds dreams") && ($finalcommand=="Continue.") && ($turn==true)) {
		$_SESSION['choice1']="Continue";
		$_SESSION['choice2']="";
		$_SESSION['location']="the decision";
		$_SESSION['description']="You: '" . $finalcommand . ".' <br><br> You build the basis of the dream, the outline. Ladd fills it with everything inside of him, his heart and his mind. You see how devastated he was over how she passed on. Yet you see how happy he was to have known her. You see how they were best friends. You see how he lived only for her. You see them having a child and sharing that bond. You see the legend of how they started their business and their successes. You see their wedding, and how happy they were. Now they're in their teens, and then their tweens. ";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the decision") && ($finalcommand=="Continue") && ($turn==true)) {
		$_SESSION['choice1']="Stop Carter";
		$_SESSION['choice2']="Let him dream";
		$_SESSION['location']="the decision, the park";
		$_SESSION['description']="Then flashback to little Carter Ladd, 5 years old, walking by himself, back home from the park. The dream is happening backwards, so with that huge grin on Carter's face, he's now back at the park, talking to little Jessica Summers. Since the dream is happening in reverse, you see Jessica tend to him as he fell and scraped his leg when nobody else would, and then them separate. That was the very first meeting. The one you need to prevent. <br><br> Next thing you know, little Carter is right beside you, walking to the park.
		Time slows down, an you are completely torn on what to do. Strip little Ladd from the reason he was living his life, or finally be able to see your children.";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the decision, the park") && ($finalcommand=="Stop Carter") && ($turn==true)) {
		$_SESSION['choice1']="Continue";
		$_SESSION['location']="the finale";
		$_SESSION['description']="You go to stop Carter from going to the park, the moment you put your hand on him, the dream shatters.. You're going home...";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the decision, the park") && ($finalcommand=="Let him dream") && ($turn==true)) {
		$_SESSION['choice1']="Tackle Dom";
		$_SESSION['choice2']="Chase Dom";
		$_SESSION['location']="the fight";
		$_SESSION['description']="You let Carter walk by, and dream. So the purpose he had in his life would sill be fufilled.. <br><br> As you let Ladd go, Dom, in rage, chases after him.";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
	if (($_SESSION['location']=="the fight") && ($finalcommand=="Tackle Dom") && ($turn==true)) {
		$_SESSION['choice1']="Punch Dom";
		$_SESSION['choice2']="Pin him down";
		$_SESSION['location']="the fight";
		$_SESSION['description']="Dom runs, and you chase right after him, since you were so close, you were able to knock him to the ground. After a struggle, you end up on top.";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the fight") && ($finalcommand=="Punch Dom") && ($turn==true)) {
		$_SESSION['choice1']="Continue";
		$_SESSION['choice2']="";
		$_SESSION['location']="the fight";
		$_SESSION['description']="You punch Dom, the moment your fist hits his face, the dream slows down, and begins to collapse...";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the fight") && ($finalcommand=="Pin him down") && ($turn==true)) {
		$_SESSION['choice1']="Continue";
		$_SESSION['choice2']="";
		$_SESSION['location']="the fight";
		$_SESSION['description']="You attempt to pin Dom down, but he struggles, and attempts to head butt you, just before his head hits yours, the dream slows down, and begins to collapse...";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the finale") && ($finalcommand=="Continue") && ($turn==true)) {
		$_SESSION['conversation']=false;
		$_SESSION['location']="home";
		$_SESSION['level']="Home";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}
		if (ISSET($_POST['choice1'])){ // these must be declared each time or else the page will read the if statement above, and turn $turn back to false
			$finalcommand=$_POST['hiddenchoice1'];
			$turn=true;
		}if (ISSET($_POST['choice2'])){
			$finalcommand=$_POST['hiddenchoice2'];
			$turn=true;
		}
	if (($_SESSION['location']=="the fight") && ($finalcommand=="Continue") && ($turn==true)) {
		$_SESSION['conversation']=false;
		$_SESSION['location']="home";
		$_SESSION['level']="Home";
		$turn=false; //turn must be reset after every if statement so that no conditional statements could be skipped if their datas similar
		}

			
}

if ($level=="Home") {
	if ($_SESSION['location']="home") {
		$_SESSION['description']="You wake up, not in the plane, but already up and walking through the terminal. The authorities somehow let you through. And you're going home. <br><br> You get home, while your kids are still at school. You look through all of the things you missed, and all the things you have. You find a pair of dice, and you debate rolling them. As you get your arm ready, the door opens, and you drop the dice, and run to finally see your kids. <br><br> Panning down, the dice keep rolling around, until finally, snake eyes.";
		$_SESSION['continue']=true;
		$continue=false;
		header("Location: main.php");
	}
			if (!ISSET($_POST['continue'])){ //to display continue button, must be reset because locations is linked before commands, so this is seen first
				$continue=false;
			}
			if (ISSET($_POST['continue'])){
				$continue=true;
			}
			if ($continue==true) {
				header("Location: endingtitle.php");
			}
	
}



?>
</html>