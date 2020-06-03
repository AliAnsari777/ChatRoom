<?php
/* 
	this file whould check status of selected contact which is approved or its request is in pending
	or it is a new request or it is deleted from your contact list.	
*/

	session_start();
	include "classes.php";
	
	$checkRequestAnswer = new contacts();
	$checkRequestAnswer->setUserName($_SESSION['userName']);
	$checkRequestAnswer->setContactID($_POST['chkContact']);
	$checkRequestAnswer->checkContactStatus();
?>