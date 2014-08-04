<?php
	//Check if the profile user variable is set in the url 
	if(isset($_GET['user'])){

		$user = $_GET['user'];
		
		//The user should not be able to visit a profile page if he is not logged in
		if(loggedin()){

			//Check to see if the person visiting this page is the same as the logged in user
			if($_SESSION['name'] == $user){

				//This is the profile page for the logged in user. Now, get all the data from the user from the web server
				$id = $_SESSION['user_id'];
				$api_key = $_SESSION['api_key'];

				//Make login request to the PODD api
				$url = "https://podd.itn.liu.se/poddAPI/v1/index.php/users/$id";
				$options = array(
				    'http' => array(
				        'header'  => "Authorization: $api_key",
				        'method'  => 'GET',
				    ),
				);

				//Make http request and recieve content
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);

				//Get the json response
				$json = json_decode($result);

				$error = $json->{'error'};
				
				if($error==true){
					//TODO - pop-up-error-message
					echo 'Error found';
				}
				else{

					$email = $json->{'email'};
					$name = $json->{'name'};
					$genderID = $json->{'genderID'};
					$birthyear = $json->{'birthyear'};
					$regioncode = $json->{'regioncode'};
					$adultnum = $json->{'adultnum'};
					$childnum = $json->{'childnum'};
					$smallchildren = $json->{'smallchildren'};
					$accomodation = $json->{'accomodation'};
					$roomnum = $json->{'roomnum'};
					$vehicleavailable = $json->{'vehicleavailable'};
					$education = $json->{'education'};
					$occupation = $json->{'occupation'};
					$workinghours = $json->{'workinghours'};
					$health = $json->{'health'};
					$stress = $json->{'stress'};

					echo "<h3>$name</h3>";
					echo "<strong>Email:</strong> $email <br>";
					echo "<strong>genderID:</strong> $genderID <br>";
					echo "<strong>birthyear:</strong> $birthyear <br>";
					echo "<strong>regioncode:</strong> $regioncode <br>";
					echo "<strong>adultnum:</strong> $adultnum <br>";
					echo "<strong>childnum:</strong> $childnum <br>";
					echo "<strong>smallchildren:</strong> $smallchildren <br>";
					echo "<strong>accomodation:</strong> $accomodation <br>";
					echo "<strong>roomnum:</strong> $roomnum <br>";
					echo "<strong>vehicleavailable:</strong> $vehicleavailable <br>";
					echo "<strong>education:</strong> $education <br>";
					echo "<strong>occupation:</strong> $occupation <br>";
					echo "<strong>workinghours:</strong> $workinghours <br>";
					echo "<strong>health:</strong> $health <br>";
					echo "<strong>stress:</strong> $stress <br><br>";

					echo "<button id='btn-user-edit' type='button' class='btn btn-primary'>Redigera</button>";
				}
			}
			else{
				echo "<h2>Du saknar behörighet för att kunna se denna profilsida.</h2>";
			}
		}
		else{
			header("location: index.php?site=login");
		}
	}
	else{
		header("location: index.php?site=login");
		exit();
	}
?>