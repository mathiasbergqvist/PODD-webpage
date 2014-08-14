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

					//Get all user credentials
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

					echo "<h3 id='name_header'>$name</h3>";
					echo "<strong id='email'>Email</strong><div id='email_value'>$email</div><br>";
					echo "<strong id='genderID'></strong><div id='genderID_value'>$genderID</div><br>";
					echo "<strong id='birthyear'></strong><div id='birthyear_value'>$birthyear</div><br>";
					echo "<strong id='regioncode'></strong><div id='regioncode_value'>$regioncode</div><br>";
					echo "<strong id='adultnum'></strong><div id='adultnum_value'>$adultnum</div><br>";
					echo "<strong id='childnum'></strong><div id='childnum_value'>$childnum</div><br>";
					echo "<strong id='smallchildren'></strong><div id='smallchildren_value'>$smallchildren</div><br>";
					echo "<strong id='accomodation'></strong><div id='accomodation_value'>$accomodation</div><br>";
					echo "<strong id='roomnum'></strong><div id='roomnum_value'>$roomnum</div><br>";
					echo "<strong id='vehicleavailable'></strong><div id='vehicleavailable_value'>$vehicleavailable</div><br>";
					echo "<strong id='education'></strong><div id='education_value'>$education</div><br>";
					echo "<strong id='occupation'></strong><div id='occupation_value'>$occupation</div><br>";
					echo "<strong id='workinghours'></strong><div id='workinghours_value'>$workinghours</div><br>";
					echo "<strong id='health'></strong><div id='health_value'>$health</div><br>";
					echo "<strong id='stress'></strong><div id='stress_value'>$stress</div><br>";

					?>

					<script>

						//The script builds the user page structure from the xml file structure
					    var xmlDoc = loadXMLDoc("userTable.xml");

					    //XML tag list
					    var variables = xmlDoc.getElementsByTagName("variable");
					    var variables_desc_SWE = xmlDoc.getElementsByTagName("var_desc_SWE");
					    var variables_name = xmlDoc.getElementsByTagName("var_name");
					    var variables_options = xmlDoc.getElementsByTagName("var_options");
					    var variables_ui_type = xmlDoc.getElementsByTagName("var_ui_type");

					    for(var i=0; i<variables.length; i++){

					    	//Get the variable description
					      	var var_desc = variables_desc_SWE[i].childNodes[0].nodeValue;

					      	//Get the variable name
					      	var var_name = "#" + variables_name[i].childNodes[0].nodeValue;

					      	//Write variable description in the corresponding div
					      	$(var_name).html(var_desc);

					      	//Get Iu type
      						var var_ui_type = variables_ui_type[i].childNodes[0].nodeValue;

      						if(var_ui_type == "dropdown" || var_ui_type == "radiobutton"){
      							
      							  //Get options
						          var options = variables_options[i].getElementsByTagName("option");
						          for(var j=0; j<options.length; j++){
						              
						              //Get code and description
						              var option_code = options[j].getElementsByTagName("option_code")[0].childNodes[0].nodeValue;
						              var option_desc = options[j].getElementsByTagName("option_desc_SWE")[0].childNodes[0].nodeValue;
						              
						              var code_id = var_name+"_value";

						              var user_variable_code = $(code_id).text();

						              if(option_code == user_variable_code){
						              	$(code_id).html(option_desc);
						              }
						          }
      						}
					    }

					</script>

					<button id="btn-user-edit" type="button" class="btn btn-primary">Redigera profil</button>

					<?php
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


