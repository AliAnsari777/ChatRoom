<?php 
	include "classes.php";
	session_start();
	$checkPassword = new profile();
	
	$checkPassword->setPassword($_POST['oldPassword']);
	$checkPassword->setUserName($_SESSION['userName']);
	$checkPassword->checkOldPassword();
?>