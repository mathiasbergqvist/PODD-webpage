<?php
//If user is logged in already, header that weenis away
if(isset($_SESSION["email"])){
	header("location: index.php?site=profile&user=".$_SESSION["email"]);
}
?>

<form id="form-login" class="form-signin" onsubmit="return false;">
    <h2 class="form-signin-heading">Logga in</h2>
    <input id="email_input" type="email" class="form-control" name="email" placeholder="Email" onfocus="emptyElement('status')" required autofocus>
    <br>
    <input id="password_input" type="password" class="form-control" name="password" placeholder="Lösenord" onfocus="emptyElement('status')"  required>
 	<br>
    <div id="status_holder"><p id="status"></p><img id="loader" src="images/ajax-loader.gif" alt="some_text"></div>
    <button id="btn-login" class="btn btn-lg btn-primary btn-block" type="submit">Logga in</button>
</form>
