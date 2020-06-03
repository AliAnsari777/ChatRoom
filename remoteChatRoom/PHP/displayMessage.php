<?php 
session_start();
	include "classes.php";
	$displayMessages = new chat();
	
	$displayMessages->setSenderUserName($_SESSION['userName']);
	$displayMessages->setReceiverUserName($_SESSION['receiverUserName']);
	$displayMessages->displayMessage();
?>