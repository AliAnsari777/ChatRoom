<?php 
session_start();
include "classes.php";
	
	$denyRequest = new contacts();
	
	$denyRequest->setUserName($_SESSION['userName']);
	$denyRequest->setRequest($_POST['contactRequest']);
	$denyRequest->denyRequest();
	
?>