<?php
/*******************************************************************
* This file contain all the classes which used in the program. 
* For easy maintenance and troubleshooting all classes and methods
* are defined in one file, and this file is the source of PHP codes.
********************************************************************/

/* this class has all the variable definition and allow access them.
* Beacuse all classes have the same need of variable definition,
* all of them are defined in a single class and other classes 
* inherit from this class. 
*/
class base
{
	private $name, $lastName, $userName, $password, $phoneNumber, $email, $dateOfBirth, $gender,
	$country, $province, $city, $emotion, $photo, $searchChars, $contactID, $senderUserName, $receiverUserName,
	$message, $messageDate, $request, $approved;
	

	public function setName($name)
	{
		$this->name=$name;	
	}
	public function getName()
	{
		return $this->name;	
	}

	public function setLastName($lastName)
	{
		$this->lastName=$lastName;
	}
	public function getLastName()
	{
		return $this->lastName;
	}

	public function setUserName($userName)
	{
		$this->userName=$userName;
	}
	public function getUserName()
	{
		return $this->userName;	
	}

	public function setPassword($password)
	{
		$this->password=$password;
	}
	public function getPassword()
	{
		return $this->password;
	}		
	
	public function setPhoneNumber($phoneNumber)
	{
		$this->phoneNumber=$phoneNumber;
	}
	public function getPhoneNumber()
	{
		return $this->phoneNumber;	
	}

	public function setEmail($email)
	{
		$this->email=$email;
	}
	public function getEmail()
	{
		return $this->email;	
	}

	public function setDateOfBirth($dateOfBirth)
	{
		$this->dateOfBirth=$dateOfBirth;	
	}
	public function getDateOfBirth()
	{
		return $this->dateOfBirth;	
	}

	public function setGender($gender)
	{
		$this->gender=$gender;	
	}
	public function getGender()
	{
		return $this->gender;	
	}

	public function setCountry($country)
	{
		$this->country=$country;	
	}
	public function getCountry()
	{
		return $this->country;	
	}

	public function setProvince($province)
	{
		$this->province=$province;	
	}
	public function getProvince()
	{
		return $this->province;	
	}

	public function setCity($city)
	{
		$this->city=$city;	
	}
	public function getCity()
	{
		return $this->city;	
	}

	public function setEmotion($emotion)
	{
		$this->emotion=$emotion;	
	}
	public function getEmotion()
	{
		return $this->emotion;	
	}

	public function setPhoto($photo)
	{
		$this->photo=$photo;	
	}
	public function getPhoto()
	{
		return $this->photo;	
	}

	public function setSearch($searchChars)
	{
		$this->searchChars=$searchChars;	
	}	
	public function getSearch()
	{
		return $this->searchChars;	
	}

	public function setContactID($contactID)
	{
		$this->contactID=$contactID;	
	}
	public function getContactID()
	{
		return $this->contactID;	
	}

	public function setSenderUserName($senderUserName)
	{
		$this->senderUserName=$senderUserName;
	}
	public function getSenderUserName()
	{
		return $this->senderUserName;
	}

	public function setReceiverUserName($receiverUserName)
	{
		$this->receiverUserName=$receiverUserName;
	}
	public function getReceiverUserName()
	{
		return $this->receiverUserName;
	}

	public function setMessage($message)
	{
		$this->message=$message;
	}	
	public function getMessage()
	{
		return $this->message;
	}
	
	public function setMessageDate($messageDate)
	{
		$this->messageDate=$messageDate;
	}	
	public function getMessageDate()
	{
		return $this->messageDate;
	}
	
	public function setRequest($request)
	{
		$this->request=$request;
	}	
	public function getRequest()
	{
		return $this->request;
	}
	
	public function setApproved($approved)
	{
		$this->approved=$approved;
	}	
	public function getApproved()
	{
		return $this->approved;
	}
}

//this class is for registering users and we use get and set functions to secure our variables and we have a regUser function to save user information in to database.
class user extends base
{
//we use prepared statment. a prepared statment is a feature used to execute the same SQL statment repeatedly with high efficiency(w3c site; php part; mysql database)
  	public function regUser(){
	  //connection.php is the file which establish connection to database 
	  include "connection.php";
	  $insertUser=$connection->prepare("insert into users values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	  $insertUser->bind_param("ssssissssssss", $name,$lastName,$userName,$password,$phoneNumber,
	  $email,$dateOfBirth,$gender,$country,$province,$city,$emotion,$photo);
	  
	  $name=$this->getName();
	  $lastName=$this->getLastName();
	  $userName=$this->getUserName();
	  $password=$this->getPassword();
	  $phoneNumber=$this->getPhoneNumber();
	  $email=$this->getEmail();
	  $dateOfBirth=$this->getDateOfBirth();
	  $gender=$this->getGender();
	  $country=$this->getCountry();
	  $province=$this->getProvince();
	  $city=$this->getCity();
	  $emotion=$this->getEmotion();
	  $photo=$this->getPhoto();
	  
	  $insertUser->execute();
	  $insertUser->free_result();
	}
	
