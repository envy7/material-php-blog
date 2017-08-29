<?php 
require 'connect.php';
require 'session.php';
if(login()){
	if($_SESSION['username']=="admin")
		header('location:admin.php');
	else
		header('location:home.php');
}
?>


<html>
<head>
	<title>Sign In User</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body style="background-image: url(images/sign-in.jpg);background-size: cover; background-attachment: fixed; background-repeat: no-repeat">
	
	<div class="navbar-fixed"> 
			<nav style="background-color: #3f51b5">
		    <div class="nav-wrapper">
		      <a href="#" class="brand-logo">Blogger</a>
		      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		      <ul id="nav-mobile" class="right hide-on-med-and-down">
		        <li><a href="index.php">Home</a></li>
		      </ul>
		      <ul class="side-nav" id="mobile-demo">
		        <li><a href="index.php">Home</a></li>
		      </ul>
		    </div>
	</nav>
	</div>
	  <div class="row" style="margin: 20 auto;width: 70%">
	    <form class="col s12 add-blog-form z-depth-2" action = "signup.php" method = "POST" enctype = "multipart/form-data" >
	      <div class="row">
	        <div class="input-field col s6" >
	          <input id="fanme" type="text" class="validate" name="fname" maxlength = 30 required>
	          <label for="fname">First Name</label>
	        </div>
	        <div class="input-field col s6" >
	          <input id="lname" type="text" class="validate" name="lname" maxlength = 30 required>
	          <label for="lname">Last Name</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="email" type="email" class="validate" name="emailaddr" required>
	          <label for="email">Email</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="username" type="text" class="validate" name="username" required>
	          <label for="username">Username</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="password" type="password" class="validate" name="password" required>
	          <label for="password">Password</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="contact" type="number" class="validate" name="contact" required>
	          <label for="contact">Contact Number</label>
	        </div>
	      </div>
	      <div class="file-field input-field">
		      <div class="btn">
		        <span>File</span>
		        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		        <input id= "file" name = "file" type="file" required>
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
	      <div align="center">
		    	<button class="btn waves-effect waves-light" type="submit" name="cre">Create Account
				    <i class="material-icons right">send</i>
				</button>
		  </div>
	    </form>
	  </div>
			
			<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		 	<script type="text/javascript" src="js/materialize.min.js"></script>
		 	<script type="text/javascript">
		      	$(document).ready(function(){
		      		$(".button-collapse").sideNav();
		      	})
		      	
		      </script>
	
</body>


</html>	

<?php
function checkduplicate($u,$e){
			$db=mysqli_connect("localhost","root","","datablog") or die("Can not connect right now!");

			$sql1="SELECT `userName` FROM `userdetails` WHERE `username` = '$u'";
			$sql2 = "SELECT `email` FROM `userdetails` WHERE `email` = '$e'";

			$result1 = mysqli_query($db,$sql2);
			$num1=mysqli_num_rows($result1);
			$result = mysqli_query($db,$sql1);
			$num = mysqli_num_rows($result);
			if($num>0){
				echo "<script>alert('Username already taken please select other username');</script>";
				return "FALSE";
			}

			elseif($num1>0){
					echo "<script>alert('Email is already in use');</script>";
					return "FALSE";
				}
			
			else{
			return "TRUE";
	}
		}

if(isset($_POST["cre"])){
	if(empty($_POST["username"]))
		echo "<script>alert('Please enter username');</script>";
	else if(empty($_POST["fname"]))
		echo "<script>alert('Please enter firstname');</script>";
	else if(empty($_POST["lname"]))
		echo "<script>alert('Please enter lastname');</script>";
	else if(empty($_POST["emailaddr"]))
		echo "<script>alert('Please enter E-mail ID');</script>";
	else if(empty($_POST["password"]))
		echo "<script>alert('Please enter Password');</script>";

	else{
		$u = $_POST['username'];
		$f = $_POST["fname"];
		$l = $_POST["lname"];
		$e = $_POST["emailaddr"];
		$p = md5($_POST["password"]);

		$allowed = array('gif','png' ,'jpg');
			$filename = $_FILES['file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed)) 
				echo "<script>alert('".$ext." file format is not allowed. Upload jpg, png or gif format only.')</script>";
			else{
				$file=addslashes(file_get_contents($_FILES["file"]["tmp_name"]));}

		if(empty($_POST["contact"]))
			$c=NULL;
		else
			$c = $_POST["contact"];
		
		if(checkduplicate($u,$e)=="TRUE"){
			$sql = "INSERT INTO `userdetails`(`userName`,`fname`,`lname`,`password`,`email`,`contact`, `profile_pic`) VALUES ('$u','$f','$l','$p','$e','$c', '$file')";
			if(mysqli_query($db,$sql)){
				// echo "<script>alert('Your blog account is created.');</script>";
				// $sql2 = "SELECT `Id`,`userName`,`password` FROM `userdetails` WHERE `username`= '$u' and `password`= '$p'";
				// $result2 = mysqli_query($db,$sql);
				// $num2=mysqli_num_rows($result);
				// $row2=mysqli_fetch_array($result,MYSQLI_ASSOC);
				header('location:signin.php');
			}
			else
			{
				echo "<script>alert('Something went wrong.Please try again');</script>";
			}

		}
		
	}
}

?>