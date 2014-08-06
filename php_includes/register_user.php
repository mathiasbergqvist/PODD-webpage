<?php
	session_start();

	//Check for set parameters
	if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['genderID']) && isset($_POST['birthyear']) && isset($_POST['regioncode']) && isset($_POST['adultnum']) && isset($_POST['childnum']) && isset($_POST['smallchildren']) && isset($_POST['accomodation']) && isset($_POST['roomnum']) && isset($_POST['vehicleavailable']) && isset($_POST['education']) && isset($_POST['occupation']) && isset($_POST['workinghours']) && isset($_POST['health']) && isset($_POST['stress'])){

		//Set variables
		$email = $_POST['email'];
		$password = $_POST['password'];
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
		if($email==""||$email==" "||$password==""||$password==" "||$name==""||$name==" "||$genderID==""||$genderID==" "||$birthyear==""||$birthyear==" "||$regioncode==""||$regioncode==" "||$adultnum==""||$adultnum==" "||$childnum==""||$childnum==" "||$smallchildren==""||$smallchildren==" "||$accomodation==""||$accomodation==" "||$roomnum==""||$roomnum==" "||$vehicleavailable==""||$vehicleavailable==" "||$education==""||$education==" "||$occupation==""||$occupation==" "||$workinghours==""||$workinghours==" "||$health==""||$health==" "||$stress==""||$stress==" "){
			echo 'Du har glömt att fylla i ett eller flera av fälten i formuläret. Välnigen fyll i alla fält.';
		}
		else{
			//Make login request to the PODD api
			$url = "https://podd.itn.liu.se/poddAPI/v1/index.php/register";
			$data = array('email' => $email, 'password' => $password, 'name' => $name, 'genderID' => $genderID, 'birthyear' => $birthyear, 'regioncode' => $regioncode, 'adultnum' => $adultnum, 'childnum' => $childnum, 'smallchildren' => $smallchildren, 'accomodation' => $accomodation, 'roomnum' => $roomnum, 'vehicleavailable' => $vehicleavailable, 'education' => $education, 'occupation' => $occupation, 'workinghours' => $workinghours, 'health' => $health, 'stress' => $stress);
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
				$message = $json->{'message'};
				echo $message;
			}
			else{
				//Display key for successful registration.
				echo 'register_successful';
			}
		}	
	}
	else{
		echo 'Du har glömt att fylla i ett eller flera av fälten i formuläret. Välnigen fyll i alla fält.';
	}
?>