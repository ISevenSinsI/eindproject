<?php
	session_start();
	// Check if user is logged in.s
	if(isSet($_SESSION["user"]) && $_SESSION["user"]["id"] > 0){
		// Redirect to users overview
		header('Location: '. "users/overview.php");
		// Die to prevent executing rest of code.
		die();
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>ToolsForEver - Inloggen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="robots" content="nofollow" />
    

    <link rel="stylesheet" href="../assets/css/pure-min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/style.css">
 
  </head>
  <body>

    <div class="pure-g top-bar">
      <div class="container">
        <div class="pure-u-1-12">
          <a class="brand" style="margin:0px;" href="#"><img width="100" style="margin-bottom: -20%;" src="../assets/img/logo.png"/></a>
        </div>
        <div class="pure-u-11-12">
        	<div class="menu-item last">
			    <div class="menu-item-inner">
			        <a class="pure-button secondary-button" href="../">
			            <i class="fa fa-desktop fa-2x"></i>
			            <p>Website</p>
			        </a>
			    </div>
			</div>
        </div>
      </div>
    </div>

    <div class="content container pure-g">
    	<div class="content_inner pure-u-1-3">
    		<form action="authenticate_login.php" method="post" class="pure-form login_form">
    			<fieldset>
    				<legend>ToolsForEver - Inloggen</legend>
	    			<input type="text" name="username" placeholder="Gebruikersnaam"/><br />
	    			<input type="password" name="password" placeholder="password"/><br />
	    			<div class="login_error">Inloggegevens incorrect.</div><br />
	    			<div class="login_btn pure-button pure-button-primary"/>Inloggen</div><br /><br />	
	    		</fieldset>
    		</form>
    	</div>
    </div>
  </body>
</html>

<script type="text/javaScript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script>	
	$(document).ready(function(){

		alert("iets");

		$(".login_btn").on("click", function(){
			login();
			return false;
		});

		$("input").keypress(function(key){
			if(key.which == 13) {
	        	login();
	    	}
		});

		function login(){
			// Hide error message
			$(".login_error").fadeOut('fast');

			username = $("input[name='username']").val();
			password = $("input[name='password']").val();

			// Post to login authentication function
			$.post("authenticate_login.php",{
				username: username,
				password: password,
			},function(data){
				// Parse json object to normal string
				result = jQuery.parseJSON(data);

				// Check result
				if(result == "succeeded"){
					// If succeeded, reload page due to session check
					window.location = window.location;
				} else {
					$(".login_error").fadeIn('slow');
				}
			});	
		}
	});
</script>