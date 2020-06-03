<?php
session_start();
include "classes.php";

$checkContact = new contacts();
if(isset($_POST['contactInfo']))
{
	$checkContact->setUserName($_SESSION['userName']);
	$checkContact->setRequest($_POST['contactInfo']);
	$checkContact->checkRequset();
}
?>