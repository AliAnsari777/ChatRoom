<?php
session_start();
include "classes.php";

$pendingContact = new contacts();
if(isset($_POST['contactInfo']))
{
	$pendingContact->setUserName($_SESSION['userName']);
	$pendingContact->setRequest($_POST['contactInfo']);
	$pendingContact->pendingRequest();
}
?>