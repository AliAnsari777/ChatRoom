<?php
	session_start();
	
	include "classes.php";
	$user = new user();
	
	if(isset($_POST['userName']) && isset($_POST['password'])){
		 $user->setUserName($_POST['userName']);
		 $user->setPassword($_POST['password']);
		 if($user->loginUser() == true){
			 //This value which we assign to the $_SESSION['name'] come from loginUser() function
			 // which is combination of bind_result() and fetch() functions.
			 $_SESSION['name']=$user->getName();
			 $_SESSION['userName']=$user->getUserName();
		 }
	}

?>