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

<body>

	<form action = "signin.php" method = "POST" enctype = "utf-8"> 
		<p class="fieldset">
			<label for="signup-username">Username</label>

			<input class="image-replace cd-username" type = "text" name = "username" placeholder="User Name" maxlength = 30 required>
		</p>

		<p class="fieldset">
			<label for="signup-username">Password</label>

			<input class="image-replace cd-username" type = "password" name = "password" placeholder="Password" required> 
		</p>
		<p class="fieldset">
			<a href="forget.php">Forgot your password?</a>
		</p>

		<p class="fieldset">
			<input class="full-width" type="submit" name="login" value="Login">
		</p>
	</form>

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
			$p = $_POST['password'];

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