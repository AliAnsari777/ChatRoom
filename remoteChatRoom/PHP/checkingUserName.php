<?php

	include "classes.php";
	$chkUser = new user();
	
	$chkUser->setUserName($_POST['userName']);
	$chkUser->checkUserName();


?>