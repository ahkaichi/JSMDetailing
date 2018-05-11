function validate(e){
	
		//gets variables for password and confirm password fields
		var password = document.getElementsByName('password');
		var confirm = document.getElementsByName('confirm');
		//gets all fields with required tag
		var inputs = document.getElementsByClassName('required')
		var submit = true;
	
	//this for loop goes through all the fields to make sure they are not empty
	for(var i = 0; i <inputs.length;i++)
	{
		
		if(inputs[i].value.length== 0 || inputs[i].value == null )
		{//if it is empty we should highlight the field
			inputs[i].classList.add("jerror");
			submit = false;
		}
		
	}
	//if password doesn't match confirmation we should aler them 
	if(password[0].value !== confirm[0].value){
		alert("Passwords do not match please try again");
		submit = false
	}


	//if one of the fields is empty we should cancel the submit and alert the user.
	if(!submit){
		alert("Please Fill All Required Fields");
		e.preventDefault();
		
	}
  }


// Remove the error class from a single form element
function removeErrorHint(element) {
	element.classList.remove("jerror")
  }
	
	
	

	
	
	