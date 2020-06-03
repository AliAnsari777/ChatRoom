<?php 
session_start();
	include "classes.php";
	$newMessage = new chat();
	
	$newMessage->setSenderUserName($_SESSION['userName']);
	$newMessage->newMessage();
?>