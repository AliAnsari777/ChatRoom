<?php
/*
	this file would check the contact table and display those rows tha has zero value in displayed column
	which means it is a new row and doesn't displayed to contact and after this file "markDisplayedContact.php"
	file would be called.
	But for now because there is other things to check in contact list I deny to use this functions and load the
	contact list every 10 second
*/
	session_start();
	include "classes.php";
	
	$newContact = new contacts();
	
	$newContact->setUserName($_SESSION['userName']);
	$newContact->displayNewContact();
?>