	public function loginUser(){
		include "connection.php";
		
		$chkUser=$connection->prepare("select name, userName, password from users where userName = ?");
		$chkUser->bind_param("s", $userName);		
		$userName=$this->getUserName();
		$firstPassword=$this->getPassword();
		$chkUser->execute();
		// in mysqli prepared statment we must store the result at first and after that we can use other propertis on it 
		// like num_rows
		$chkUser->store_result();
		if($chkUser->num_rows == 1){
			/* 
			** for useing data inside mysqli object at first we should bind the values inside the object to variables
			** by using bind_result(). The number of variables we pass to this function should be same as the number of 
			** variables we recive from preaper function. in this example we recive name userName and password from data 
			** base and because of that we pass two variable to bind_result function.
			*/
			$chkUser->bind_result($name, $userName, $password);
			// After that we use fetch() funtion to use this values and assign them to variables and use it
			// latter to load in session variable and show it in chatApplication page
			while($chkUser->fetch()){
				$this->setName($name);
				$this->setUserName($userName);
				$this->setPassword($password);
			}
			// this condition check the provided password by user with stored password in database.
			// password_verify is a function which compare two hased values which hashed by password_hash() or crypt()
			if(password_verify($firstPassword,$this->getPassword()))
			{
				// At the end we should free the space and the result for next use.
				$chkUser->free_result();
				header('location:  chatApplication.php');
				return true;
			}
			else
			{
				echo "<script type='text/javascript'>
				  location = '../HTML/Login.html'
			  	  alert('Incorrect password!');
			      </script>";
				  return false;
			}
		}
		else
		{						
			echo "<script type='text/javascript'>
				  location = '../HTML/Login.html'
			  	  alert('Incorrect user name!');
			      </script>";
			return false;
			// when i use header in php the echo for java wouldn't work i should find the reason and a solution.
			// header('location:  ../HTML/Login.html');
		}
	}
	
	
	//this function check that the user name we enter is taken by someone else or its available.
	public function checkUserName(){
		include "connection.php";
		$chkUserName=$connection->prepare("select userName from users where userName = ?");
		$chkUserName->bind_param("s", $userName);
		
		$userName=$this->getUserName();
		
		$chkUserName->execute();
		
		$chkUserName->store_result();
		if($chkUserName->num_rows > 0){
	  		echo 1;
		}
		$chkUserName->free_result();
	}	
}


//the chat class is use to save chat massages in to the database. this class also has a similar function like user class.
class chat extends base{
	//this function insert userName and messages to the messages table.
  	public function insertMessage(){
		include "connection.php";
		$insertMsg=$connection->prepare("insert into messages (senderUserName, receiverUserName, message) values (?, ?, ?)");
		$insertMsg->bind_param("sss", $senderUserName, $receiverUserName, $message);
	  
	  	$senderUserName=$this->getSenderUserName();
	  	$receiverUserName=$this->getReceiverUserName();
	  	$message=$this->getMessage();
	  
	  	$insertMsg->execute();
		$insertMsg->free_result();
	}
	
	//this function retrieve data from database and show them
	public function displayMessage(){
		include "connection.php";
		// In where condition of this query senderUserName and receiverUserName are defined in two part
		// instead of each other to support bidirectional data retriveing.
		$displayMsg = $connection->prepare("select date, senderUserName, message from messages where (senderUserName = ?
		and receiverUserName = ?) or (senderUserName = ? and receiverUserName = ?)");
		$displayMsg->bind_param("ssss", $senderUserName, $receiverUserName, $receiverUserName, $senderUserName);
		
		$senderUserName=$this->getSenderUserName();
	  	$receiverUserName=$this->getReceiverUserName();
	  
		$displayMsg->execute();
		$displayMsg->store_result();

		$displayMsg->bind_result($messageDate, $senderUserName, $message);
		while($displayMsg->fetch()){
			$this->setSenderUserName($senderUserName);
			$this->setMessage($message); 
			$this->setMessageDate($messageDate);
			
			if($senderUserName != $receiverUserName)
			{
			?>
            <div style="text-align:right; margin:10px 5px; word-break:break-all">
            	<!-- this span with style attribute display messages whit beautiful appearance -->           
    			<span style=" display:inline-block; background-color:#809EE4; padding:5px 10px 5px 15px;
                border-radius:10px 10px 0px 10px;">
					<?php echo $this->getMessage(); ?>
                </span>
            </div>
            <?php
			}
			else
			{
			?>
			<div style="text-align:left; margin:10px 5px; word-break:break-all">               
  				<span style="display:inline-block; background-color:#BAC5F5; padding:5px 10px 5px 15px;
                border-radius:10px 10px 10px 0px;">
					<?php echo $this->getMessage(); ?>
                </span>
            </div>
            <?php		
			}
		}
		$displayMsg->free_result();
	}
	
