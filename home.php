<?php
require 'session.php';
 
$priviledge = $_SESSION['username'];
require 'profile.php';
display_blogs($priviledge);

?>