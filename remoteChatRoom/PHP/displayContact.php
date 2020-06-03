<?php
	session_start();
	include "classes.php";

	$contact = new contacts();
	
	$contact->setUserName($_SESSION['userName']);
	$contact->displayContacts();	
?>