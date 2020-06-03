<?php
	session_start();
	include "classes.php";
	
	$changePassword = new profile();
	
	$changePassword->setUserName($_SESSION['userName']);
	$changePassword->setPassword(password_hash($_POST['newPassword'], PASSWORD_DEFAULT));
	$changePassword->updatePassword();
?>