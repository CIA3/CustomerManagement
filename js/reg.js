function chckPassword(){
	if(document.getElementById("pwd1").value != document.getElementById("pwd2").value){
		alert("Passwords does not matched!!");
		return false;
	}
	
	else{
		alert("Password maches!!");
		return true;
	}
}