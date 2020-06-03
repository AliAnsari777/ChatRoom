$(document).ready(function(e) {
	
	//we use textBoxes array to store 2 text boxes and pars this array as a parametr to mustFill function to check them and make sure they are filled
	var textBoxes = ["#userName","#password"];
	
	mustFill(textBoxes);
	
	//this function check that all the text boxes are filled	
	function mustFill(textBox){
		for(var i=0; i<textBox.length; i++)
		{
			$(textBox[i]).on("blur", function(){
				if(this.value == ""){
					$(this).css({"border" : "2px inset #07c", "box-shadow" : "0 0 20px red"});		
				}
				else if(this.value != ""){
					$(this).css({"border" : "2px inset", "box-shadow" : "0 0 10px #33FF00"});
				}
			});	
		}
	}
	
	// this section check that the username and password are filled and if they were empty
	// it will display a message and prevent from submition.
	$("#logIn").on("click", function(){
		if($("#userName").val() == "" || $("#password").val() == "")
		{						
			alert("Please enter your user name and password!");
			$("form").submit(function(e){
				e.preventDefault();	
			});
		}
		else
		{	
			// by using unbind we can undo events we assign to the elements
			// if we don't write anything in event part it will delete all the event we assigned to that element
			$("form").unbind("submit");
		}
	});
		
	//this part will change the background image
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

});