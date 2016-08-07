
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
	      <a href="#" class="brand-logo center">Blog</a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <form class="nav-search">
	      	<div class="input-field">
		      	<input type="search" id="search" name="search" required>
		      	<label for="search"><i class="material-icons">search</i></label>
		      	<i class="material-icons">close</i>
	      	</div>
	      </form>
	      <ul id='nav-mobile' class='right hide-on-med-and-down'>
	      <?php 
	      		require 'session.php';
	      		if(!login()){
					echo "
				        <li class='active'><a href='signin.php'>Sign In</a></li>
				        <li><a href='signup.php'>Sign Up</a></li>
				      </ul>";
				}
				else{
					echo "
					<li  class='active'><a href='index.php'>Home</a></li>
					<li><a href='home.php'>Your Blogs</a></li>
	        		<li><a href='badges.html'>Profile</a></li>
	        		<li><a href='collapsible.html'>Contact Us</a></li>";
				}	
	      		
	      ?>
	      </ul>
	    </div>
	  </nav>
	</div>

	<h1 align = "center" ></h1>
	
	<?php 	

		require 'connect.php';
		
		if(isset($_GET['search']))
		{
			$tmp = $_GET['search'];
			$sql = "SELECT * FROM `blogs` WHERE (`status`='A' AND `category` LIKE '%$tmp%') OR (`status`='A' AND `detail` LIKE '%$tmp%') OR (`status`='A' AND `title` LIKE '%$tmp%') ORDER BY `updated_on` DESC";
		}
		else{
			$sql = "SELECT * FROM `blogs` WHERE `status`='A' ORDER BY `updated_on` DESC";
		}
		
				
			
			$result = mysqli_query($db,$sql);
			$num=mysqli_num_rows($result);
			
			$i = 0;
			for($i; $i < $num; $i++){	
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$blgid = $row['blog_id'];
				$bloggerid = $row['blogger_id'];
				$status = $row['status'];
				$array = explode(" ," , $row['category']);
				$sql1 = "SELECT `userName` FROM `userdetails` WHERE `Id`='$bloggerid'";

				$result1 = mysqli_query($db,$sql1);
				$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
				$username = $row1['userName'];
				
			    echo "<div class='row'>
			             <div style='margin: 0 auto;width:50%'>


			    	<div class='card'>

				    <div class='card-image waves-effect waves-block waves-light'>";
				
				echo    "<img class='activator' src='get_image.php?id=".$blgid."'>";

				echo     "</div>
				    <div class='card-content'>
				      <span style='line-height: 25px' class='card-title activator grey-text text-darken-4'>".$row['title']." <span style='color:#f50057'>by</span> <span class='blogger'>".$username."</span><i class='material-icons right'>more_vert</i></span>";
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

			if(login()){
					echo "<div class='fixed-action-btn' style='bottom: 45px; right: 24px;'>
						    <a class='btn-floating btn-large waves-effect waves-light pink accent-3  z-depth-4'>
						      <i class='large material-icons'>add</i>
						    </a>
						  </div>";
				}
		
		
	
	?>	

	
	<!--Import jQuery before materialize.js-->

      <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript">
      	$('.fixed-action-btn').click(function(){
      		window.location.href = "addblog.php";
      	})
      </script>
</body>
</html>

