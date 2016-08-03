<?php
session_start();
function login()
{
	if(isset($_SESSION["login-with-blog"]))
	{
		$loged=TRUE;
		return $loged;
	}
}
?>