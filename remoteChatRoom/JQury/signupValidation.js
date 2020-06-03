$(document).ready(function() {
	// we use textBoxes array to store all text boxes and pars this array
	// as a parametr to mustFill function to check them    and make sure they are filled
	var textBoxes = ["#name","#lastName","#userName","#password","#phoneNumber","#email","#country"
	,"#province","#city","#dateOfBirth","#gender","#photo","#emotion"];
	
	//these two variables are use for cheking the password and confirm password to be same.
	var pass = document.getElementById("password");
	var confPass = document.getElementById("confPassword");	
	
	
	// this section of code will check the user name (instantly) to be unique and if the user name
	// doesn't available it would show a message and force user to try another user name
	$("#userName").on("blur", function(){
		
		var userName = $("#userName").val();
				
		var res=$.ajax
		({
			type:"POST",
			url:"PHP/checkingUserName.php",
			data:{userName:userName}
		});
	
		res.done(function(data)
		{
			if (data == 1)
			{
				alert("This user name is not available" );
				$('#userName').val('');
				$('#userName').css({"border" : "2px inset #07c", "box-shadow" : "0 0 20px red"});
				$('#userName').focus();
			}
		});
		
		res.fail(function(jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText);
			alert(textStatus);
			alert(errorThrown);
		});		
	});
	
	// this section check that the password and confirm password text boexes
	// are the same and if they wouldn't, it will disable the submit button
	$("#confPassword").on("keyup",function()
	{
		if(pass.value != confPass.value)
		{
			$(this).css({"border" : "2px inset #07c", "box-shadow" : "0 0 20px red"});
			document.getElementById("signUp").disabled = true;	
		}
		else if (pass.value == confPass.value)
		{
			$(this).css({"border" : "2px inset", "box-shadow" : "0 0 10px #33FF00"});
			document.getElementById("signUp").disabled = false;
		}
	});
	
	//this section validate the email address filed
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
	
	//This section is responsible for checking of file extension to be valid.Be one of these extensions jpg,jpeg,png or gif. and if it isn't it will show a message and tell the user to select the valid file format and focus on the photo fild againg and make its border red.
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
		}
		
	});
	
	// this section prevent user to write more than 100 character in the emotion box
	$("#emotion").on("keyup", function(){
		if($(this).val().length > 99)
		{
			$(this).val($(this).val().substr(0,99));
			alert("You can't type more than 100 character!");	
		}	
	})
	
	// this function check text boxes; if they are filled the border of them
	// will be green and if they are empty their border will be red.
	function mustFill (textBox)
	{
		// filter variable is used to check entred data is alphanumaric to provide accurate data
		var filter = /^([a-zA-Z0-9_\.\-\@\ ])+$/;
		document.getElementById("signUp").disabled = true;
		
		for(var i=0; i<textBox.length; i++)
		{		
			$(textBox[i]).on("blur", function()
			{
				if(filter.test(this.value))
				{
					$(this).css({"border" : "2px inset", "box-shadow" : "0 0 10px #33FF00"});
				}
				else
				{
					$(this).css({"border" : "2px inset #07c", "box-shadow" : "0 0 20px red"});
				}
			});
		}
	}
		
		
	//In here we call the mustFill function.
	mustFill(textBoxes);
		
	/*$("#page2").hide();		
	$("#next2").on("click",function(){
		$("#page1").hide("drop",1000,function(){
			$("#page2").show("drop",1000);
			//setTimeout(function(){$("#page1").removeAttr("style").hide().fadeIn()},1000);
		});	
	});*/
	
	// this section belongs to the buttons. Each button has a number at its end and that number
	// indicate the part which the button take us. for example "next2" bring us to the second part of registration form
	$("#next2").on("click",function(){
		// this if condition check the required fields are filled completely.
		// and if user leave one of them empty program will display a message and aware him/her.
		if($("#name").val() == "" || $("#lastName").val() == "" || $("#userName").val() == "" ||
		$("#password").val() == "" || $("#confPassword").val() == "")
		{
			alert("Please fill the required (*) fields");	
		}
		else
		{
			$("#page1").animate({marginLeft:"20%",opacity:0},1000,function(){
				$("#page2").css("display","inline-table");
				$("#page2").animate({marginLeft:"-18%",opacity:1},1000);
				$("#phoneNumber").focus();
			});	
		}
	});
		
	$("#next3").on("click",function(){
		if($("#email").val() == "")
		{
			alert("Please fill the required (*) field");	
		}
		else
		{
			$("#page2").animate({marginLeft:"-28%",opacity:0},1000,function(){
				$("#page3").css("display","inherit");
				$("#page2").css("display","none");
				$("#page3").animate({marginLeft:"35%",opacity:1},1000);
				$("#dateOfBirth").focus();
			});
		}
	});
		
	$("#Previous1").on("click",function(){
		$("#page2").animate({marginLeft:"9%",opacity:0},1000,function(){
			$("#page1").css("display","inline-table");
			$("#page2").css("display","none");
			$("#page1").animate({marginLeft:"30%",opacity:1},1000);
			$("#name").focus();
		});
	});
		
	$("#Previous2").on("click",function(){
		$("#page3").animate({marginLeft:"60%",opacity:0},1000,function(){
			$("#page2").css("display","inline-table");
			$("#page3").css("display","none");
			$("#page2").animate({marginLeft:"-18%",opacity:1},1000);
			$("#phoneNumber").focus();
		});
	});
	
	
	// this section control tabindex and keep tabindex in a specific page and don't let tab key to go to the hidden pages
	// the first part control forwarding tab (normal tabing)
	$("#next2").keydown(function(e) {
       	if(e.keyCode == 9){
			if(e.shiftKey){
				e.preventDefault();
				$("#confPassword").focus();	
			}
			else{
				e.preventDefault();
				$("#name").focus();
			}
		} 
    });
	// the second part control the revers tabing (tab + shift)
	$("#name").on("keydown", function(e){
		if(e.keyCode == 9){
			if(e.shiftKey){
			e.preventDefault();
			$("#next2").focus();	
			}
		}	
	});
	
	// control tabing in second page
	$("#next3").keydown(function(e) {
       	if(e.keyCode == 9){
			if(e.shiftKey){
				e.preventDefault();
				$("#Previous1").focus();	
			}
			else{
				e.preventDefault();
				$("#phoneNumber").focus();
			}
		} 
    });
	
	$("#phoneNumber").on("keydown", function(e){
		if(e.keyCode == 9){
			if(e.shiftKey){
			e.preventDefault();
			$("#next3").focus();	
			}
		}	
	});
	
	// control tabing in third page
	$("#signUp").keydown(function(e) {
       	if(e.keyCode == 9){
			if(e.shiftKey){
				e.preventDefault();
				$("#Previous2").focus();	
			}
			else{
				e.preventDefault();
				$("#dateOfBirth").focus();
			}
		} 
    });
	
	$("#dateOfBirth").on("keydown", function(e){
		if(e.keyCode == 9){
			if(e.shiftKey){
			e.preventDefault();
			$("#signUp").focus();	
			}
		}	
	});

	//this section change the background image
	$("#one").on("click",function(){
		$("body").css({"background-image" : "url(CSS/bg%20111.jpg)", "background-repeat" : "no-repeat"});
	});
	$("#two").on("click",function(){
		$("body").css({"background-image" : "url(CSS/bg%202.jpg)", "background-repeat" : "no-repeat"});
	});
	$("#three").on("click",function(){
		$("body").css({"background-image" : "url(CSS/bg%209.jpg)", "background-repeat":"repeat"});
	});
	$("#four").on("click",function(){
		$("body").css({"background-image" : "url(CSS/bg%206.jpg)", "background-repeat" : "no-repeat"});
	});

});