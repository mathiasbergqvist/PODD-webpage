$(document).ready(function(){
    
    $('#myCarousel').carousel({
  		interval: 5000
	});

});

$('#btn-login').click(function(){

	//Get entered data from the login form and serialize it into post parameter data

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

$('#btn-register').click(function(){

	//Get data from the register form
	var email = $('#email_input').val();
	var password = $('#password_input').val();
	var password_repeat = $('#password_input_repeat').val();

	//Check for empty input values
	if(email==""||password==""||password_repeat==""){
		$('#status').html("Du måste fylla i både email och lösenord.");
		$('#status').css('color','red');
	}
	else if(password != password_repeat){
		$('#status').html("Lösenordet och det upprepade lösenordet stämmer ej överrens. Vänligen kontrollera detta en gång till.");
		$('#status').css('color','red');
	}
	else if(password.length < 5){
		$('#status').html("Lösenordet måste vara minst fem tecken långt");
		$('#status').css('color','red');
	}
	else{
		//Serialize the form filed into post parameter data
		var fromData = $('#form-register').serialize();

		//Make the form buttons invisible
		$(this).css('visibility','hidden');
		$('#btn-cancel-registration').css('visibility', 'hidden');

		//Set status field text and color
		$('#status').html('Registrerar...');
		$('#status').css('color','black');

		//Show the content loader
		$('#loader').css('visibility','visible');

		//Send post request using ajax
		$.post("php_includes/register_user.php",
	    fromData,
	    function(response, status){
	    	//Callback function when the data is recieved
	    	$('#loader').css('visibility','hidden');

	    	//Check for login failure response
	    	if(response != 'register_successful'){
	    		//If the regisration was unsuccessful, show error message. 
	    		var error_msg  = response;
	    		$('#status').html(error_msg);
	    		$('#status').css('color','red');
	    		$('#btn-register').css('visibility','visible');
	    		$('#btn-cancel-registration').css('visibility', 'visible');
	    	}
	    	else{
	    		//If the registration was successful, show container for successful registrations. 
	    		$('#form-register').css('visibility', 'hidden');
	    		$('#successful-registation-container').css('visibility', 'visible');
	    		//Go to top of page
	    		$('html, body').animate({ scrollTop: 0 }, 0);
	    	}
	    });

	}

});

$('#btn-save-profile-edit').click(function(){

	
	//Get data from the edit profile form
	var formData = $('#form-edit-profile').serialize();

	//Make the form buttons invisible
	$(this).css('visibility', 'hidden');
	$('#btn-cancel-edit').css('visibility', 'hidden');

	//Set status field text and color
	$('#status').html('Uppdaterar...');
	$('#status').css('color', 'black');

	//Show the content loader gif
	$('#loader').css('visibility', 'visible');
	
	$.post("php_includes/update_user.php",
		formData,
		function(response, status){
			//Callback function that executes when the data is recieved

			//Make the gif icon loader invisible
			$('#loader').css('visibility', 'hidden');

			//Check for a failure response 
			if(response != "update_successful"){
				//If the update was unsuccessful, show error message
				$('#status').html(response);
				$('#status').css('color','red');
				$('#btn-save-profile-edit').css('visibility', 'visible');
				$('#btn-cancel-edit').css('visibility','visible');
			}
			else{
				//Successful update, show message and a link to the profile page
				$('#form-edit-profile').css('visibility', 'hidden');
				$('#successful-update-container').css('visibility', 'visible');
				//Go to the top of the page
				$('html, body').animate({ scrollTop: 0 }, 0);
			}
		});

});

function setStatusDescription(description){
	$('#status').html(description);
}

$('#btn-user-edit').click(function(){
	var name = $('#name_header').text();
	window.location = "index.php?site=edit_profile&user="+name;
});

$('#password_input').keyup(function(){
	var pwd_length = $(this).val().length;
	//$('#pwd-msg').html(pwd);

	if(pwd_length < 5){
		$('#pwd-msg').html("Lösenordet måste vara minst 5 tecken långt.");
		$('#pwd-msg').css('color', 'red');
		$(this).css('border','2px solid red');
	}
	else{
		$('#pwd-msg').html("OK!");
		$('#pwd-msg').css('color', '#20D600');
		$(this).css('border','2px solid #20D600');
	}
});





