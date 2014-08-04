<?php
	session_start();

	//Session variable holders
	$user_ok = false;
	$user_id =  "";
    $api_key =  "";
    $email =  "";
	
	//Check if session variables or login variables are set
	if(isset($_SESSION['user_id']) && isset($_SESSION['api_key']) && isset($_SESSION['email'])){
		//Set and sanatize the sesson data
		$user_id = preg_replace('#[^0-9]#', '', $_SESSION['user_id']);
		$api_key = preg_replace('#[^a-z0-9]#i', '', $_SESSION['api_key']);
		$email = preg_replace('', '', $_SESSION['email']);
		$user_ok = true;
	}
	else if(isset($_COOKIE['user_id']) && isset($_COOKIE['api_key']) && isset($_COOKIE['email'])){
		//Set session variables to the cookie values if the session has expired
		$_SESSION['user_id'] = preg_replace('#[^0-9]#', '', $_COOKIE['user_id']);
	    $_SESSION['api_key'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['api_key']);
	    $_SESSION['email'] = preg_replace('', '', $_COOKIE['email']);
		$user_id = $_SESSION['user_id'];
		$api_key = $_SESSION['api_key'];
		$email = $_SESSION['email'];
		$user_ok = true;
	}
?>