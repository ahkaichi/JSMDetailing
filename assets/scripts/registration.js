function validate(){
	
		
		var password = document.getElementsByName('password');
		var confirm = document.getElementsByName('confirm');
		var inputs = document.getElementsByClassName('required')
		var submit = true;
	//console.log(inputs); helps you see what it actually is and call the correct one.
	for(var i = 0; i <inputs.length;i++)
	{
		
		if(inputs[i].value=="")
		{
			inputs[i].classList.add("jerror");
			
			var submit = false;
		}

		if(inputs[i].value!="" && inputs[i].classList.contains("jerror"))
		{
			inputs[i].classList.remove("jerror");
			
		}
		
	}
	if(password[0].value !== confirm[0].value){
		alert("Passwords do not match please try again");
		
		return false;
	}
	if(!submit){
		alert("Please Fill All Required Fields");
		return false;
	}
	}
	function success(){
	alert("Thank You! You have successfuly completed the form! Have a nice day!.");
	}
	
	
	
