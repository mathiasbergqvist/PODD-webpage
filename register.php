<?php
  if(loggedin()){
    header("location: index.php?site=profile&user=".$_SESSION["email"]);
  }
?>
<h2>Registrera ny användare</h2>
<div id="successful-registation-container">
  <p id="registration-msg">Registrering av användare genomförd. Du kan nu <a href="index.php?site=login">logga in</a> och se/redigera dina personuppgifter.</p>
  <a href="index.php?site=home">Tillbaka</a>
</div>
<form id="form-register" role="form" onsubmit="return false;">

  <div class="form-group">
    <label for="textInput">
      Email
    </label>
    <input id="email_input" type="email" class="form-control" name="email" placeholder="Email" onfocus="emptyElement('status')" required autofocus>
  </div>
  <div class="form-group">
    <label for="textInput">
      Välj lösenord
    </label>
    <input id="password_input" type="password" class="form-control" name="password" placeholder="Lösenord" onfocus="emptyElement('status')"  required>
  </div>
  <div class="form-group">
    <label for="textInput">
      Upprepa lösenord
    </label>
    <input id="password_input_repeat" type="password" class="form-control" name="password_repeat" placeholder="Lösenord" onfocus="emptyElement('status')"  required>
  </div>
  

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

      switch(var_ui_type){
        case textfield:
          document.write("<input type='text' class='form-control' placeholder='"+var_desc+"' name='"+name+"' required>");
          break;
        case radiobutton:
          document.write("<br>");
          var options = variables_options[i].getElementsByTagName("option");
          for(var j=0; j<options.length; j++){
              //Get code and description
              var option_code = options[j].getElementsByTagName("option_code")[0].childNodes[0].nodeValue;
              var option_desc = options[j].getElementsByTagName("option_desc_SWE")[0].childNodes[0].nodeValue;
              //Set radiobutton and description
              document.write("<input type='radio' name='"+name+"' value='"+option_code+"' checked> "+option_desc+"<br>");
          }
          break;
        case calender:
          document.write("<select id='yearpicker' class='form-control' name='"+name+"'>");
          for(j = new Date().getFullYear(); j > 1900; j--){
              $('#yearpicker').append($('<option />').val(j).html(j));
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
              document.write("<option value='"+option_code+"'>");
              document.write(option_desc);
              document.write("</option>");
          }
          document.write("</select>");
          break;
        case spincontrol:
          document.write("<br>");
          document.write("<input type='number' name='"+name+"' min='0' max='50' required>");
          break;
        default:
      }

      //End form-group div
      document.write("</div>");
    }
    
  </script>
  <div id="status_holder"><p id="status"></p><img id="loader" src="images/ajax-loader.gif" alt="some_text"></div><br>
  <button id="btn-register" type="submit" class="btn btn-primary">Registrera konto</button>
  <button id="btn-cancel-registration" type="button" class="btn btn-primary" onclick="window.location='index.php?site=home'">Avbryt</button>

</form>


<!--
<form role="form">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
-->