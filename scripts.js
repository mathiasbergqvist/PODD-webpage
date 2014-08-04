$(document).ready(function(){
    
    $('#myCarousel').carousel({
  		interval: 5000
	});

});

/*
function login(){
	
	var e = _("email").value;
	var p = _("password").value;

	if(e == "" || p == ""){
		$('#status').html("Du måste fylla i både email och lösenord.");
	} 
	else{
		$('#btn-login').css('visibility','hidden');
		$('#status').html("Loggar in...");
		var ajax = ajaxObj("POST", "login.php");
        ajax.onreadystatechange = function(){
	        if(ajaxReturn(ajax) == true){
	            if(ajax.responseText == "login_failed"){
	            	$('#status').html("Inloggning misslyckad. Vänligen försök igen.");
	            	$('#btn-login').css('display','block');
				} 
				else{
					window.location = "user.php?u="+ajax.responseText;
				}
	        }
        }
        ajax.send("email="+e+"&password="+p);
	}
}
*/
function login(){

	var xmlhttp = null;

	try
	{
		xmlhttp = new XMLHttpRequest();
	}
	catch(err1)
	{
		try 
		{
        	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     	}
      	catch(err2) 
      	{
        	try 
        	{
          		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        	}
        	catch(err3) 
        	{
         	 	xmlhttp = false;
	    	}
	  	}
	}

	if(xmlhttp)
	{
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4)
			{
				alert(xmlhttp.responseText);
			}
			else alert("No response...");
		}
		xmlhttp.open("GET", "/set_session.php", true);
		xmlhttp.send();
	}
	else{
		alert("Failed to create AJAX object!");
	}
	
	/*
	xmlhttp.open("POST","set_session.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("email=tmpuser@liu.se&password=pwd123");
	*/
}

$('#btn-login').click(function(){

	//Get entered data from the login from and serialize it into post parameter data

	//Get data from login form
	var email = $('#email_input').val();
	var password = $('#password_input').val();

	//Check for empty input values
	if(email==""||password==""){
		$('#status').html("Du måste fylla i både email och lösenord.");
		$('#status').css('color','red');
	}
	else{
		//Serialize the form filed into post parameter data
		var fromData = $('#form-login').serialize();

		//Make the login button invisible
		$(this).css('visibility','hidden');

		//Set status field text and color
		$('#status').html('Loggar in...');
		$('#status').css('color','black');

		//Show the content loader
		$('#loader').css('visibility','visible');

		//Send post request using ajax
		$.post("php_includes/set_session.php",
	    fromData,
	    function(response, status){
	    	//Callback function when the data is recieved
	    	$('#loader').css('visibility','hidden');

	    	//Check for login failure response
	    	if(response == 'login_failed'){
	    		$('#status').html('Inloggningen misslyckades. Vänligen försök igen.');
	    		$('#status').css('color','red');
	    		$('#btn-login').css('visibility','visible');
	    	}
	    	else{
	    		var user_name = response;
	    		window.location = "index.php?site=profile&user="+user_name;
	    	}
	    });
	}
});

$('#btn-logout').click(function(){
	window.location = "logout.php";
});

function setStatusDescription(description){
	$('#status').html(description);
}





