// JavaScript Document
$(document).ready(function() {
	// this part display user profile
	var myProfile = $.ajax({
		url:"../PHP/myProfile.php"	
	});
	myProfile.done(function(data){
		$("#displayMyProfile").html(data);
		$(document).trigger("fileCheck");

		
		$("#cancel").on("click", function(){
			window.close();
		});
	});
	
	
	$(document).bind("fileCheck",function(ev, data){
		$("#photo").change(function()
		{
			var uplodingFile = $("#photo").val().split('.').pop().toLowerCase();
			var fileExtensions = ["jpg","jpeg","png","bmp"];
			if (uplodingFile)
			{
				if($.inArray(uplodingFile,fileExtensions) == -1)
				{
					alert("Invalid Extension! Please select a photo with jpg, jpeg, bmp or png extension. ");
					$("#photo").val('');
					$("#photo").css({"border" : "2px inset #07c", "box-shadow" : "0 0 20px red"});
					$("#photo").focus();		
				}
				else
				{
					/* this part display the photo befor update and use HTML5 feature File API (FileReander)
					** FileReader interface which lets web applications asynchronously read the contents of files. */
					
					// create an object from FileReader interface
					var reader = new FileReader(); 
					reader.onload = function(e){
						// get loaded data and put them as source of image
						$("#profilePhoto").attr('src', e.target.result);	
					};
					// read the image file as data URL.
					reader.readAsDataURL(this.files[0])
				}
			}
			
		});
		
		$("#email").on("blur",function()
		{
			var email = $("#email").val();
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;		
			if (!filter.test(email))
			{
				alert('Please provide a valid email address');
				$("#email").focus();
				$("#email").val('');
			}
		});
	
		// this section prevent user to write more than 100 character in the emotion box
		$("#emotion").on("keyup", function(){
			if($(this).val().length > 99)
			{
				$(this).val($(this).val().substr(0,99));
				alert("You can't type more than 100 character!");	
			}	
		});
				
		$("#chngPass").on("click",function(){
			$("#changePassowrd").dialog({
				autoOpen: true,
				draggable: false,
				modal: true,
				width: 430,
				height: 300,
				title: "Change your password",
				buttons:
				{
					"Update" : function()
					{
						if($("#newPassword").val() != $("#confNewPassword").val())
						{
							alert("New Password and Confirm New Password doesn't match!");
							$("#newPassword").val('');
							$("#confNewPassword").val('');
						}
						else
						{
							var oldPass = $("#oldPassword").val();
							var result = $.ajax({
								type:"POST",
								url:"../PHP/checkOldPassword.php",
								data:{oldPassword:oldPass}
							});
							
							result.done(function(data)
							{
								if(data == 1)
								{
									var newPass = $("#newPassword").val();
									var changePass = $.ajax({
										type:"POST",
										url:"../PHP/changePassword.php",
										data:{newPassword:newPass}
									});
									
									changePass.done(function(){
										$("#changePassowrd").dialog('close');
										$("#confNewPassword").val('');
										$("#newPassword").val('');
										$("#oldPassword").val('');
										
										$("#resultMsg").dialog({
											autoOpen: true,
											draggable: false,
											modal: true,
											width: 365,
											height: 150,
											title: "Result Message"	
										});
									});
								}
								else
								{
									alert("Your old password is wrong!");	
								}	
							});
						}
					},
					"Cancel" : function()
					{
						$(this).dialog('close');	
					}
				}
			});
		
		});
	});
});