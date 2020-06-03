<?php
/*****************************************************************************
this file is only to set the chat type value in session because it
isn't possible to post data to insertMessage.php file and use it later.
so I have to set the value to session in diffrent file and use session 
value in insertMessage.php to determine this is a singular or gregarious chat
*****************************************************************************/
	session_start();
	$_SESSION['chatID'] = $_POST['chatType'];
?>