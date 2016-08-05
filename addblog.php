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
	<div class="row" style="margin: 20 auto;width: 70%">
	    <form class="col s12" action = "addblog.php" method = "POST" enctype = "multipart/form-data">
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
		        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		        <input id= "file" name = "file" type="file">
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
	  if(!empty($tagarray)){
		$string = $tagarray[0][0];
		$i=1;
		while(!empty($tagarray[0][$i])){
			$string.=",";
			$string.=$tagarray[0][$i];
			$i++;
		}
		return $string;
	}
	else
		return NULL;
	}
	
	if(isset($_POST["add_blog"]) && $_FILES['file']['size'] > 0){
		

		if(empty($_POST["blog_heading"]))
			echo "<script>alert('Please enter heading');</script>";
		else if(empty($_POST["blog_des"]))
			echo "<script>alert('Please enter description');</script>";
		else if(empty($_POST["blog_category"]))
			echo "<script>alert('Please enter category');</script>";
		else if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
			echo "<script>alert('Please upload image.')</script>";	
		}
		else{
			$allowed = array('gif','png' ,'jpg');
			$filename = $_FILES['file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed)) 
				echo "<script>alert('".$ext." file format is not allowed. Upload jpg, png or gif format only.')</script>";
			else{
				$file=addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
				$h = $_POST['blog_heading'];
				$d = $_POST["blog_des"];
				$c = $_POST["blog_category"];	
				
				$tags = getTags($c);
				//echo "$tags[0]";

				$sql = "INSERT INTO `blogs`(`blogger_id`,`title`,`detail`,`category`, `status`, `editedBy`) VALUES ('$id','$h','$d','$tags', 'W', 'U')";
				
				mysqli_query($db,$sql);
				$sql1 = "SELECT `blog_id` from `blogs` ORDER BY `blog_id` DESC";
				$r=mysqli_query($db,$sql1);
				$row=mysqli_fetch_array($r,MYSQLI_NUM);
				$last_id=$row[0];
				$sql2 = "INSERT INTO `blog_detail`(`blog_id`,`image`) VALUES('$last_id','$file')";
				if(mysqli_query($db,$sql2)){
					header("location:home.php");
				}
				else
				{
					echo"<script>alert('There was a problem in posting the blog')</script>";

				}	
			}		
		}
	}
	


?>	
	
