<?php 
require 'connect.php';
require 'session.php';

if(!login()){
			$_SESSION['username'] = 'Guest';

}
?>

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
	      <a href="#" class="brand-logo">Blogger</a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="index.php">Home</a></li>
	        <?php
	        	if($_SESSION['username'] == 'admin'){
	        		echo "<li><a href='userpermit.php'>Users</a></li>";
	        		echo "<li class='active'><a href='admin.php'>Blogs</a></li>";
	        	}
	        	else if($_SESSION['username'] != 'Guest' && $_SESSION['username'] != 'admin'){
	        		echo "<li class='active'><a href='home.php'>Your Blogs</a></li>";
	        	}
	        ?>
	        <?php
	        	if($_SESSION['username'] != 'Guest'){
	        		echo "<li><a href='#modal1' class='modal-trigger'>Profile</a></li>";
	        	}
	        ?>
	        <?php
	        	if($_SESSION['username'] == 'admin'){
	        		echo "<li><a href='contactus.php'>Messages</a></li>";
	        	}
	        	else if($_SESSION['username'] != 'Guest' && $_SESSION['username'] != 'admin'){
	        		echo "<li><a href='contactus.php'>Contact Us</a></li>";
	        	}
	        ?>
	        <?php
	        	if($_SESSION['username'] != 'Guest') {
	        		echo "<li><a href='signout.php'>Log Out</a></li>" ;
	        	}
	        ?>
	       
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
			
			$searchCat = $_GET['cat'];
			$sql = "SELECT * FROM `blogs` WHERE `category` LIKE '%$searchCat%' AND `status` = 'A' ";
			$result1 = mysqli_query($db,$sql);
			$num=mysqli_num_rows($result1);
			echo "<h1 class='cat-heading'>#".$searchCat."</h1>";
			$i = 0;
			for($i; $i < $num; $i++){	
				$row = mysqli_fetch_array($result1,MYSQLI_ASSOC);
				$blgid = $row['blog_id'];
				$status = $row['status'];
				$array = explode(" ," , $row['category']);


			
			    echo "<div class='row'>
			             <div style='margin: 0 auto;width:50%'>


			    	<div class='card z-depth-3'>

				    <div class='card-image waves-effect waves-block waves-light'>";
				
				echo    "<img class='activator' src='get_image.php?id=".$blgid."'>";

				echo     "</div>
				    <div class='card-content'>
				      <span style='line-height: 25px' class='card-title activator grey-text text-darken-4'>".$row['title']."<i class='material-icons right'>more_vert</i></span>";
				      echo "<br>";
							for($j = 0; $j < sizeof($array); $j++){
			     	        	echo "<a href='category.php?cat=".substr($array[$j], 1)."' class='btn waves-effect waves-light category z-depth-2' value=".$array[$j].">".$array[$j]."</a>";
			     	        }   
			    echo	    "</div>
				    <div class='card-reveal'>
				      <span class='card-title grey-text text-darken-4'>".$row['title']."<i class='material-icons right'>close</i></span>
				      <p style='margin: 15px 0px;font-size:15px'>".$row['detail']."</p>
				    </div>
				  </div>
				  </div>
				  </div>" 	;   
			}

?>
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>