	// this function just aware user that he/she has new message from on of his/her contacts
	public function newMessage(){	
		include "connection.php";
		// In where condition of this query senderUserName and receiverUserName are defined in two part
		// instead of each other to support bidirectional data retriveing.
			$newMessage=$connection->prepare("select senderUserName from messages where displayedToReciever = 0
			and receiverUserName = ?");
			$newMessage->bind_param("s", $senderUserName);
			
			$senderUserName=$this->getSenderUserName();
		  
			$newMessage->execute();
			$newMessage->store_result();
	
			$newMessage->bind_result($senderUserName);
			if($newMessage)
			{
				while($newMessage->fetch()){ 
					$this->setSenderUserName($senderUserName); 
					// when there is a new message the space at end of echo statment cause an error
					// which is visible in borwser inspect element section and say value=nothing
					// but program work fine and I don't know how to solve this error.
				    echo  $this->getSenderUserName() . " ";
				}	 
			$newMessage->free_result();
			}
	}
	
	//this function retrieve those messages that are not displayed to user
	public function displayNewMessage(){
		
		include "connection.php";
	
		
		// In where condition of this query senderUserName and receiverUserName are defined in two part
		// instead of each other to support bidirectional data retriveing.
		$displayMsg = $connection->prepare("select date, senderUserName, message from messages where
		(displayedToSender = 0 and (senderUserName = ? and receiverUserName = ?)) or
		(displayedToReciever = 0 and (receiverUserName = ? and senderUserName = ?))");
		
		$displayMsg->bind_param("ssss", $senderUserName, $receiverUserName, $senderUserName, $receiverUserName);
		
		$senderUserName=$this->getSenderUserName();
	  	$receiverUserName=$this->getReceiverUserName();
	  
		$displayMsg->execute();
		
		$displayMsg->store_result();

		$displayMsg->bind_result($messageDate, $senderUserName, $message);
				while($displayMsg->fetch()){
			$this->setSenderUserName($senderUserName);
			$this->setMessage($message); 
			$this->setMessageDate($messageDate);
			if($senderUserName != $receiverUserName)
			{
			?>
            <div style="text-align:right; margin:10px 5px; word-break:break-all">                
    			<span style=" display:inline-block; background-color:#809EE4; padding:5px 10px 5px 15px;
                border-radius:10px 10px 0px 10px;">
					<?php echo $this->getMessage(); ?>
                </span>
            </div>
            <?php
			}
			else
			{
			?>
			<div style="text-align:left; margin:10px 5px; word-break:break-all">               
  				<span style="display:inline-block; background-color:#BAC5F5; padding:5px 10px 5px 15px;
                border-radius:10px 10px 10px 0px;">
					<?php echo $this->getMessage(); ?>
                </span>
            </div>
            <?php		
			}
		}
		$displayMsg->free_result();
	}
	
	// this function update showed coulmn in messages table to true so displayed message whouldn't display twice.
	public function markDisplayedMessage()
	{
		include "connection.php";
		
		$checkMsg = $connection->prepare("UPDATE messages SET displayedToSender = 1 where
		displayedToSender = 0 and (senderUserName = ? and receiverUserName = ?)");
		$checkMsg->bind_param("ss", $senderUserName, $receiverUserName);
		$senderUserName=$this->getSenderUserName();
	  	$receiverUserName=$this->getReceiverUserName();
		$checkMsg->execute();
		
		$checkMsg2 = $connection->prepare("UPDATE messages SET displayedToReciever = 1 where
		displayedToReciever = 0 and (senderUserName = ? and receiverUserName = ?)");
		$checkMsg2->bind_param("ss", $receiverUserName, $senderUserName);
		$senderUserName=$this->getSenderUserName();
	  	$receiverUserName=$this->getReceiverUserName();
		$checkMsg2->execute();
	}
	
	
}

// contacts class is responsible for list of contact of a person, manage of frind request which send and recive between users
// and creating groups for group chat

class contacts extends base{	
	// this function display contant of contacts in contact list	
	public function displayContacts()
	{
		include "connection.php";
	
		$contacts = $connection->prepare("select contacts.contactID, contacts.request, contacts.approved,
		users.name, users.lastName, users.photo, users.emotion from contacts, users
		where contacts.userName = ? and users.userName = contacts.contactID");
		$contacts->bind_param("s", $userName);
		
		$userName=$this->getUserName();
		
		$contacts->execute();
		
		// after reciveing query result it will store and then fetch to diplay them.
		$contacts->store_result();
		$contacts->bind_result($contactID, $request, $approved, $name, $lastName, $photo, $emotion);
		while($contacts->fetch())
		{
			$this->setContactID($contactID);
			$this->setRequest($request);
			$this->setApproved($approved);
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setPhoto($photo);
			$this->setEmotion($emotion);
			?>
				<!-- this part display photo, name and last name and emotion of contacts. -->
				<div class="info" style="height:60px">
					<div style='margin-top:5px; margin-right:5px; display:inline; float:left'>
					   <?php echo "<img src=.." . $this->getPhoto() . " height='45' width='45' />" ?>
					</div>                 
					<div class="name" style="display:table; padding-top:5px; padding-bottom:10px">
					   <?php echo $this->getName() . "  " . $this->getLastName(); ?>
					</div>
					<div class="emotion" style="display:table">
					   <?php echo $this->getEmotion(); ?>
					</div>
					<input type="hidden" class="contId" value="<?php echo $this->getContactID(); ?>" />
                    <input type="hidden" class="request" value="<?php echo $this->getRequest(); ?>" />
                    <input type="hidden" class="approved" value="<?php echo $this->getApproved(); ?>" />
				</div>
			<?php
		}
		$contacts->free_result();
	}

 	// this function display the recent contact that user chat with them
	public function recentContact(){
		include "connection.php";
		
		$recentContact = $connection->prepare("select distinct messages.receiverUserName, 
		users.name, users.lastName, users.photo, users.emotion from messages, users
		where messages.senderUserName = ? and users.userName = messages.receiverUserName order by date desc");
		
		$recentContact->bind_param("s", $userName);
		
		$userName = $this->getUserName();
		$recentContact->execute();
		$recentContact->store_result();
		$recentContact->bind_result($receiverUserName, $name, $lastName, $photo, $emotion);
		while($recentContact->fetch())
		{
			$this->setReceiverUserName($receiverUserName);
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setPhoto($photo);
			$this->setEmotion($emotion);
			?>
            <!-- this part display photo, name and last name and emotion of contacts. -->
            <div class="info" style="height:60px">
                <div style='margin-top:5px; margin-right:5px; display:inline; float:left'>
                   <?php echo "<img src=.." . $this->getPhoto() . " height='45' width='45' />" ?>
                </div>                 
                <div class="name" style="display:table; padding-top:5px; padding-bottom:10px">
                   <?php echo $this->getName() . "  " . $this->getLastName(); ?>
                </div>
                <div class="emotion" style="display:table">
                   <?php echo $this->getEmotion(); ?>
                </div>
                <input type="hidden" class="contId" value="<?php echo $this->getReceiverUserName(); ?>" />
            </div>
            <?php
		}
		$recentContact->free_result();
	}
	
	public function displayNewContact()
	{
		include "connection.php";
	
		$newContact = $connection->prepare("select contacts.contactID, contacts.request, contacts.approved,
		users.name, users.lastName, users.photo, users.emotion from contacts, users
		where contacts.userName = ? and (request = 0 and approved = 0 and displayed = 0)
		and users.userName = contacts.contactID");
		$newContact->bind_param("s", $userName);
		
		$userName=$this->getUserName();
		
		$newContact->execute();
		
		// after reciveing query result it will store and then fetch to diplay them.
		$newContact->store_result();
		$newContact->bind_result($contactID, $request, $approved, $name, $lastName, $photo, $emotion);
		while($newContact->fetch())
		{
			$this->setContactID($contactID);
			$this->setRequest($request);
			$this->setApproved($approved);
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setPhoto($photo);
			$this->setEmotion($emotion);
			?>
				<!-- this part display photo, name and last name and emotion of contacts. -->
				<div class="info" style="height:60px">
					<div style='margin-top:5px; margin-right:5px; display:inline; float:left'>
					   <?php echo "<img src=.." . $this->getPhoto() . " height='45' width='45' />" ?>
					</div>                 
					<div class="name" style="display:table; padding-top:5px; padding-bottom:10px">
					   <?php echo $this->getName() . "  " . $this->getLastName(); ?>
					</div>
					<div class="emotion" style="display:table">
					   <?php echo $this->getEmotion(); ?>
					</div>
					<input type="hidden" class="contId" value="<?php echo $this->getContactID(); ?>" />
                    <input type="hidden" class="request" value="<?php echo $this->getRequest(); ?>" />
                    <input type="hidden" class="approved" value="<?php echo $this->getApproved(); ?>" />
				</div>
			<?php
		}
		$newContact->free_result();
	}
	
	// this function update displayed column in contacts table to prevent appending same new contact twice in contact list
	// and it will called after new contact is displayed to the user.
	public function markDisplayedContact()
	{
		include "connection.php";
		
		$mark = $connection->prepare("update contacts set displayed = 1 where userName = ? and (request=0 and approved=0)");
		$mark->bind_param("s", $userName);
		$userName = $this->getUserName();
		$mark->execute();
	}
	
	// this function retrive all information of contact and display it in right side of chat room
	public function fullContactInformation()
	{
		include "connection.php";
		$contactDetail = $connection->prepare("SELECT name, lastName, userName, phoneNumber, email, dateOfBirth,
		gender, country, province, city, emotion, photo FROM users where userName = ?");
		$contactDetail->bind_param("s", $userName);
		
		$userName=$this->getReceiverUserName();
		
		$contactDetail->execute();
		$contactDetail->store_result();
		
		$contactDetail->bind_result($name, $lastName, $userName, $phoneNumber, $email, $dateOfBirth, $gender,
		$country, $province, $city, $emotion, $photo);
		while($contactDetail->fetch())
		{
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setUserName($userName);
			$this->setPhoneNumber($phoneNumber);
			$this->setEmail($email);
			$this->setDateOfBirth($dateOfBirth);
			$this->setGender($gender);
			$this->setCountry($country);
			$this->setProvince($province);
			$this->setCity($city);
			$this->setEmotion($emotion);
			$this->setPhoto($photo);
			
			?>
	        <table id="contactInformation">
              <caption style="font-size:22px"> <?php echo $this->getName() . " " . $this->getLastName(); ?> </caption>
                <tr>
                	<td colspan="2"><?php echo $this->getEmotion(); ?></td>
                </tr>
            	<tr>
                	<td rowspan="4"> <?php echo "<img src=.." .  $this->getPhoto() ." height='150' width='150' 
					style='border:inset' />"; ?></td>
                </tr>
                <tr>
                </tr>
                <tr>
                	<td style="direction:rtl"><input id="removeContact" name="removeContact" type="button" value="Remove Contact"></td>             
                </tr>
                <tr>               	                    
                </tr>
                <tr>
                	<td>Chat ID</td>
                    <td><?php echo $this->getUserName(); ?></td>
                </tr>
                <tr>
                	<td>Email</td>
                    <td><?php echo $this->getEmail(); ?></td>
                </tr>
                <tr>
                	<td>Phone Number</td>
                    <td><?php echo $this->getPhoneNumber(); ?></td>
                </tr>
                <tr>
                	<td>Gender</td>
                    <td><?php echo $this->getGender(); ?></td>
                </tr>
                <tr>
                	<td>Birth Date</td>
                    <td><?php echo $this->getDateOfBirth(); ?></td>
                </tr>
                <tr>
                	<td>Country</td>
                    <td><?php echo $this->getCountry(); ?></td>
                </tr>
                <tr>
                	<td>Province</td>
                    <td><?php echo $this->getProvince(); ?></td>
                </tr>
                <tr>
                	<td>City</td>
                    <td><?php echo $this->getCity(); ?></td>
                </tr>                
            </table>
            <div id="removeMessage" hidden="true">
            	<p style="text-align:center;">Do you want to remove 
				<?php echo $this->getName() . " " . $this->getLastName(); ?> from your list?</p>
            </div>
            <?php
		}
		$contactDetail->free_result();
	}
	
	public function removeContact()
	{
		include "connection.php";
		
		$removeContact = $connection->prepare("delete from contacts where (userName = ? and contactID = ?) or
		(contactID = ? and userName = ?)");
		$removeContact->bind_param("ssss", $userName, $contactID, $userName, $contactID);
		
		$userName = $this->getUserName();
		$contactID = $this->getContactID();
		$removeContact->execute();
	}
	
	// this function search a contact between users in contact list
	public function searchContact()
	{
		include "connection.php";
		
		// by using the name of each table befor its column name, it is posible to select from two table with same column
		// name and it help us to understand which column belongs to which table. And I use this method in here.
		$contacts = $connection->prepare("select contacts.contactID, contacts.request, contacts.approved,
		users.name, users.lastName, users.photo, users.emotion from contacts, users where contacts.userName = ? and
		users.userName = contacts.contactID and (users.name LIKE ? or users.lastName LIKE ?)");
		$contacts->bind_param("sss", $userName, $searchChars, $searchChars);
		
		$userName=$this->getUserName();
		$searchChars="%{$this->getSearch()}%";
		$contacts->execute();
		
		$contacts->store_result();
		$contacts->bind_result($contactID, $request, $approved, $name, $lastName, $photo, $emotion);
		while($contacts->fetch())
		{
			$this->setContactID($contactID);
			$this->setRequest($request);
			$this->setApproved($approved);
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setPhoto($photo);
			$this->setEmotion($emotion);
			?>
				<!-- this part display photo, name and last name and emotion of contacts. -->
				<div class="info" style="height:60px">
                    <div style='margin-top:5px; margin-right:5px; display:inline; float:left'>
                       <?php echo "<img src=.." ,$this->getPhoto()," height='45' width='45' />" ?>
                    </div>                 
                    <div class="name" style="display:table; padding-top:5px; padding-bottom:10px">
                       <?php echo $this->getName() . "  " . $this->getLastName(); ?>
                    </div>
                    <div class="emotion" style="display:table">
					   <?php echo $this->getEmotion(); ?>
                    </div>
                    <input type="hidden" class="contId" value="<?php echo $this->getContactID(); ?>" />
                    <input type="hidden" class="request" value="<?php echo $this->getRequest(); ?>" />
                    <input type="hidden" class="approved" value="<?php echo $this->getApproved(); ?>" />
                </div>
            <?php
            
		}
		$contacts->free_result();   
	}
	
	public function searchRecentContact(){
		include "connection.php";
		
		$recentContact = $connection->prepare("select distinct messages.receiverUserName, 
		users.name, users.lastName, users.photo, users.emotion from messages, users
		where messages.senderUserName = ? and users.userName = messages.receiverUserName
		and (users.name LIKE ? or users.lastName LIKE ?) order by date desc");
		
		$recentContact->bind_param("sss", $userName, $searchChars, $searchChars);
		
		$userName = $this->getUserName();
		$searchChars = "%{$this->getSearch()}%";
		$recentContact->execute();
		$recentContact->store_result();
		$recentContact->bind_result($receiverUserName, $name, $lastName, $photo, $emotion);
		while($recentContact->fetch())
		{
			$this->setReceiverUserName($receiverUserName);
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setPhoto($photo);
			$this->setEmotion($emotion);
			?>
            <!-- this part display photo, name and last name and emotion of contacts. -->
            <div class="info" style="height:60px">
                <div style='margin-top:5px; margin-right:5px; display:inline; float:left'>
                   <?php echo "<img src=.." . $this->getPhoto() . " height='45' width='45' />" ?>
                </div>                 
                <div class="name" style="display:table; padding-top:5px; padding-bottom:10px">
                   <?php echo $this->getName() . "  " . $this->getLastName(); ?>
                </div>
                <div class="emotion" style="display:table">
                   <?php echo $this->getEmotion(); ?>
                </div>
                <input type="hidden" class="contId" value="<?php echo $this->getReceiverUserName(); ?>" />
            </div>
            <?php
		}
		$recentContact->free_result();
	}
	
	// this function search a new contact in users table
	public function searchNewContact()
	{
		include "connection.php";

		$newContact = $connection->prepare("select name, lastName, userName, photo, emotion
		from users where (userName != ?) and (name LIKE ? or lastName LIKE ?)");
		$newContact->bind_param("sss", $userName, $searchChars, $searchChars);
		
		$userName= $this->getUserName();
		$searchChars="%{$this->getSearch()}%";
		$newContact->execute();
		
		$newContact->store_result();
		$newContact->bind_result($name, $lastName, $userName, $photo, $emotion);
		while($newContact->fetch())
		{
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setUserName($userName);
			$this->setPhoto($photo);
			$this->setEmotion($emotion);
			?>
				<!-- this part display photo, name and last name and emotion of contacts. -->
				<div class="info" style="height:60px">
                    <div style='margin-top:5px; margin-right:5px; display:inline; float:left'>
                       <?php echo "<img src=.." ,$this->getPhoto()," height='45' width='45' />" ?>
                    </div>                 
                    <div class="name" style="display:table; padding-top:5px; padding-bottom:10px">
                       <?php echo $this->getName() . "  " . $this->getLastName(); ?>
                    </div>
                    <div class="emotion" style="display:table">
					   <?php echo $this->getEmotion(); ?>
                    </div>
                    <input type="hidden" class="contId" value="<?php echo $this->getUserName(); ?>" />
                </div>
            <?php
            
		}
		$newContact->free_result();   
	}
	
	// this function check the request to ensure the persone we send the requst to isn't in our contact list.
	// to prevent adding one person twice in our contact list
	public function checkRequset()
	{
		include "connection.php";
		
		$checkRequest = $connection->prepare("select userName, contactID from contacts where userName =? and contactID =?");
		$checkRequest->bind_param("ss", $userName, $request);
		
		$userName = $this->getUserName();
		$request = $this->getRequest();
		
		$checkRequest->execute();
		$checkRequest->store_result();
		$checkRequest->bind_result($userName, $contactID);
		
		while($checkRequest->fetch())
		{
			$this->setUserName($userName);
			$this->setContactID($contactID);
			// by doing echo system pass a value to "data" variable in jquery for evaluation
			// if we don't use echo the result of function wouldn't go back to ajax call.
			echo $this->getUserName();
			echo $this->getContactID();	
		}
		$checkRequest->free_result(); 
	}
	
	// this function save the request in contact table in pending and then it whould display
	// to user by jquery and user can accept or deny the request later
	public function pendingRequest()
	{
		include "connection.php";
			
		$pendingRequest = $connection->prepare("INSERT INTO contacts (userName, contactID, request, displayed)
		VALUES (?, ?, 1, 1)");
		$pendingRequest->bind_param("ss", $userName, $request);		
		$userName = $this->getUserName();
		$request = $this->getRequest();	
		$pendingRequest->execute();
		
		$pendingRequest = $connection->prepare("INSERT INTO contacts (userName, contactID) VALUES (?, ?)");
		$pendingRequest->bind_param("ss", $request, $userName);		
		$userName = $this->getUserName();
		$request = $this->getRequest();
		$pendingRequest->execute();
	}
	
	/* this function would be called by clicking on contacts and report the latest status of contact
	** this function query two value from database and return sum of them which could use to indicate 
	** status of contact like 2 means approved contact 1 means friend request is in pending 0 means
	** new friend request and null means contact remove us from his/her list 
	*/
	public function checkContactStatus(){
		include "connection.php";	
		$checkRequest = $connection->prepare("select approved, request from contacts where userName = ? and contactID = ?");
		$checkRequest->bind_param("ss", $userName, $contactID);
		$userName = $this->getUserName();
		$contactID = $this->getContactID();
		
		$checkRequest->execute();
		$checkRequest->store_result();
		$checkRequest->bind_result($approve, $request);
		while($checkRequest->fetch())
		{
			$this->setApproved($approve);
			$this->setRequest($request);
			echo $this->getApproved() + $this->getRequest();
		}
		$checkRequest->free_result();
	}
	
	// if user accept friend request this function will run and update contact table to approve the request.
	public function acceptRequest()
	{
		include "connection.php";
		
		$approveRequest = $connection->prepare("update contacts set approved = 1, request = 1 where approved = 0 and
		(userName = ? and contactID = ?)");
		$approveRequest->bind_param("ss", $userName, $request);
		$userName = $this->getUserName();
		$request = $this->getRequest();
		$approveRequest->execute();
		
		$approveRequest = $connection->prepare("update contacts set approved = 1 where approved = 0 and
		(userName = ? and contactID = ?)");
		$approveRequest->bind_param("ss", $request, $userName);
		$userName = $this->getUserName();
		$request = $this->getRequest();
		$approveRequest->execute();
	}
	
	// if user deny the friend request this function will run and delete thoese rows in contact table which
	// was inserted for friend request.
	public function denyRequest()
	{
		include "connection.php";
		
		$denyRequest = $connection->prepare("delete from contacts where approved = 0 and request = 0
		and (userName = ? and contactID = ?)");
		$denyRequest->bind_param("ss", $userName, $request);
		$userName = $this->getUserName();
		$request = $this->getRequest();
		$denyRequest->execute();
		
		$denyRequest = $connection->prepare("delete from contacts where approved = 0 and (userName = ? and contactID = ?)");
		$denyRequest->bind_param("ss", $request, $userName);
		$userName = $this->getUserName();
		$request = $this->getRequest();
		$denyRequest->execute();
	}
}

// this class is responsible of user profile, like displaying and updateing.
class profile extends base{
	
	public function myProfile()
	{
		include "connection.php";
		
		$myProfile = $connection->prepare("select name, lastName, userName, phoneNumber, email, dateOfBirth,
		gender, country, province, city, emotion, photo FROM users where userName = ?");
		$myProfile->bind_param("s", $userName);
		$userName = $this->getUserName();
		$myProfile->execute();
		
		$myProfile->store_result();
		$myProfile->bind_result($name, $lastName, $userName, $phoneNumber, $email, $dateOfBirth, $gender,
		$country, $province, $city, $emotion, $photo);
		while($myProfile->fetch())
		{
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setUserName($userName);
			$this->setPhoneNumber($phoneNumber);
			$this->setEmail($email);
			$this->setDateOfBirth($dateOfBirth);
			$this->setGender($gender);
			$this->setCountry($country);
			$this->setProvince($province);
			$this->setCity($city);
			$this->setEmotion($emotion);
			$this->setPhoto($photo);
		
		?>
        <div class="myProfile"><?php echo "<img id='profilePhoto' src=.." .  $this->getPhoto() ." height='150' width='150' />"; ?></div>
        <div id="accountHolder">
        	<h1> <?php echo $this->getName() . " " . $this->getLastName(); ?> </h1>
        	<h4>Accounts : <?php echo $this->getUserName(); ?> </h4>
        </div>
        <a href="" onClick="document.getElementById('photo').click(); return false" id="updatePhoto">Change Picture</a>
        <a href="#msgDisplay" id="chngPass" style="margin-left:38%">Change Password</a>
        <form action="../PHP/updateMyProfile.php" method="post" enctype="multipart/form-data" >
            <p>
            <label>Name: </label> &nbsp;&nbsp;*
            <input type="text" id="name" name="name" size="30" value="<?php echo $this->getName(); ?>" />
            </p>
    
            <p>    
            <label>Last Name: </label> &nbsp;*
            <input type="text" id="lastName" name="lastName" size="30" value="<?php echo $this->getLastName(); ?>" />  
            </p>
            
            <p>
            <label>Phone Number:</label>&nbsp;
            <input type="tel" id="phoneNumber" name="phoneNumber" size="30" value="<?php echo $this->getPhoneNumber(); ?>"/>
            </p>
            
            <p>
            <label>Email:</label> &nbsp;*
            <input type="email" id="email" name="email" size="30" value="<?php echo $this->getEmail(); ?>" />
            </p>
                        
            <p>
            <label>Country/Region:</label> &nbsp;
            <input type="text" id="country" name="country" size="30" value="<?php echo $this->getCountry(); ?>"/>
            </p>
                        
            <p>
            <label>State/Province:</label> &nbsp;
            <input type="text" id="province" name="province" size="30" value="<?php echo $this->getProvince(); ?>" />
            </p>
                    
            <p>
            <label>City:</label> &nbsp;
            <input type="text" id="city" name="city" size="30" value="<?php echo $this->getCity(); ?>"/>
            </p>
        
            <p>
            <label>Date of Birth:</label> &nbsp;
            <input type="date" id="dateOfBirth" name="dateOfBirth" size="50" style="width:238px"
            value="<?php echo $this->getDateOfBirth(); ?>"/>
            </p>
            
            <p>
            <label>Gender:</label> &nbsp;*
            <select id="gender" name="gender" style="width:242px">
            	<?php 
					if($this->getGender() == Male)
					{
				?>		
						<option value="<?php echo $this->getGender(); ?>"><?php echo $this->getGender(); ?></option>
                        <option value="Female">Female</option>
                <?php
					}
					else
					{
				?>
						<option value="<?php echo $this->getGender(); ?>"><?php echo $this->getGender(); ?></option>
						<option value="Male">Male</option>
                <?php
					}
						
				?>
            </select>
            </p>
            
            <p>
            <label>Emotion:</label> &nbsp;
            <textarea id="emotion" name="emotion" rows="3" cols="31"><?php echo $this->getEmotion(); ?></textarea>
            </p>
            <input type="file" id="photo" name="photo" accept="image/*" hidden="true" >
            <button  id="update" type="submit"> Update </button>
            <button  id="cancel" type="button"> Cancel</button> 
        </form>
       
       <!-- This section is belongs to changeing password dialog-->
        <div id="changePassowrd" style="display:none" >
            <p>
                <label>Old Password</label> &nbsp;
                <input type="password" id="oldPassword" name="oldPassword" >
            </p>
            <p>
                <label>New Password</label> &nbsp;
                <input type="password" id="newPassword" name="newPassowrd" >
            </p>
            <p>
                <label>Confirm New Passowrd</label> &nbsp;
                <input type="password" id="confNewPassword" name="confNewPassword" >
            </p>
        </div>
        <div id="resultMsg" style="display:none">
        	<p>Your Password updated successfully!</p>
        </div>
        <?php
		}
		$myProfile->free_result();
	}
	
	public function updateMyProfile()
	{
		include "connection.php";
		$photo=$this->getPhoto();
		
		if($photo != ""){
			$updateMyProfile = $connection->prepare("update users set name = ?, lastName = ?, phoneNumber = ?,
			email = ?, dateOfBirth = ?, gender = ?, country = ?, province = ?, city = ?, emotion = ?, photo = ?
			where userName = ?");
			$updateMyProfile->bind_param("ssisssssssss", $name, $lastName, $phoneNumber, $email, $dateOfBirth, $gender
			, $country, $province, $city, $emotion, $photo, $userName);
		}
		else
		{
			$updateMyProfile = $connection->prepare("update users set name = ?, lastName = ?, phoneNumber = ?,
			email = ?, dateOfBirth = ?, gender = ?, country = ?, province = ?, city = ?, emotion = ?
			where userName = ?");
			$updateMyProfile->bind_param("ssissssssss", $name, $lastName, $phoneNumber, $email, $dateOfBirth, $gender
			, $country, $province, $city, $emotion, $userName);
		}
		$name=$this->getName();
	  	$lastName=$this->getLastName();
	  	$phoneNumber=$this->getPhoneNumber();
	  	$email=$this->getEmail();
	  	$dateOfBirth=$this->getDateOfBirth();
	  	$gender=$this->getGender();
	  	$country=$this->getCountry();
	  	$province=$this->getProvince();
	  	$city=$this->getCity();
	  	$emotion=$this->getEmotion();
	  	$photo;
	  	$userName=$this->getUserName();
		
		$updateMyProfile->execute();
		$updateMyProfile->free_result();
	}
	
	// This function check the provided passwrod from user with stored password in data base
	// and if they were same user is allowed to update his/her password.
	public function checkOldPassword()
	{
		include "connection.php";
		
		$check = $connection->prepare("select password from users where userName = ?");
		
		$check->bind_param("s", $userName);
		$userName = $this->getUserName();
		$oldPassword = $this->getPassword();
		
		$check->execute();
		$check->store_result();
		$check->bind_result($password);
		while($check->fetch())
		{
			$this->setPassword($password);
		}
		if(password_verify($oldPassword, $this->getPassword()))
			echo 1;
			
		$check->free_result();
	}
	
	// This function will update the password if the checkOldPassword function become true.
	public function updatePassword()
	{
		include "connection.php";
		
		$updatePassword = $connection->prepare("update users set password = ? where userName = ?");
		$updatePassword->bind_param("ss", $password, $userName);
		
		$password = $this->getPassword();
		$userName = $this->getUserName();
		
		$updatePassword->execute();
		$updatePassword->free_result();
	}
}
?>