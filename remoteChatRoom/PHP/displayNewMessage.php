<?php
	session_start();
	include "classes.php";
	$displayNewMessage = new chat();
	
	$displayNewMessage->setSenderUserName($_SESSION['userName']);
	$displayNewMessage->setReceiverUserName($_SESSION['receiverUserName']);
	$displayNewMessage->displayNewMessage();
?>
