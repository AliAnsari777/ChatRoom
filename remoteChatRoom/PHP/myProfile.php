<?php 
	session_start();
	include "classes.php";
	
	$myProfile = new profile();
	$myProfile->setUserName($_SESSION['userName']);
	$myProfile->myProfile();
?>