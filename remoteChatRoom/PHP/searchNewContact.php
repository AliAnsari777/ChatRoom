<?php
session_start();
include "classes.php";

$newContact = new contacts();
if(isset($_POST['searchData']))
{
	$newContact->setSearch($_POST['searchData']);
	$newContact->setUserName($_SESSION['userName']);
	$newContact->searchNewContact();
}
?>