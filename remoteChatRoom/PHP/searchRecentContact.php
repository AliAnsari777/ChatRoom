<?php
	session_start();
	include "classes.php";
	
	$recentContact = new contacts();
	
	$recentContact->setUserName($_SESSION['userName']);
	$recentContact->setSearch($_POST['searchData']);
	$recentContact->searchContact();
?>