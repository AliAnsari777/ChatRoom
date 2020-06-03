$(document).ready(function(){
	$("#typeMessage").attr("disabled","");
	
	// this section defien the chat type which could be singular or gregarious
	// ID 1 meanss it would be a singular and otherwise it would be gregarious
	/*$("#singular").on("click",function(){
		var ID = 1;
		$.ajax({
			type:"POST",
			url:"defineChatType.php",
			data:{chatType:ID}
		});	
	});
	
	
	$("#gregarious").on("click",function(){
		var ID = 2;
		$.ajax({
			type:"POST",
			url:"defineChatType.php",
			data:{chatType:ID}
		});	
	});*/
	
	/* this section use the keyup function to check the pressed button in message box
	** is "enter" or not, and if it is "enter", it would call the "sendMessage" function.
	*/
	$("#typeMessage").keyup(function(e){
		if(e.keyCode == 13){
			sendMessage();
		}
	});
	
	$("#sendMessage").on("click",function(){
		sendMessage();	
	})
	
	setInterval(function(){
		var newMessage = $.ajax({
			url:"newMessage.php",
		});
		newMessage.done(function(data){
			if(data != "")
			{
				/* if user has new message this part will highlight the sender of message in contant list to aware user
				** and if more than one person send message to user they will separate by "split" method and store
				** as an array and "$.each" method of jquery highlight each contact in array */
				var separatedData = data.split(" ");
				$.each(separatedData, function(key, value){
					$('input[value=' + value + ']').parent("div").css("background-color","#CFF");
				});
			}
		});	
	},7000);

	// this part check for new friend request and if user has a new request it will append to the contact list.
	setInterval(function(){
		var displayNewContact = $.ajax({
			url:"displayNewContact.php"
		});
		displayNewContact.done(function(data){
			if(data != "")
			{
				$("#contacts").append(data);
				$.ajax({
					url:"markDisplayedContact.php"
				});
			}	
		});
	},10000);
	
	/* by using jquery ui and calling tabs() function this code
	* made a tabable part for home, add contact and make groups
	* in right side of chat application
	*/
	$("#communication").tabs();
	
	
	// this is also a tabable part inside home tap for list of 
	// contacts and recent contacts which we chat with them 
	$("#contactDetail").tabs();
	
	/* this part call to the displayContact.php file which is
	* responsible to read contacts of user from database and display it
	* in contact part inside home tap.
	*/
	$("#contacts").load("displayContact.php", function(){
		cutContactEmotion();
	});
	
	// because search in recent contact isn't develop yet by clicking on recent contact tab search box
	// will disable and this code will remove this attribute for using search in contact list.
	$("#ui-id-4").on("click", function(){
		$("#search").removeAttr("disabled");	
	});
	 
	$("#ui-id-5").on("click",function(){
		$("#recentContacts").load("recentContact.php", function(){
			cutRecentContactEmotion();
			$("#search").attr("disabled","");
		});	 
	});
	
	$("#recentContacts").selectable({
		selected:function(event, ui)
		{
			selection(event, ui);
		}
	});
	
	// this part make each contact in contact list selectable by using JQuery UI.
	$("#contacts").selectable({		
		// by selecting each contact in list, its information will come from database
		// and display in left side of screen in div with "contactInfo" id
		selected:function(event, ui)
		{
			var ContactID = $(ui.selected).find(".contId").val();
			// this ajax call request update status of contact
			var check = $.ajax({
				type:"POST",
				url:"checkContactStatus.php",
				data:{chkContact:ContactID}	
			});
			
			check.done(function(data){
				if(data == 2)
				{
					selection(event, ui);
				}
				else if(data == 1)
				{
					$("#showMessage").html("<div id='pending'><p style='text-align:left;'>Your request isn't approve yet!</p></div>");
					$("#typeMessage").attr("disabled","");
					
					$("#pending").dialog({
						autoOpen: true,
						draggable: false,
						modal: true,
						width: 400,
						title: "Friend request",
						buttons: {
							"OK" : function(){							
								$(this).dialog('close');							
							}
						}					
					})
					$(".ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset").addClass("ui-oneButton");
				}
				else if(data == "")
				{
					var ContactName = $(ui.selected).find(".name").html();
					$("#showMessage").html("<div id='removed'><p style='text-align:left;'>You removed from " + ContactName +
					"'s contact list !</p></div>");
					$("#typeMessage").attr("disabled","");
					
					$("#removed").dialog({
						autoOpen: true,
						draggable: false,
						modal: true,
						width: 400,
						title: "Notice",
						buttons: {
							"OK" : function(){							
								$(this).dialog('close');
								$("#contactInfo").empty();
								$("#contacts").load("displayContact.php", function(){
									cutContactEmotion();
								});							
							}
						}					
					})
					$(".ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset").addClass("ui-oneButton");	
				}
				else if(data == 0)
				{
					var ContactName = $(ui.selected).find(".name").html();
					var request = $.ajax({
						type:"POST",
						url:"answerToRequest.php",
						data:{contactName:ContactName}
					});
					
					request.done(function(data){
						$("#typeMessage").attr("disabled","");
						$("#showMessage").html(data);
						$("#request").dialog({
							autoOpen: true,
							draggable: false,
							modal: true,
							width: 450,
							title: "Friend request",
							buttons: {
								"Accept" : function(){
									$.ajax({
										type:"POST",
										url:"acceptRequest.php",
										data:{contactRequest:ContactID}	
									});
									$(this).dialog('close');
									$("#typeMessage").removeAttr("disabled");
								},
								
								"Deny" : function(){
									$.ajax({
										type:"POST",
										url:"denyRequest.php",
										data:{contactRequest:ContactID}	
									});
									$(this).dialog('close');
									$("#contacts").load("displayContact.php",function(){
										cutContactEmotion();	
									});
								}
							}	
						});
					});	
				}	
			});
		}
	});
	
	// this part is responsible to search in contact list instantly
	$("#search").keyup(function(){
		
		var srch = $("#search").val();
			var searchResult = $.ajax
			({
				type:"POST",
				url:"searchContact.php",		
				data:{searchData:srch}
			});
			searchResult.done(function(data){
				$("#contacts").html(data);
				cutContactEmotion();
			});
		
		searchResult.fail(function(jqXHR, textStatus, errorThrown)
		{
			alert(jqXHR.responseText);
			alert(textStatus);
			alert(errorThrown);		
		});
	});
	
	$("#sendRequest").attr("disabled","");
	
	// this part is responsible to search new contacts in database to send them friend request
	$("#searchNewContact").keyup(function(){
		
		var srch = $.trim($("#searchNewContact").val());
		/* this condition check that the search box has some value and if it hasn't any value it will make the
		* searchNewContact div empty and if this condition omit from here after deleting all characters in search box
		* it will display all the users in the database, because I use LIKE operator in mysql query and no character
		* means all posible words. */
		if(srch != "")
		{
			var searchResult = $.ajax
			({
				type:"POST",
				url:"searchNewContact.php",		
				data:{searchData:srch}
			});
			
			searchResult.done(function(data)
			{
				$("#newContact").html(data);
				cutNewContactEmotion();
			});
			
			searchResult.fail(function(jqXHR, textStatus, errorThrown)
			{
				alert(jqXHR.responseText);
				alert(textStatus);
				alert(errorThrown);		
			});
		}
		else
		{
			$("#newContact").empty();
			$("#sendRequest").attr("disabled","");
		}
	});
	
	// this part make contacts in new contact list selectable and enable us to send them request
	$("#newContact").selectable({
		selected:function(event, ui)
		{
			$("#sendRequest").removeAttr("disabled");
		}
	});
	
	
	// after clicking on send request, first request will checke to find that the selected contact is in our list or not
	$("#sendRequest").on("click", function(){
	// I used (.ui-selected) class which added by jquery ui whit (.name) class which added by me to get userName of
	// selected contact to do a query
		var selectedContact = $(".ui-selected .contId").val();
		var checkRequest = $.ajax({
			type:"POST",
			url:"checkRequest.php",
			data:{contactInfo:selectedContact}	
		});
		// when result of ajax requst come and it has some data it means that the query found some
		// record in database and requested user is already in our list and this issue will show to user
		checkRequest.done(function(data){
			if(data != "")
			{
				$("#showMessage").html("<h3 id='duplicate'>You already have this contact in your contact list!</h3>")
				$("#duplicate").dialog({
					autoOpen: true,
					draggable: false,
					modal: true,
					width: 400,
					title: "Duplicate request",
					buttons: {
						"OK" : function(){										
							$(this).dialog('close');							
						}
					}
				})
				// this line is for positioning the ok button in center of dialog box
				$(".ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset").addClass("ui-oneButton");
			}
			else
			{
			// if result of ajax call is empty it means we don't have this person in our list
			// and the request will send to database in pending mode until it is accpet by the requested user
				var pendingRequest = $.ajax({
					type:"POST",
					url:"pendingRequest.php",
					data:{contactInfo:selectedContact}
				});
				// loading contat list after sendgin request to some one to 
				// see him in contact list without refreshing page
				$("#contacts").load("displayContact.php");
				var ContactName = $(".ui-selected .name").html();
				pendingRequest.done(function(){
					$("#showMessage").html("<h3 id='successful'>You request to " + 
					ContactName + " sent successfuly!</h3>")
					$("#successful").dialog({
						autoOpen: true,
						draggable: false,
						modal: true,
						width: 400,
						title: "Successful request",
						buttons: {
							"OK" : function(){										
								$(this).dialog('close');							
							}
						}
					})
					// this line is for positioning the ok button in center of dialog box
					$(".ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset").addClass("ui-oneButton");
					
				})
			}
		});
		
		checkRequest.fail(function(jqxhr, textStatus, errorThrown)
		{
			alert(jqXHR.responseText);
			alert(textStatus);
			alert(errorThrown);	
		});
	});
	
	// this part enable user to choose an image as chatroom background
	$("#photo").change(function(){
		var uplodingFile = $("#photo").val().split('.').pop().toLowerCase();
		var fileExtensions = ["jpg","jpeg","png","bmp"];
		if (uplodingFile)
			{
				if($.inArray(uplodingFile,fileExtensions) == -1)
				{
					alert("Invalid Extension! Please select a photo with jpg, jpeg, bmp or png extension. ");
					$("#photo").val('');		
				}
				else
				{
					// create an object from FileReader interface
					var reader = new FileReader(); 
					reader.onload = function(e){
						// get loaded data and put them as source of image
						$("body").css({"background-image" : "url(" + e.target.result + ")"}) 	
					};
					// read the image file as data URL.
					reader.readAsDataURL(this.files[0])	
				}
			}
	});
					
	// this part will change the background image
	$("#one").on("click",function(){
		$("body").css({"background-image" : "url(../CSS/bg%20111.jpg)", "background-repeat" : "no-repeat"});
	});
	$("#two").on("click",function(){
		$("body").css({"background-image" : "url(../CSS/bg%202.jpg)", "background-repeat" : "no-repeat"});
	});
	$("#three").on("click",function(){
		$("body").css({"background-image" : "url(../CSS/bg%209.jpg)", "background-repeat" : "repeat"});
	});
	$("#four").on("click",function(){
		$("body").css({"background-image" : "url(../CSS/bg%206.jpg)", "background-repeat" : "no-repeat"});
	});
	
	// this function will call when user wants to send a message by pressing the return key or send button
	function sendMessage()
	{
		// this condition check the message isn't with-space or empty
		if($.trim($("#typeMessage").val())) // $.trim() is used to detect whit-space value
		{
			var message = $("#typeMessage").val();			
			var sendMsg = $.ajax({
				type:"POST",
				url:"insertMessage.php",
				data: {message1:message},
			});
			
			sendMsg.done(function(){
				$("#typeMessage").val("").focus();
				
			});

			sendMsg.fail(function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
				alert(textStatus);
				alert(errorThrown);
			});
		}
		else 
		{
			$("#typeMessage").val("");	
		}	
	}
	
	/* this function will call when an approved contact in contact list is selected and display 
	the contact profile and display the previous and new messages between user and selected contact.*/
	function selection(event, ui)
	{
		// because typeMessage will disabled after clicking on unapproved friend request it should be
		// re-enable when user click on approved contacts.
		$("#typeMessage").removeAttr("disabled");	
		$("#typeMessage").focus();
		// change the background color to its normal state if it is changed by newMessage function
		$(".info").css("background-color","");
		// save the userName of selected contact by finding its class name inside the div which is exist
		var selectedContact = $(ui.selected).find(".contId").val();
		
		var contactInfo = $.ajax({
			type:"POST",
			url:"fullContactInfo.php",
			data:{contactUserName:selectedContact}
		});
		contactInfo.done(function(data)
		{
			// If ajax call was successful the returned data will add to
			// contactInfo div as its html contents by using "html()" method
			$("#contactInfo").html(data);
			$("#showMessage").load("displayMessage.php", function(){
				// scroll down the show message screen to display the last message.
				$("#showMessage").scrollTop($("#showMessage").prop("scrollHeight"));	
			});
			
			// this part show all the messages so by following ajax call all unreaded messages will mark as read
			// and displayNewMessages function doesn't display them again.
			$.ajax({
				url:"markDisplayedMessage.php"	
			});
			
				
			$("#removeContact").on("click", function(){
				var ContactID = $(ui.selected).find(".contId").val();				
				$("#removeMessage").dialog({
					autoOpen: true,
					draggable: false,
					modal: true,
					width: 400,
					title: "Remove Contact",
					buttons:
					{
						"Yes" : function(){							
							var del = $.ajax({
								type:"POST",
								url:"removeContact.php",
								data:{ContactID:ContactID}	
							});
							$(this).dialog('close');
							$("#contactInfo").empty();
							$("#showMessage").empty();
							del.done(function(){
								$("#contacts").load("displayContact.php", function(){
									cutContactEmotion();
								});	
							});
						},
						
						"No" : function(){
							$(this).dialog('close');	
						}
					}		
				});	
			});
			
		});
		contactInfo.fail(function(jqXHR, textStatus, errorThrown)
		{
			alert(jqXHR.responseText);
			alert(textStatus);
			alert(errorThrown);		
		});
		
		setInterval(function()
		{
			var displayMsg = $.ajax({
				url:"displayNewMessage.php",
			});
			displayMsg.done(function(data){
				if(data != "")
				{
					$("#showMessage").append(data);
					$("#showMessage").scrollTop($("#showMessage").prop("scrollHeight"));
					$.ajax({
						url:"markDisplayedMessage.php"	
					});
				}
			});
		},3000)	
	}
	
	function cutContactEmotion()
	{
		 /* this function check the length of emotion because it could be too long, and if it is
		 ** more than 40 char it will display only 37 char "with three dots which mean the text has continue"
		 ** to prevent overlaping text. */
		$("#contacts .info .emotion").each(function() {
        	var content = $(this).html();
			$.trim(content);
			if(content.length > 40)
			{
				$(this).html(content.substr(0,37));
			};
    	});	
	}
	
	function cutNewContactEmotion()
	{
		$("#newContact .info .emotion").each(function() {
			var content = $(this).html();
			$.trim(content);
			if(content.length > 60)
			{
				$(this).html(content.substring(0,38));
			};
		});
	}
	
		function cutRecentContactEmotion()
	{
		$("#recentContacts .info .emotion").each(function() {
			var content = $(this).html();
			$.trim(content);
			if(content.length > 60)
			{
				$(this).html(content.substring(0,48));
			};
		});
	}
});
