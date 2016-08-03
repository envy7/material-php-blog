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
</head>

<body>
	<center>
		<div >
			<form action = "signup.php" method = "POST" enctype = "utf-8"> 
				<p class="fieldset">
					<label for="signup-username">First name</label>

					<input class="image-replace cd-username" type = "text" name = "fname" placeholder="First Name" maxlength = 30 required>
				</p>

				<p class="fieldset">
					<label for="signup-username">Last name</label>

					<input class="image-replace cd-username" type = "text" name = "lname" placeholder="Last Name" maxlength = 30 required>
				</p>
				<p class="fieldset">
					<label for="signup-username">Email Address </label>

					<input class="image-replace cd-username" type = "email" name = "emailaddr" placeholder="Email Address" required> 
				</p>
				<p class="fieldset">
					<label for="signup-username">Username</label>

					<input class="image-replace cd-username" type = "text" name = "username" placeholder="User Name" maxlength = 30 required>
				</p>

				<p class="fieldset">
					<label for="signup-username">Password</label>

					<input class="image-replace cd-username" type = "password" name = "password" placeholder="Password" required> 
				</p>
				<p class="fieldset">
					<label for="signup-username">Contact</label>

					<input class="image-replace cd-username" type = "number" name = "contact" placeholder="Contact Number"> 
				</p>
				<p class="fieldset">

					<input class="full-width has-padding" type="submit" value="Create account" name="cre">
				</p>


			</form>
		</div>
	</center>
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
		$p = $_POST["password"];
		if(empty($_POST["contact"]))
			$c=NULL;
		else
			$c = $_POST["contact"];
		
		if(checkduplicate($u,$e)=="TRUE"){
			$sql = "INSERT INTO `userdetails`(`userName`,`fname`,`lname`,`password`,`email`,`contact`) VALUES ('$u','$f','$l','$p','$e','$c')";
			if(mysqli_query($db,$sql)){
				echo "<script>alert('Your blog account is created.');</script>";
				header('Refresh: 2;URL= contact_admin.php');
			}
			else
			{
				echo "<script>alert('Something went wrong.Please try again');</script>";
			}

		}
		
	}
}

?>