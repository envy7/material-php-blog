<?php 
require 'connect.php';
require 'session.php';
if(!login()){
			$_SESSION['username'] = 'Guest';

}
?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="background-image: url(images/contact-us.jpg);background-size: cover; background-attachment: fixed; background-repeat: no-repeat">
	<div class="navbar-fixed z-depth-2"> 
		<nav style="background-color: #3f51b5">
	    <div class="nav-wrapper">
	      <a href="#" class="brand-logo">Blogger</a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="index.php">Home</a></li>
	        <?php
	        	if($_SESSION['username'] == 'admin'){
	        		echo "<li><a href='userpermit.php'>Users</a></li>";
	        		echo "<li><a href='admin.php'>Blogs</a></li>";
	        	}
	        	else{
	        		echo "<li><a href='home.php'>Your Blogs</a></li>";
	        	}
	        ?>
	        <li><a href="#modal1" class="modal-trigger">Profile</a></li>
	        <?php
	        	if($_SESSION['username']== 'admin'){
	        		echo "<li class='active'><a href='contactus.php'>Messages</a></li>";
	        	}
	        	else{
	        		echo "<li class='active'><a href='contactus.php'>Contact Us</a></li>";
	        	}
	        ?>
	        <li><a href="signout.php">Log Out</a></li>
	      </ul>
	      <ul class="side-nav" id="mobile-demo">
	        <li><a href="sass.html">Home</a></li>
	        <li><a href="#modal1">Profile</a></li>
	        <li class="active"><a href="sass.html">Your Blogs</a></li>
	        <li><a href="collapsible.html">Contact Us</a></li>
	      </ul>
	    </div>
	  </nav>
	</div>

<?php


	
	if($_SESSION['username'] != 'admin'){
		echo	'</div>
				  <div class="row" style="margin: 20 auto;width: 70%">
				    <form class="col s12 add-blog-form z-depth-2" action = "contactus.php" method = "POST" enctype = "utf-8" >
				      <div class="row">
				        <div class="input-field col s12" >
				          <input id="subject" type="text" class="validate" name="subject" maxlength = 30 required>
				          <label for="first_name">Subject</label>
				        </div>
				      </div>
				      <div class="row">
				        <div class="input-field col s12">
				          <textarea id="message" type="text" class="validate materialize-textarea" name="message" required></textarea>
				          <label for="message">Message</label>
				        </div>
				      </div>
				      <div align="center">
					    	<button class="btn waves-effect waves-light" type="submit" name="contactus">Message
							    <i class="material-icons right">send</i>
							</button>
					  </div>
				    </form>
				  </div>';
	}	

	else {
		$messagesql = "SELECT * FROM `messages` ORDER BY `created_date`";
		$messagesresult = mysqli_query($db,$messagesql);
		$num_messages = mysqli_num_rows($messagesresult);

		$i = 0;
		for($i; $i < $num_messages; $i++){
			$messagerow = mysqli_fetch_array($messagesresult,MYSQLI_ASSOC);
			$blogger_id = $messagerow['blogger_id'];
			if($blogger_id != 0){
				$userinfosql = "SELECT `lname`, `fname` FROM `userdetails` WHERE `Id` = '$blogger_id'";
				$useresult = mysqli_query($db,$userinfosql);
				$usernamerow = mysqli_fetch_array($useresult,MYSQLI_ASSOC);
			}
			else{
				$usernamerow['fname'] = 'Guest';
				$usernamerow['lname'] = '';
			}

			echo "<div class='row' style='margin: 20 auto;width: 70%'>
			        <div class='col s12 m12 l12'>
			          <div class='card' style='background-color: #3f51b5'>
			            <div class='card-content white-text'>
			              <span class='card-title'>".$messagerow['subject']."</span>
			              <p>".$messagerow['message']."</p>
			            </div>
			            <div class='card-action' style='border-top:2px solid #f50057'>
			              <a class= 'message-user'>".$usernamerow['fname']." ".$usernamerow['lname']."</a>
			            </div>
			          </div>
			        </div>
			      </div>";
		} 
	}

	if (isset($_POST['contactus'])){
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		if(login()){
			$bloggerid = $_SESSION['id'];
		}
		else{
			$bloggerid = 0;
		}

		$sql = "INSERT INTO `messages`(`blogger_id`,`subject`,`message`) VALUES ('$bloggerid','$subject','$message')";
		if(mysqli_query($db,$sql)){
				// echo "<script>alert('Your blog account is created.');</script>";
				
				if(login()){
					header('location:home.php');
				}	
				else{	
					header('location:index.php');
				}
			}
			else
			{
				echo "<script>alert('Something went wrong.Please try again');</script>";
			}
	}


		
?>
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
 	<script type="text/javascript" src="js/materialize.min.js"></script>
 	<script type="text/javascript">
      	$(document).ready(function(){
      		$(".button-collapse").sideNav();
      		$('#textarea1').val('New Text');
  			$('#textarea1').trigger('autoresize');
      	})
      	
      </script>
</body>

</html>


