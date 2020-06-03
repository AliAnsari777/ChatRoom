<?php
session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Chat Room</title>
<link href="../CSS/style.css" rel="stylesheet" type="text/css">
<link href="../jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<!--This embeded style sheet is for over writing the jquery ui style sheet which wasn't my desire -->
<style>
	.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset{
		float:none;
		margin-left:125px;
	}
	.ui-dialog .ui-dialog-buttonpane .ui-oneButton{
		margin-left:150px;
	}
	.design{
		background:rgba(12,79,131,0.6);
		color:inherit;
		border:none;
	}
</style>
</head>

<body>

    <div style="float:left; margin-left: 10px;">
        <a href="logout.php"><img title="Log out" src="../CSS/logout.ico" height="50px" width="50px" /></a>
        <br />
        <a href="logout.php">Log out</a>
    </div>
    
    <img src="../CSS/1.png" style="display:inline; height:50px; width:300px; margin-left:35%" />
    
    <div style="float:right; margin-right: 10px;">
        <a id="myProfile" href="../HTML/updateProfile.html" target="_blank" style="float:right; margin-right:10px">
        	<img title="Profile" src="../CSS/profilePic.jpg" style="border:outset #F50858 3px" height="50px" width="50px" />
        </a>
        <br />
        <a id="myProfile" href="../HTML/updateProfile.html" target="_blank" style="float:right; margin-right:10px">Profile</a>
    </div>
    
    <br/>
    <h2>Welcome to chat room &nbsp; <span style="color:#09F"> <?php echo $_SESSION['name'] ?></span></h2>
     
    <div id="contactInfo"></div>
    
    <div id="chatArea">
        <div id="showMessage"></div>
        <textarea id="typeMessage" ></textarea>
        <input id="sendMessage" type="button" value="Send" />
    </div>
    
    <div id="communication" class="design">
        <ul>
            <li id="singular"><a href="#home"><img height="23" width="25" src="../CSS/Home_alpic2014.png" /></a></li>
            <li><a href="#addNewContact"><img height="23" width="25" src="../CSS/Administrator-icon.png" /></a></li>
            <li id="gregarious"><a href="#group"><img height="23" width="25" src="../CSS/IconUser.png" /></a></li>
        </ul>
      
        <div id="home" class="design">
            <div><input type="text" id="search" name="search" placeholder=" Search contact" size="35"/></div>
            <div id="contactDetail" class="design">
                <ul>
                    <li><a href="#contacts">Contacts</a></li>
                    <li><a href="#recentContacts">Recent</a></li>
                </ul>
                
                <div id="contacts" class="design"></div>
                <div id="recentContacts" class="design"></div>
            </div>   
        </div>
        
        <div id="addNewContact" class="design">
            <input type="submit" id="sendRequest" name="sendRequest" value="Send Request" />
            <div><input type="text" id="searchNewContact" name="searchNewContact" placeholder=" Search new contact" size="35"/></div>
            <div id="newContact" ></div>
        </div>
        
        <div id="group" class="design"></div>
    </div>
    
    
    <div class="selectBackground" style="margin-top: 2%" >
            Backgrond Picture: &nbsp;
            <input type="radio" name="selectPic" id="one" checked>
            <label for="one">1</label>
            <input type="radio" name="selectPic" id="two">
            <label for="two">2</label>
            <input type="radio" name="selectPic" id="three">
            <label for="three">3</label>
            <input type="radio" name="selectPic" id="four">
            <label for="four">4</label> &nbsp; &nbsp;
            
            <a href="" onClick="document.getElementById('photo').click(); return false" id="updatePhoto">Change Background</a>
            <input type="file" id="photo" name="photo" accept="image/*" hidden="true" >
    </div>
    
    <script src="../JQury/jquery-1.11.1.js"></script>
    <script src="../JQury/chatApplication.js"></script>
    <script src="../jquery-ui/jquery-ui.min.js"></script>

</body>
</html>