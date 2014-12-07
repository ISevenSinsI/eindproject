<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/users.php");

	$roles = get_all_roles();
?>

<fieldset>
	<table class="pure-table pure-table-bordered pure-table-striped pure-form form form_overview">
		<thead>
			<tr>
				<th colspan="2">Gegevens aanpassen</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Naam</td>
				<td><input type="text" name="name" placeholder="Naam" /></td>
			</tr>	
			<tr>
				<td>Wachtwoord</td>
				<td><input type="password" name="password" placeholder="Wachtwoord" /></td>
			</tr>	
			<tr>
				<td>E-mail</td>
				<td><input type="text" name="email" placeholder="E-mail"/></td>
			</tr>
			<tr>
				<td>Rol</td>
				<td>
					<select name="role_id" style="width: 14.7%">
						<option value="0">Selecteer een rol</option>
						<?php foreach($roles as $role): ?>
							<?php ($role["id"] == $user["id"] ? $selected = "selected" : $selected = ""); ?>
							<option value="<?= $role["id"]; ?>" <?= $selected; ?>><?= $role["name"]; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Telefoonnummer</td>
				<td><input type="text" name="phone" placeholder="Telefoonnummer"/></td>
			</tr>
			<tr>
				<td>Adres</td>
				<td><input type="text" name="address" placeholder="Adres"/></td>
			</tr>
			<tr>
				<td>Postcode</td>
				<td><input type="text" name="zipcode" placeholder="Postcode"/></td>
			</tr>
			<tr>
				<td>Plaats</td>
				<td><input type="text" name="city" placeholder="Plaats"/></td>
			</tr>
			<tr>
				<td>Land</td>
				<td><input type="text" name="country" placeholder="Land"/></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=""/></td>
				<td>
					<div class="pure-button pure-button-primary save_button">
						Opslaan
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>

<?php include("../base/footer.php"); ?>


<script>
	$(".save_button").on("click",function(){

		$.post("../functions/users.php",{
			action: "new_user",
			id : $("input[name='id']").val(),
			name : $("input[name='name']").val(),
			password: $("input[name='password'").val(),
			email: $("input[name='email']").val(),
			role_id : $("select[name='role_id'] option:selected").val(),
			phone : $("input[name='phone']").val(),
			address : $("input[name='address']").val(),
			zipcode : $("input[name='zipcode']").val(),
			city : $("input[name='city']").val(),
			country : $("input[name='country']").val(),
		},function(data){
			window.location = window.location;
		});
	});
</script>