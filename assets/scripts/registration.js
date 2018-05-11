function validate(){
	
		//gets variables for password and confirm
		var password = document.getElementsByName('password');
		var confirm = document.getElementsByName('confirm');
		//gets all fields with required tag
		var inputs = document.getElementsByClassName('required')
		var submit = true;
	//console.log(inputs); helps you see what it actually is and call the correct one.
	//this for loop goes through all the fields to make sure they are not empty
	for(var i = 0; i <inputs.length;i++)
	{
		
		if(inputs[i].value=="")
		{//if it is empty we should highlight the field
			inputs[i].classList.add("jerror");
			
			var submit = false;
		}

		if(inputs[i].value!="" && inputs[i].classList.contains("jerror"))
		{//if the error was fixed we should remove the highlight
			inputs[i].classList.remove("jerror");
			
		}
		
	}
	//if password doesn't match confirmation we should aler them 
	if(password[0].value !== confirm[0].value){
		alert("Passwords do not match please try again");
		
		return false;
	}
	//if one of the fields is empty we should cancel the submit and alert the user.
	if(!submit){
		alert("Please Fill All Required Fields");
		return false;
	}
	}
	
	
	

	
	
	