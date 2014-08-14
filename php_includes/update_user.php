<?php
	session_start();

	//Set variables
	$name = $_POST['name'];
	$genderID = $_POST['genderID'];
	$birthyear = $_POST['birthyear'];
	$regioncode = $_POST['regioncode'];
	$adultnum = $_POST['adultnum'];
	$childnum = $_POST['childnum'];
	$smallchildren = $_POST['smallchildren'];
	$accomodation = $_POST['accomodation'];
	$roomnum = $_POST['roomnum'];
	$vehicleavailable = $_POST['vehicleavailable'];
	$education = $_POST['education'];
	$occupation = $_POST['occupation'];
	$workinghours = $_POST['workinghours'];
	$health = $_POST['health'];
	$stress = $_POST['stress'];


	//Check for empty values 
	if($name==""||$name==" "||$genderID==""||$genderID==" "||$birthyear==""||$birthyear==" "||$regioncode==""||$regioncode==" "||$adultnum==""||$adultnum==" "||$childnum==""||$childnum==" "||$smallchildren==""||$smallchildren==" "||$accomodation==""||$accomodation==" "||$roomnum==""||$roomnum==" "||$vehicleavailable==""||$vehicleavailable==" "||$education==""||$education==" "||$occupation==""||$occupation==" "||$workinghours==""||$workinghours==" "||$health==""||$health==" "||$stress==""||$stress==" "){
		echo 'Du har glömt att fylla i ett eller flera av fälten i formuläret. Välnigen fyll i alla fält.';
	}
	else{

		//Get user id and api key
		$id = $_SESSION['user_id'];
		$api_key = $_SESSION['api_key'];

		//Make login request to the PODD api
		$url = "https://podd.itn.liu.se/poddAPI/v1/index.php/users/$id";
		$data = array('name' => $name, 'genderID' => $genderID, 'birthyear' => $birthyear, 'regioncode' => $regioncode, 'adultnum' => $adultnum, 'childnum' => $childnum, 'smallchildren' => $smallchildren, 'accomodation' => $accomodation, 'roomnum' => $roomnum, 'vehicleavailable' => $vehicleavailable, 'education' => $education, 'occupation' => $occupation, 'workinghours' => $workinghours, 'health' => $health, 'stress' => $stress);
		$options = array(
		    'http' => array(                  
		    	'header'  => "Content-type: application/x-www-form-urlencoded\r\n".
		    				 "Authorization: $api_key",
		        'method'  => "PUT",
		        'content' => http_build_query($data),
		    ),
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url ,false, $context);

		//Get the json response
		$json = json_decode($result);

		$error = $json->{'error'};

		//Check if login was successful or not.
		if($error==true){
			//If login was unsuccessful, diaply the error message
			$message = $json->{'message'};
			echo $message;
		}
		else{
			//Display key for successful registration.
			echo 'update_successful';
		}
	}	
?>