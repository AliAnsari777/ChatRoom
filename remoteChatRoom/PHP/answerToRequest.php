<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Answer To Request</title>
<link type="text/css" href="../CSS/style.css" >
</head>

<body>
<div id="request">
	<?php if(!empty($_SESSION['name']))
	{
	?>
		<h3>Salam Alaikum <?php echo $_SESSION['name'] ?>, I'm <?php echo $_POST['contactName'] ?>
    	and I want to add you in my contact list. Do you agree?</h3>
    <?php
	}
	else
	{
	?>
		<h3>Salam Alaikum, I'm <?php echo $_POST['contactName'] ?>
    	and I want to add you in my contact list. Do you agree?</h3>
    <?php
	}
	?>
</div>
</body>
</html>
