<?php
require 'connect.php';
//header('content-type: image/jpeg');
if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$sql="SELECT `image` FROM `blog_detail` WHERE `blog_id`='$id'";
		$res=mysqli_query($db,$sql);
		$row=mysqli_fetch_assoc($res);
		//echo "reeached";
		$image=$row['image'];
		echo $image;	
	}

else if(isset($_GET['avatarid'])){
	$id = $_GET['avatarid'];
	$sql = "SELECT `profile_pic` FROM `userdetails` WHERE `Id` = '$id' ";
	$res = mysqli_query($db, $sql);
	$row=mysqli_fetch_assoc($res);
	$image=$row['profile_pic'];
	echo $image;
}

?>