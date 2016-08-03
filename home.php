<?php
	require "connect.php";
	require "session.php";
	if(!login())
	{
		header("location:../index.php");
	}
	if($_SESSION["username"]=="admin")
		header('location:admin.php');

	$id = $_SESSION['id'];

	$sql_all = "SELECT * FROM 'blogs' ORDER BY 'updated_on' DESC"

	$result = mysqli_query($db,$sql);
?>	
