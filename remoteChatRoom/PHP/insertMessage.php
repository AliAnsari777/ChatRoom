<?php
	session_start();
	include "classes.php";

	$chat = new chat();

	$chat->setSenderUserName($_SESSION['userName']);
	$chat->setReceiverUserName($_SESSION['receiverUserName']);
	$chat->setMessage($_POST['message1']);

	$chat->insertMessage();	
?>