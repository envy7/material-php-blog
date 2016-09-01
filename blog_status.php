<?php 
require 'connect.php';
	

$id = $_SESSION["id"];

if($_SESSION['username'] != 'admin'){
	$sql_all = "SELECT COUNT(*) FROM `blogs` WHERE `blogger_id` = '$id'";
	$sql_approved = "SELECT COUNT(*) FROM `blogs` WHERE `status` = 'A' AND `blogger_id` = '$id'";
	$sql_waiting = "SELECT COUNT(*) FROM `blogs` WHERE `status` = 'W' AND `blogger_id` = '$id'";
	$sql_rejected = "SELECT COUNT(*) FROM `blogs` WHERE `status` = 'R' AND `blogger_id` = '$id'";
}
else{
	$sql_all = "SELECT COUNT(*) FROM `blogs`";
	$sql_approved = "SELECT COUNT(*) FROM `blogs` WHERE `status` = 'A'";
	$sql_waiting = "SELECT COUNT(*) FROM `blogs` WHERE `status` = 'W'";
	$sql_rejected = "SELECT COUNT(*) FROM `blogs` WHERE `status` = 'R'";
}

$result_all = mysqli_query($db,$sql_all);
$result_approved = mysqli_query($db,$sql_approved);
$result_waiting = mysqli_query($db,$sql_waiting);
$result_rejected = mysqli_query($db,$sql_rejected);

$num_all = mysqli_fetch_array($result_all);
$num_approved = mysqli_fetch_array($result_approved);
$num_waiting = mysqli_fetch_array($result_waiting);
$num_rejected = mysqli_fetch_array($result_rejected);


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