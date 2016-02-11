window.onload = function () {
	document.getElementById("pass").onchange = validatePassword;
	document.getElementById("repass").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("repass").value;
var pass1=document.getElementById("pass").value;
if(pass1!=pass2)
	document.getElementById("repass").setCustomValidity("Passwords Don't Match");
else
	document.getElementById("repass").setCustomValidity('');	 
//empty string means no validation error
}