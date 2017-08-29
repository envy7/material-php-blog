
<html>
<head>
	<title>Users</title>
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
	        <li  class='active'><a href='userpermit.php'>Users</a></li>
	        <li><a href='admin.php'>Blogs</a></li>
	        <li><a href="#modal1" class="modal-trigger">Profile</a></li>
	        <li><a href="collapsible.html">Contact Us</a></li>
	        <li><a href="signout.php">Log Out</a></li>
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

	<h1 align = 'center' style='font-size:33px;color: #fff'>Users</h1>
	<?php 	
		require 'session.php';
		require 'connect.php';
		$id = $_SESSION["id"];
		// retrieve user info

		
		$userdetailsql = "SELECT * FROM `userdetails` WHERE `Id` = '$id'";
		$userinforesult = mysqli_query($db,$userdetailsql);
		$userinfo = mysqli_fetch_array($userinforesult,MYSQLI_ASSOC);

		$allusers = "SELECT * FROM `userdetails`";
		$alluserslist = mysqli_query($db,$allusers);
		$num_users = mysqli_num_rows($alluserslist);



		echo"   <div class='row users-table z-depth-2'><form><table class='centered'>
			        <thead>
			          <tr>
			              <th data-field='id'>UserId</th>
			              <th data-field='username'>Username</th>
			              <th data-field='name'>Email</th>
			              <th data-field='status'>Status</th>
			          </tr>
			        </thead>

			        <tbody>";
	          
	        

		$i = 0;
		for($i; $i < $num_users; $i++){
			$row = mysqli_fetch_array($alluserslist ,MYSQLI_ASSOC);
			if($row['userName'] != 'admin'){
				echo "<tr>
		            <td id='user_id'>".$row['Id']."</td>
		            <td>".$row['userName']."</td>
		            <td>".$row['email']."</td>";

			    echo    "<td><div class='switch'>
						    <label>
						      ";
				if($row['status'] == 'N'){
					echo "<input type='checkbox' onchange='changePermission(this.checked, ".$row['Id'].")'>";
				}		      
				else{
					echo "<input type='checkbox' checked='checked' onchange='changePermission(this.checked, ".$row['Id'].")'>";
				}
				echo		"<span class='lever'></span>
						      
						    </label>
						</div></td>";
			    echo    "</tr>";
			}
		}	

		echo 		"</tbody></form>
	      		</table></div>";	

		echo "<div id='modal1' class='modal'>
			    <div class='modal-content'>
			      <div class='row'>
			      		<div class='col l6 m6 s6'>
					      		<img class='user-avatar' src='get_image.php?avatarid=".$userinfo['Id']."'>
					    </div>
					    <div class='col l6 m6 s6'>
					      		<h4 class='userinfo'>".$userinfo['userName']."</h4>
							    <p class='userinfo'>".$userinfo['fname']." ".$userinfo['lname']."</p>
							    <p class='userinfo'>".$userinfo['email']."</p>
							    <p class='userinfo'>".$userinfo['contact']."</p>
					    </div>
			      </div>		
			    </div>
			    <div class='modal-footer'>
			      <a href='#!' class=' modal-action modal-close waves-effect waves-green btn-flat'>Close</a>
			    </div>
			  </div>";
		
	
	?>	

	

	
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
      	$('.modal-trigger').leanModal();


      	
		function changePermission(str, userId) {
		    	
		    	var dataString = 'id='+ userId+'&status='+str;
		     	
		        $.ajax({
			        type: "GET",
					url : 'changepermit.php',
					data : dataString,
					success : function(data){
						console.log(data);
					}
				});
		    
		    console.log(str);
		    console.log(userId);
		}
		</script>
      	
  
</body>
</html>

