<?php

//create a connection with MySQL which is located in our local computer and because of that the first parametr is "localhost " and the second parametr user name is "root" and the third is password and the last is database name.
$connection = new mysqli("localhost","root","","chatroom");

//By this line of code we will be able to save dari in database and in database charset should be uft8_general_ci
$connection->set_charset("utf8");

//checking the connection maded succesfuly
if($connection->connect_error){
	die("Connection failed: " . $connection->connect_error);
	}

?>