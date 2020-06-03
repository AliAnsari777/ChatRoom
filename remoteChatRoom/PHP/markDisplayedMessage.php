<?php 
	session_start();
	include "classes.php";
	$markDisplayedMessage = new chat();
	
	$markDisplayedMessage->setSenderUserName($_SESSION['userName']);
	$markDisplayedMessage->setReceiverUserName($_SESSION['receiverUserName']); // this value come from fullContactInfo.php
	$markDisplayedMessage->markDisplayedMessage();
?>