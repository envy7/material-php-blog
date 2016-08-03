<?php 
require 'connect.php';
require 'session.php';
if(login()){
	
	$id = $_SESSION["id"];
}
?>

<html>
<head>
	<title>Add Blog</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
	<div class="navbar-fixed"> 
		<nav style="background-color: #3f51b5">
	    <div class="nav-wrapper">
	      <a href="#" class="brand-logo">Blog</a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="sass.html">Home</a></li>
	        <li class="active"><a href="sass.html">Your Blogs</a></li>
	        <li><a href="badges.html">Profile</a></li>
	        <li><a href="collapsible.html">Contact Us</a></li>
	      </ul>
	      <ul class="side-nav" id="mobile-demo">
	        <li><a href="sass.html">Home</a></li>
	        <li><a href="badges.html">Profile</a></li>
	        <li class="active"><a href="sass.html">Your Blogs</a></li>
	        <li><a href="collapsible.html">Contact Us</a></li>
	      </ul>
	    </div>
	  </nav>
	</div>
	<!--<center>
		<div >
			<form action = "addblog.php" method = "POST" enctype = "utf-8"> 
				<p class="fieldset">
					<input class="image-replace cd-username" type = "text" name = "blog_heading" placeholder="Heading" maxlength = 30 required>
				</p>

				<p class="fieldset">
					<input class="image-replace cd-username" type = "text" name = "blog_category" placeholder="category" maxlength = 30 required>
				</p>

				<p class="fieldset">
					<input class="image-replace cd-username" type = "text" name = "blog_des" placeholder="Description" maxlength = 30 required>
				</p>
				
				<p class="fieldset">
					<input class="full-width has-padding" type="submit" value="Add Blog" name="add_blog">
				</p>
			</form>
		</div>
	</center>-->
	<div class="row" style="margin: 20 auto;width: 70%">
	    <form class="col s12" action = "addblog.php" method = "POST" enctype = "utf-8">
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="heading" type="text" class="validate" name = "blog_heading">
	          <label for="heading">Title</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="category" type="text" class="validate" name = "blog_category" placeholder="Add categories seperated with hashtags">
	          <label for="category">Categories</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <textarea id="description" type="text" class="validate materialize-textarea" name = "blog_des" ></textarea>
	          <label for="description">Details</label>
	        </div>
	      </div>
	      <div class="file-field input-field">
		      <div class="btn">
		        <span>File</span>
		        <input type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
		    <div align="center">
		    	<button class="btn waves-effect waves-light" type="submit" name="add_blog">Submit
				    <i class="material-icons right">send</i>
				</button>
		    </div>
	    </form>
	</div>
</body>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript">
      	$(document).ready(function(){
      		$(".button-collapse").sideNav();
      	})
      	$('#textarea1').val('New Text');
  		$('#textarea1').trigger('autoresize');
      </script>
</html>


<?php 

	function getTags($string){
	  preg_match_all ("/(#(.*)\s)|(#(.*)$)/U", $string, $tagarray);
	  return $tagarray;
	}
	
	if(isset($_POST["add_blog"])){
		

		if(empty($_POST["blog_heading"]))
			echo "<script>alert('Please enter heading');</script>";
		else if(empty($_POST["blog_des"]))
			echo "<script>alert('Please enter description');</script>";
		else if(empty($_POST["blog_category"]))
			echo "<script>alert('Please enter category');</script>";
		else{
			$h = $_POST['blog_heading'];
			$d = $_POST["blog_des"];
			$c = $_POST["blog_category"];	
			
			$tags = getTags($c);
			//echo "$tags[0]";

			$sql = "INSERT INTO `blogs`(`blogger_id`,`title`,`detail`,`category`) VALUES ('$id','$h','$d','$tags')";
			if(mysqli_query($db,$sql)){
				//echo "<script>alert('Your blog has been added');</script>";
				header('Refresh: 1;URL= profile.php');
			}
			else
			{
				echo "<script>alert('Something went wrong.Please try again');</script>";

			}
			
		}
	}


?>	
	
