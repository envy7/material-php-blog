<?php 
require 'connect.php';

$id = $_SESSION["id"];
	if($priviledge == "admin"){
		if($tmp=="A"){
			$sql = "SELECT * FROM `blogs` WHERE `status`='A' ORDER BY `updated_on` DESC";
		}
		elseif ($tmp=="W"){
			$sql = "SELECT * FROM `blogs` WHERE `status`='W' ORDER BY `updated_on` DESC";
		}
		elseif($tmp=="R"){
			$sql = "SELECT * FROM `blogs` WHERE `status`='R' ORDER BY `updated_on` DESC";
		}
		elseif($tmp=="All"){
			$sql = "SELECT * FROM `blogs` ORDER BY `updated_on` DESC" ;
		}
	}
	else{
		if($tmp=="A"){
			$sql = "SELECT * FROM `blogs` WHERE `status`='A' AND `blogger_id` = '$id' ORDER BY `updated_on` DESC";
		}
		elseif ($tmp=="W"){
			$sql = "SELECT * FROM `blogs` WHERE `status`='W' AND `blogger_id` = '$id' ORDER BY `updated_on` DESC";
		}
		elseif($tmp=="R"){
			$sql = "SELECT * FROM `blogs` WHERE `status`='R' AND `blogger_id` = '$id' ORDER BY `updated_on` DESC";
		}
		elseif($tmp=="All"){
			$sql = "SELECT * FROM `blogs` WHERE `blogger_id` = '$id' ORDER BY `updated_on` DESC" ;
		}
	}

	

	$result = mysqli_query($db,$sql);
	$num_query = mysqli_num_rows($result);
?>