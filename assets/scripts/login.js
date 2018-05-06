function validate(e){
var user = document.getElementById("username");
var pw = document.getElementById("password");    
var username = document.getElementById("username").value;
var password = document.getElementById("password").value;
    
if(username == ""){

   
    alert("Please enter your username");
     user.classList.add("error");
    e.preventDefault();
   
}
else if(password == ""){
    alert("Please enter your password");
     pw.classList.add("error");
        e.preventDefault();
}
    else{
        alert("Logging In");
    }
    

}
