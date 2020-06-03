<?php 
session_start();
include "classes.php";
	
	$approveRequest = new contacts();
	
	$approveRequest->setUserName($_SESSION['userName']);
	$approveRequest->setRequest($_POST['contactRequest']);
	$approveRequest->acceptRequest();
	
?>