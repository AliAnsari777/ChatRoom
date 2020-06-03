<?php 
session_start();
include "classes.php";
$profileData = new profile();

	if($_POST['name'] == "" || $_POST['lastName'] == "" || $_POST['email'] == "" || $_POST['gender'] == "")
	{
		echo "<script type='text/javascript'>
		alert('Please fill the required fileds!');
		location = '../HTML/updateProfile.html'
		</script>";
	}
	else
	{
		$profileData->setName($_POST['name']);
		$profileData->setLastName($_POST['lastName']);
		$profileData->setPhoneNumber($_POST['phoneNumber']);
		$profileData->setEmail($_POST['email']);
		$profileData->setDateOfBirth($_POST['dateOfBirth']);
		$profileData->setGender($_POST['gender']);
		$profileData->setCountry($_POST['country']);
		$profileData->setProvince($_POST['province']);
		$profileData->setCity($_POST['city']);
		$profileData->setEmotion($_POST['emotion']);
		$profileData->setUserName($_SESSION['userName']);
		if($_FILES['photo']['size'] != 0)
		{
			$picture = $_FILES['photo']['name'];
			// this line replace spaces in file names whit under line and (\s+) is for multiple space
			$picture = preg_replace("/\s+/","_", $picture);
			move_uploaded_file($_FILES['photo']['tmp_name'],'../FILES/images/' . $picture);
			$profileData->setPhoto('/FILES/images/' . $picture);
		}
		else
		{
			$profileData->setPhoto("");
		}
		
		$profileData->updateMyProfile();
		// close the profile window after update the profile
		echo "<script type='text/javascript'>
			window.close();
		</script>";
	}
?>