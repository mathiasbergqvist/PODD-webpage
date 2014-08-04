<?php
	session_start();
	//AJAX calls this login code to execute, post parameters is set
	if(isset($_POST['email']) && isset($_POST['password'])){

		//Get post parameters
		$email = $_POST['email'];
		$password = $_POST['password'];

		//Make login request to the PODD api
		$url = "https://podd.itn.liu.se/poddAPI/v1/index.php/login";
		$data = array('email' => $email, 'password' => $password);
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data),
		    ),
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		//Get the json response
		$json = json_decode($result);

		$error = $json->{'error'};

		//Check if login was successful or not.
		if($error==true){
			//If login was unsuccessful, diaply the error message
			echo 'login_failed';
		}
		else{
			//If successful login, get user credentials
			$id = $json->{'id'};
			$email = $json->{'email'};
			$api_key = $json->{'api_key'};
			$name = $json->{'name'};

			//Create session and cookies
			$_SESSION['user_id'] = $id;
			$_SESSION['api_key'] = $api_key;
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $name;
			setcookie("user_id", $id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("api_key", $api_key, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("email", $email, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("name", $name, strtotime( '+30 days' ), "/", "", "", TRUE);

			//Return the email address
			echo $name;
		}
	}
	else{
		echo 'login_failed';
	}

?>