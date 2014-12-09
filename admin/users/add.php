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
				<td>Gebruikersnaam</td>
				<td><input type="text" name="username" placeholder="Gebruikersnaam" required/></td>
			</tr>	
			<tr>
				<td>Wachtwoord</td>
				<td><input type="password" name="password" placeholder="Wachtwoord" required/></td>
			</tr>	
			<tr>
				<td>Voorletters</td>
				<td><input type="text" name="initials" placeholder="Voorletters" required/></td>
			</tr>
			<tr>
				<td>Voorvoegsel</td>
				<td><input type="text" name="prefix" placeholder="Voorvoegsel"/></td>
			</tr>
			<tr>
				<td>Achternaam</td>
				<td><input type="text" name="last_name" placeholder="Achternaam" required/></td>
			</tr>
			<tr>
				<td>Rol</td>
				<td>
					<select name="role_id" style="width: 200px">
						<option value="0">Selecteer een rol</option>
						<?php foreach($roles as $role): ?>
							<?php ($role["id"] == $user["id"] ? $selected = "selected" : $selected = ""); ?>
							<option value="<?= $role["id"]; ?>" <?= $selected; ?>><?= $role["name"]; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
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
		link = "<?= $breadcrumb['module']['link'] ?>";

		$.post("../functions/users.php",{
			action: "new_user",
			id : $("input[name='id']").val(),
			username : $("input[name='username']").val(),
			password: $("input[name='password'").val(),
			initials: $("input[name='initials']").val(),
			role_id : $("select[name='role_id'] option:selected").val(),
			prefix : $("input[name='prefix']").val(),
			last_name : $("input[name='last_name']").val(),
		},function(data){
			// window.location = link;
		});
	});
</script>