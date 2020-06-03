<?php
	session_start();
	include "classes.php";
	
	$removeContact = new contacts();
	$removeContact->setUserName($_SESSION['userName']);
	$removeContact->setContactID($_POST['ContactID']);
	$removeContact->removeContact();
?>