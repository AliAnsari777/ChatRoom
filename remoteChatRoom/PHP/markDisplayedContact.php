<?php
/*  
	this file will update contact table and change displayed column to 1 so it would 
	marke it as displayed contact to user it cause that the selected contact doesn't 
	select in next time selection 
*/
	session_start();
	include "classes.php";
	
	$markDisplayeContact = new contacts();
	$markDisplayeContact->setUserName($_SESSION['userName']);
	$markDisplayeContact->markDisplayedContact();
?>