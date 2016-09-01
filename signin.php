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
<title>SignIn</title>
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
	    <form class="col s12 add-blog-form z-depth-2" action = "signin.php" method = "POST" enctype = "utf-8" >
	      <div class="row">
	        <div class="input-field col s12" >
	          <input id="username" type="text" class="validate" name="username" maxlength = 30 required>
	          <label for="first_name">Username</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="password" type="password" class="validate" name="password" required>
	          <label for="password">Password</label>
	        </div>
	      </div>
	      <div align="center">
		    	<button class="btn waves-effect waves-light" type="submit" name="login">Login
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

if (isset($_POST['login'])){
	if(empty($_POST['username']))
		echo "<script>alert('Please enter username')</script>";

		elseif (empty($_POST['password']))
			{echo "<script>alert('Please enter password')</script>";}

		else{
			$u = $_POST['username'];
			$p = md5($_POST['password']);

			$sql = "SELECT `Id`,`userName`,`password` FROM `userdetails` WHERE `username`= '$u' and `password`= '$p'";
			$result = mysqli_query($db,$sql);
			$num=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

			if($num>1){
				echo "<script>alert('The database is inconsistent Please Contact Administrator')</script>";
				header('location:contact_admin.php');	
			}
			else if($num==1){
				$_SESSION['username']= $u;
				$_SESSION['id'] = $row['Id'];
				$_SESSION['login-with-blog'] = 1;

				if ($rm == "on"){
					setcookie("	username",$_POST['username'],time()+60*60*24);
				}

				if($_SESSION["username"]=="admin")
					header("location:admin.php");
				else {
					header("location:home.php");
				}
			}

			else{
				echo "<script>alert('Either username or password is Incorrect')</script>";
			}
		}
	}

	?>