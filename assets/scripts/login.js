/* This Function checks the user input for null or blank inputs. 
    if either case happens, the preventdefault method is called */
function validate(e){
var user = document.getElementById("username");
var pw = document.getElementById("password");    
var username = document.getElementById("username").value;
var password = document.getElementById("password").value;
    
var flag = true
    
if(username.length == 0 || username == null){

   
    alert("Please enter your username");
     user.classList.add("error");
    flag = false;
   
}
else if(password.length == 0 || password == null){
    alert("Please enter your password");
    user.classList.remove("error");
     pw.classList.add("error");
      flag = false;
}

    
    if(!flag){
        e.preventDefault();
    }
    

}
