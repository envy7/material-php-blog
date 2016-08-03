

<?php 
require 'connect.php';
require 'session.php';
if(login()){
	$id = $_SESSION["id"];
}

	$sql = "SELECT `blog_id`, `title`,`detail`,`category`,`status` FROM `blogs` WHERE `blogger_id`= '$id' ORDER BY `created_on` DESC ";
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
	<div class="navbar-fixed z-depth-2"> 
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
	
	<h1 align = "center" ></h1>
	<?php 
		$i = 0;
		for($i; $i < $num; $i++){	
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$blgid = $row['blog_id'];
			$array = explode(" ," , $row['category']);
			// echo "<div class='row'>
		 //             <div style='margin: 0 auto;width:60%'>
		 //    	       <div class='card z-depth-4' style='background-color:#6380d6'>
		 //    	         <div class='card-content white-text'>
		 //    	           <span class='card-title'>"
		 //    					.$row['title'].
		 //    	   			"</span>
		 //    	            <p>"
		 //    	 				.$row['detail'].		
		 //    	            "</p>
		 //    	        </div>
		 //    	        <div class='card-action' style='border-top: 3px solid #3f51b5'>";
		    
		 //    	        for($j = 0; $j < sizeof($array); $j++){
		 //    	        	echo "<p class='category z-depth-2'>".$array[$j]."</p>";
		 //    	        }
		         
		 //    	          // <p>
		 //    	          //    .$array[0].
		 //    	          // </p>
		 //    echo	        "</div>
		 //    	       </div>
		 //    	      </div>
		 //    	   </div>";

		    echo "<div class='row'>
		             <div style='margin: 0 auto;width:60%'>


		    	<div class='card'>
			    <div class='card-image waves-effect waves-block waves-light'>";
			echo    "<img class='activator' src='get_image.php?id=".$blgid."'>";

			echo     "</div>
			    <div class='card-content'>
			      <span class='card-title activator grey-text text-darken-4'>".$row['title']."<i class='material-icons right'>more_vert</i></span>";
			      echo "<br>";
						for($j = 0; $j < sizeof($array); $j++){
		     	        	echo "<p class='category z-depth-2'>".$array[$j]."</p>";
		     	        }   
		    echo	    "</div>
			    <div class='card-reveal'>
			      <span class='card-title grey-text text-darken-4'>".$row['title']."<i class='material-icons right'>close</i></span>
			      <p style='margin: 20px 0px;font-size:18px'>".$row['detail']."</p>
			    </div>
			  </div>
			  </div>
			  </div>" 	;   
		}
	
	?>

	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	    <a class="btn-floating btn-large waves-effect waves-light pink accent-3  z-depth-4">
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

