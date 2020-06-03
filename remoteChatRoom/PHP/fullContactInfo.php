<?php
session_start();	
include "classes.php";
$contactInfo = new contacts();

if(isset($_POST['contactUserName']))
{
	$contactInfo->setReceiverUserName($_POST['contactUserName']);
	// assigning receiverUserName in session to use in displayMessage.php and insertMessage.php
	// this approach prevent from useing another ajax call to send this value to these two file.
	$_SESSION['receiverUserName'] = $contactInfo->getReceiverUserName();
	$contactInfo->fullContactInformation();
}
		
?>

