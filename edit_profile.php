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

					echo "<div class='edit_profile_holder' id='name_holder'>$name</div>";
					echo "<div class='edit_profile_holder' id='email_holder'>$email</div>";
					echo "<div class='edit_profile_holder' id='genderID_holder'>$genderID</div>";
					echo "<div class='edit_profile_holder' id='birthyear_holder'>$birthyear</div>";
					echo "<div class='edit_profile_holder' id='regioncode_holder'>$regioncode</div>";
					echo "<div class='edit_profile_holder' id='adultnum_holder'>$adultnum</div>";
					echo "<div class='edit_profile_holder' id='childnum_holder'>$childnum</div>";
					echo "<div class='edit_profile_holder' id='smallchildren_holder'>$smallchildren</div>";
					echo "<div class='edit_profile_holder' id='accomodation_holder'>$accomodation</div>";
					echo "<div class='edit_profile_holder' id='roomnum_holder'>$roomnum</div>";
					echo "<div class='edit_profile_holder' id='vehicleavailable_holder'>$vehicleavailable</div>";
					echo "<div class='edit_profile_holder' id='education_holder'>$education</div>";
					echo "<div class='edit_profile_holder' id='occupation_holder'>$occupation</div>";
					echo "<div class='edit_profile_holder' id='workinghours_holder'>$workinghours</div>";
					echo "<div class='edit_profile_holder' id='health_holder'>$health</div>";
					echo "<div class='edit_profile_holder' id='stress_holder'>$stress</div>";

					?>
				<h2>Redigera användare</h2>
				<div id="successful-update-container">
				  <p id="update-msg">Uppdatering av användare genomförd. <a href="index.php?site=profile&user=<?php echo $user ?>">Tillbaka till profilsidan</a>.</p>
				</div>

				<form id="form-edit-profile" role="form" onsubmit="return false;">

					<script>

					    //The script builds the input registration from from the xml file structure
					    var xmlDoc = loadXMLDoc("userTable.xml");

					    //UI components
					    var textfield = "textfield";
					    var radiobutton = "radiobutton";
					    var calender = "calender";
					    var dropdown = "dropdown";
					    var spincontrol = "spincontrol";

					    //XML tag list
					    var variables = xmlDoc.getElementsByTagName("variable");
					    var variables_desc_SWE = xmlDoc.getElementsByTagName("var_desc_SWE");
					    var variables_name = xmlDoc.getElementsByTagName("var_name");
					    var variables_options = xmlDoc.getElementsByTagName("var_options");
					    var variables_ui_type = xmlDoc.getElementsByTagName("var_ui_type");

					    
					    for(var i=0; i<variables.length; i++){

					      //Write name of input field
					      var var_desc = variables_desc_SWE[i].childNodes[0].nodeValue;
					      document.write("<div class='form-group'>");
					      document.write("<label for='textInput'>");
					      document.write(var_desc);
					      document.write("</label>");

					      //Get the name variable
					      var name = variables_name[i].childNodes[0].nodeValue;

					      //Select type of input component
					      var var_ui_type = variables_ui_type[i].childNodes[0].nodeValue;

					      //Get current variable value from holder
					      var id_value = "#" + name + "_holder";
					      var current_value = $(id_value).text();

					      switch(var_ui_type){
					        case textfield:
					          document.write("<input type='text' class='form-control' value='"+current_value+"' name='"+name+"' required>");
					          break;
					        case radiobutton:
					          document.write("<br>");
					          var options = variables_options[i].getElementsByTagName("option");
					          for(var j=0; j<options.length; j++){
					              //Get code and description
					              var option_code = options[j].getElementsByTagName("option_code")[0].childNodes[0].nodeValue;
					              var option_desc = options[j].getElementsByTagName("option_desc_SWE")[0].childNodes[0].nodeValue;
					              //Set radiobutton and description

					              if(option_code == current_value){
					              	document.write("<input type='radio' name='"+name+"' value='"+option_code+"' checked> "+option_desc+"<br>");
					              }
					              else{
					              	document.write("<input type='radio' name='"+name+"' value='"+option_code+"'> "+option_desc+"<br>");
					              }

					              
					          }
					          break;
					        case calender:
					          document.write("<select id='yearpicker' class='form-control' name='"+name+"'>");
					          for(j = new Date().getFullYear(); j > 1920; j--){

					          	if(j == current_value){
					          		$('#yearpicker').append($('<option selected><option />').val(j).html(j));
					          	}
					          	else{
					          		$('#yearpicker').append($('<option><option />').val(j).html(j));
					          	}
					              
					          }
					          document.write("</select>");
					          break;
					        case dropdown:
					          document.write("<select class='form-control' name='"+name+"'>");
					          //Get options
					          var options = variables_options[i].getElementsByTagName("option");
					          for(var j=0; j<options.length; j++){
					              //Get code and description
					              var option_code = options[j].getElementsByTagName("option_code")[0].childNodes[0].nodeValue;
					              var option_desc = options[j].getElementsByTagName("option_desc_SWE")[0].childNodes[0].nodeValue;
					              //Set dropdown options

					              if(option_code == current_value){
					              		document.write("<option value='"+option_code+"' selected>");
							            document.write(option_desc);
							            document.write("</option>");
					              }
					              else{
					              		document.write("<option value='"+option_code+"'>");
							            document.write(option_desc);
							            document.write("</option>");
					              }

					              
					          }
					          document.write("</select>");
					          break;
					        case spincontrol:
					          document.write("<br>");
					          document.write("<input type='number' name='"+name+"' value='"+current_value+"' min='0' max='50' required>");
					          break;
					        default:
					      }

					      //End form-group div
					      document.write("</div>");
					    }
					    
					  </script>

					      <div id="status_holder"><p id="status"></p><img id="loader" src="images/ajax-loader.gif" alt="some_text"></div><br>
						  <button id="btn-save-profile-edit" type="submit" class="btn btn-primary">Spara ändringar</button>
						  <button id="btn-cancel-edit" type="button" class="btn btn-primary" onclick="window.location='index.php?site=home'">Avbryt</button>

					</form>

					<?php
				}
			}
			else{
				echo "<h2>Du saknar behörighet för att kunna se denna sida.</h2>";
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