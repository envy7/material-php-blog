

<?php 
require 'connect.php';
require 'session.php';
if(login()){
	$id = $_SESSION["id"];
}

	$sql = "SELECT `title`,`detail`,`category`,`status` FROM `blogs` WHERE `blogger_id`= '$id' ORDER BY `created_on` DESC ";
	$result = mysqli_query($db,$sql);
	$num = mysqli_num_rows($result);
	//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="background-image: linear-gradient(90deg, rgba(80, 196, 214, 0.9) 0%, rgba(82, 113, 209, 0.9) 100%);">
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
	
	<h1 align = "center" >My Blogs</h1>
	<?php 
		$i = 0;
		for($i; $i < $num; $i++){
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			// echo "<div>";
			// echo $row['title'];
			// echo $row['detail'];
			// echo $row['category'];
			// echo $row['status'];
			// echo "</div>";
			echo "<div class='row'>";
		    echo     "<div style='margin: 0 auto;width:60%'>";
		    echo       "<div class='card pink accent-3'>";
		    echo         "<div class='card-content white-text'>";
		    echo           "<span class='card-title'>";
		    echo				$row['title'];
		    echo   			"</span>";
		    echo            "<p>";
		    echo 				$row['detail'];			
		    echo            "</p>";
		    echo        "</div>";
		    echo        "<div class='card-action' style='border-top: 3px solid #3f51b5'>";
		    echo          "<p>";
		    echo             $row['category'];
		    echo             $row['status'];
		    echo          "</p>";
		    echo        "</div>";
		    echo       "</div>";
		    echo      "</div>";
		    echo   "</div>";
		}
	
	?>

	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	    <a class="btn-floating btn-large waves-effect waves-light pink accent-3">
	      <i class="large material-icons">add</i>
	    </a>
	  </div>
	<!--Import jQuery before materialize.js-->

      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript">
      	$(document).ready(function(){
      		$(".button-collapse").sideNav();
      	})
      	$('.fixed-action-btn').click(function(){
      		window.location.href = "addblog.php";
      	})
      </script>
</body>
</html>

