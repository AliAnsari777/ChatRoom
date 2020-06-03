<?php
	
	include "classes.php";
	$user = new user();
		
		
	if($_POST['name'] == "" || $_POST['lastName'] == "" || $_POST['userName'] == "" ||
	$_POST['password'] == "" || $_POST['confPassword'] == "" || $_POST['email'] == "")
	{
		echo "<script type='text/javascript'>
		alert('Please fill the form completely!');
		location = '../index.html'
		</script>";
	}
	else
	{
		$user->setName($_POST['name']);
		$user->setLastName($_POST['lastName']);
		$user->setUserName($_POST['userName']);
		// in this part by using "password_hash" fucntion system hash passwords and then store in database
		$user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
		$user->setPhoneNumber($_POST['phoneNumber']);
		$user->setEmail($_POST['email']);
		$user->setDateOfBirth($_POST['dateOfBirth']);
		$user->setGender($_POST['gender']);
		$user->setCountry($_POST['country']);
		$user->setProvince($_POST['province']);
		$user->setCity($_POST['city']);
		$user->setEmotion($_POST['emotion']);
		if($_FILES['photo']['size'] != 0)
		{
			$picture = $_FILES['photo']['name'];
			// this line replace spaces in file names whit under line and (\s+) is for multiple space
			$picture = preg_replace("/\s+/","_", $picture);
			move_uploaded_file($_FILES['photo']['tmp_name'],'../FILES/images/' . $picture);
			$user->setPhoto('/FILES/images/' . $picture);
		}
		else
		{
			$gender = $user->getGender();
			if($gender == Male)
			{
				$user->setPhoto('/CSS/male.png');	
			}
			else
			{
				$user->setPhoto('/CSS/female.png');
			}
		}
		 
		$user->regUser();
		header('location: ../HTML/Login.html');
	}
?>