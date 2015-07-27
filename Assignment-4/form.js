// JavaScript Document
function myFunction() {
    var missing = false;
	var str = "";
	var regex = /^[a-zA-Z]*$/;
	var number = /^[-+]*[0-9]+$/;
	
	if(form.ID.value == "")
	{
		missing = true;
		str += "You forgot to fill the following Field(s):\nID \n";		
	}
	if(isNaN(form.ID.value))
	{
		missing = true;
		str += "Enter Valid ID \n";		
	}
	
	if(form.firstName.value == "")
	{
		missing = true;
		str += "First Name \n";	
	}
	if(form.firstName.value.match(number))
	{
		missing = true;
		str += "Enter Valid First Name \n";	
	}
	if(form.lastName.value == "")
	{
		missing = true;
		str += "Last Name \n";
	
	}
	if(form.lastName.value.match(number))
	{
		missing = true;
		str += "Enter Valid Last Name \n";
	
	}
	
	if(missing){
		alert("Alert:\n"+ str);
		document.getElementById('error1').innerHTML='Please enter an ID';
		document.getElementById("error1").style.textDecoration = "underline" ;
		document.getElementById('error2').innerHTML='Please enter a First Name';
		document.getElementById("error2").style.textDecoration = "underline" ; 
		document.getElementById('error3').innerHTML='Please enter a Last Name'; 
		document.getElementById("error3").style.textDecoration = "underline" ;
	}

}

function display(form)
	{
		if(form.ID.value != "" && form.firstName.value != "" && form.lastName.value != "")
		{
			document.getElementById('display_ID').innerHTML="User ID: "+ form.ID.value + "<br>";
			document.getElementById('display_firstname').innerHTML=" First Name: "+form.firstName.value + "<br>";
			document.getElementById('display_lastname').innerHTML="Last Name: "+form.lastName.value + "<br>";			
			
			form.ID.value = "";
			form.firstName.value = "";
			form.lastName.value = "";
			return false;
		}
		return false;
	}
function error()
{
	if(form.ID.value == "")
	{
		document.getElementById('error1').innerHTML='Please enter an ID'; 
	}
	else{
	document.getElementById('error1').innerHTML=''; 
	}
	
	if(form.firstName.value == "")
	{
		document.getElementById('error2').innerHTML='Please enter a First Name'; 
	}
	
	else{
	document.getElementById('error2').innerHTML=''; 
	}
	
	if(form.lastName.value == "")
	{
		document.getElementById('error3').innerHTML='Please enter a Last Name'; 
	}
	
	else{
	document.getElementById('error3').innerHTML=''; 
	}	
}
