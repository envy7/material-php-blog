
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
	        <li><a href="?get=W">Home</a></li>
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

	
	<?php 	
		require 'connect.php';
		// require 'session.php';

		if(isset($_GET['chd']) && isset($_GET['fun'])){
			$var = $_GET['chd'];
			$var1 = $_GET['get'];
			$var3 = $_GET['fun'];
			
			//echo $var1;
			if($var3=="D"){
				$sql = "DELETE FROM `blogs` WHERE `blog_id` = '$var'";
				$sql1 = "DELETE FROM `blog_detail` WHERE `blog_id` = '$var'";
				$db = $GLOBALS['db'];
				if(mysqli_query($db,$sql1) && mysqli_query($db,$sql)){
					echo "query running";
					header('location:'."?get=".$var1);
				}
				else{
					echo "<script>alert('There was some error');</script>";
					header('location:'."?get=".$var1);

				}
			}
			elseif($var3=="A"){
				$sql = "UPDATE `blogs` SET `status` = 'A' WHERE `blog_id` = '$var'";
				$db = $GLOBALS['db'];

				if(mysqli_query($db,$sql)){
					echo "query running";
					header('location:'."?get=".$var1);
				}
				else{
					echo "<script>alert('There was some error');</script>";
					header('location:'."?get=".$var1);

				}
			}
			elseif($var3=="R"){
				$sql = "UPDATE `blogs` SET `status` = 'R' WHERE `blog_id` = '$var'";
				$db = $GLOBALS['db'];

				if(mysqli_query($db,$sql)){
					echo "query running";
					header('location:'."?get=".$var1);
				}
				else{
					echo "<script>alert('There was some error');</script>";
					header('location:'."?get=".$var1);

				}


			}
		}

		if(isset($_GET['get']))
		{
			$tmp = $_GET['get'];
		}
		else
			$tmp ="All";

		require 'blog_status.php';
		$func = "active";

		echo "<div class='row'>	
			    <div class='col s12' style='padding:0px'>
			      <ul class='tabs'>";
	    echo	        "<li class='tab col s3'><a";
	    if($tmp == "All"){
	    	echo " class = 'active'";
	    }
	    echo " id='all' href='#test1'>All</a></li>";
	    echo	        "<li class='tab col s3'><a"; 
		if($tmp == "A"){
	    	echo " class = 'active'";
	    }

	    echo " id='approved' href='?get=A'>Approved</a></li>";
	    echo	        "<li class='tab col s3'><a";
if($tmp == "W"){
	    	echo " class = 'active'";
	    }
	    echo" id='waiting' href='?get=W'>Waiting</a></li>";
	    echo	        "<li class='tab col s3'><a";
if($tmp == "R"){
	    	echo " class = 'active'";
	    }
	    echo" id='rejected' href='?get=R'>Rejected</a></li>";
		echo	   '</ul>
			    </div>
			</div>
			
			<h1 align = "center" ></h1>';


		$priviledge = $GLOBALS['priviledge'];
		function display_blogs($priviledge){
			$num = $GLOBALS['num_query'];
			$result = $GLOBALS['result'];
			$i = 0;
			for($i; $i < $num; $i++){	
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$blgid = $row['blog_id'];
				$status = $row['status'];
				$array = explode(" ," , $row['category']);
			
			    echo "<div class='row'>
			             <div style='margin: 0 auto;width:50%'>


			    	<div class='card'>

				    <div class='card-image waves-effect waves-block waves-light'>";
				if($priviledge == "admin" && $_SESSION['username']=="admin"){
					if($status == "A"){
						$var2 = $GLOBALS['tmp'];
						echo "<div class='actions'>";
						echo "<a class= 'z-depth-2' href = '?get=".$var2."&chd=".$row['blog_id']."&fun=R'>Reject</a>";
						echo "<a class= 'z-depth-2' href = '?get=".$var2."&chd=".$row['blog_id']."&fun=D'>Delete</a>";
						echo "</div>";
					}
					elseif($status == "W"){
						$var2 = $GLOBALS['tmp'];
						echo "<div class='actions'>";
						echo "<a class= 'z-depth-2' href = '?get=".$var2."&chd=".$row['blog_id']."&fun=A'>Accept</a>";
						echo "<a class= 'z-depth-2' href = '?get=".$var2."&chd=".$row['blog_id']."&fun=D'>Delete</a>";
						echo "</div>";
					}
					elseif ($status == "R") {
						$var2 = $GLOBALS['tmp'];
						echo "<div class='actions'>";
						echo "<a class= 'z-depth-2' href = '?get=".$var2."&chd=".$row['blog_id']."&fun=A'>Accept</a>";
						echo "<a class= 'z-depth-2' href = '?get=".$var2."&chd=".$row['blog_id']."&fun=D'>Delete</a>";
						echo "</div>";
					}
				}
				elseif($priviledge == "user"){
					$var2 = $GLOBALS['tmp'];
					echo "<div class='actions'>";
					echo "<a class= 'z-depth-2' href = 'edit.php?id=".$row['blog_id']."&call=user'>Reject</a>";
					echo "</div>";	
				}    
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
		}
		
	
	?>	

	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	    <a class="btn-floating btn-large waves-effect waves-light pink accent-3  z-depth-4">
	      <i class="large material-icons">add</i>
	    </a>
	  </div>
	<!--Import jQuery before materialize.js-->

      <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript">
      	$(document).ready(function(){
      		$(".button-collapse").sideNav();
      		//$('ul.tabs').tabs();
      	})
      	$('.fixed-action-btn').click(function(){
      		window.location.href = "addblog.php";
      	})
      	$('#waiting').click(function(){
      		$('.tab > a').removeClass('active');
      		$(this).addClass('active');
      		setTimeout(function() {
      			window.location.href = "?get=W";
      		}, 400);
      		
      	})
      	$('#approved').click(function(){
      		$('.tab > a').removeClass('active');
      		$(this).addClass('active');
      		setTimeout(function() {
      			window.location.href = "?get=A";
      		}, 400);
      	})
      	$('#all').click(function(){
      		$('.tab > a').removeClass('active');
      		$(this).addClass('active');
      		setTimeout(function() {
      			window.location.href = "?get=All";
      		}, 400);
      	})
      	$('#rejected').click(function(){
      		$('.tab > a').removeClass('active');
      		$(this).addClass('active');
      		setTimeout(function() {
      			window.location.href = "?get=R";
      		}, 400);
      	})
      	
      </script>
</body>
</html>

