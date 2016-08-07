<?php 
	session_start();
	$_SESSION["login-with-blog"]=0;
	session_destroy();
	setcookie("username", "", time()-60*60*24*3);
	header("location:index.php");

?>