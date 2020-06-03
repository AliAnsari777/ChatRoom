<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log out</title>
</head>

<body>

<?php

	session_start();
	unset($_SESSION);
	session_destroy();
	header('Location: ../HTML/Login.html');
	exit;
?>


</body>
</html>