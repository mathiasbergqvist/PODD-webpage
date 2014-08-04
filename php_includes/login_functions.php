<?php
	session_start();
	ob_start();
	
	//This functions checks if the user is logged in or not.
	function loggedin(){
		if(isset($_SESSION['user_id']) && isset($_SESSION['api_key']) && isset($_SESSION['email']) && isset($_SESSION['name'])){
			//Save session data as local variables 
			$session_user_id = $_SESSION['user_id'];
			$session_api_key = $_SESSION['api_key'];
			$session_email = $_SESSION['email'];
			$session_name = $_SESSION['name'];
			return true;
		}
		else if(isset($_COOKIE["user_id"]) && isset($_COOKIE["api_key"]) && isset($_COOKIE["email"]) && isset($_COOKIE["name"])){
			//If session is expired but cookies is set, set the session values to the cookie values. This way, the user does not have to log in every time he re-opens the web browser.
			$_SESSION['user_id'] = $_COOKIE["user_id"];
			$_SESSION['api_key'] = $_COOKIE["api_key"];
			$_SESSION['email'] = $_COOKIE["email"];
			$_SESSION['name'] = $_COOKIE["name"];
			$session_user_id = $_SESSION['user_id'];
			$session_api_key = $_SESSION['api_key'];
			$session_email = $_SESSION['email'];
			$session_name= $_SESSION['name'];
			return true;
		}
		else{
			return false;
		}
	}
?>