<div class="wrapper_login pure-u-1-3">
	<h2>ToolsForEver - Inloggen</h2>
	<form class="pure-form" method="post">
		<fieldset>	
			<input type="text" name="email" required="required" placeholder="Email" style="width: 200px;"/>
			<div class="pure-button button-error email_incorrect">Email incorrect</div><br /><br />

			<input type="password" name="password" required="required" placeholder="Wachtwoord" style="width: 200px;"/>
			<div class="pure-button button-error password_incorrect">Wachtwoord foutief</div><br /><br />
		
			
			<input type="submit" value="Inloggen" class="login_btn pure-button pure-button-primary" style="width: 200px;"/>
		</fieldset>
	</form>
</div>

<script>
	$(".login_btn").on("click",function(){
		email = $("input[name='email']").val();
		password = $("input[name='password']").val();

		$(".email_incorrect").hide();	
		$(".password_incorrect").hide();

		$.post("login/do_login",{
			email: email,
			password: password,
		},function(data){
			response = jQuery.parseJSON(data);

			if(response == "E-mail foutief"){
				$(".email_incorrect").show();
			}

			if(response == "Wachtwoord foutief"){
				$(".password_incorrect").show();
			}
		});

		return false;
	});
</script>