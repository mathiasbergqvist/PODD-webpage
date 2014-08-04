<?php
	session_start();

	//Set session data to an empty array
	$_SESSION = array();
	
	//Expire the cookie files by setting it to five days ago
	if(isset($_COOKIE["user_id"]) && isset($_COOKIE["api_key"]) && isset($_COOKIE["email"])) {
		setcookie("user_id", '', strtotime( '-5 days' ), '/');
	    setcookie("api_key", '', strtotime( '-5 days' ), '/');
		setcookie("email", '', strtotime( '-5 days' ), '/');
	}

	//Destroy the session
	session_destroy();

	header("location: index.php?site=home");
?>