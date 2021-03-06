<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/users.php");

	$id = $_GET["id"];
	$user = get_user($id);
	$roles = get_all_roles();
?>
<div class="pure-button pure-button-primary edit_button">
	Wijzigen
</div>
<fieldset>
	<table class="pure-table pure-table-bordered pure-table-striped pure-form form form_overview">
		<thead>
			<tr>
				<th>Gegevens aanpassen</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Gebruikersnaam</td>
				<td><input type="text" name="username" value="<?= $user['username']; ?>" required/></td>
			</tr>	
			<tr>
				<td>Voorletters</td>
				<td><input type="text" name="initials" value="<?= $user['initials']; ?>" required/></td>
			</tr>
			<tr>
				<td>Voorvoegsels</td>
				<td><input type="text" name="prefix" value="<?= $user['prefix']; ?>"/></td>
			</tr>
			<tr>
				<td>Achternaam</td>
				<td><input type="text" name="last_name" value="<?= $user['last_name']; ?>" required	/></td>
			</tr>	
			<tr>
				<td>Rol</td>
				<td>
					<select name="role_id" style="width: 14.7%">
						<?php foreach($roles as $role): ?>
							<?php ($role["id"] == $user["id"] ? $selected = "selected" : $selected = ""); ?>
							<option value="<?= $role["id"]; ?>" <?= $selected; ?>><?= $role["name"]; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?= $user['id']; ?>"/></td>
				<td>
					<div class="pure-button pure-button-primary edit_button">
						Wijzigen
					</div>
					<span class="save_message">
						<i class="fa fa-check-circle" style="color: green;"></i>
						Opgeslagen!
					</span>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>

<?php include("../base/footer.php"); ?>


<script>
	$(".edit_button").on("click",function(){
		$.post("../functions/users.php",{
			action: "edit_user",
			id : $("input[name='id']").val(),
			username : $("input[name='username']").val(),
			initials: $("input[name='initials']").val(),
			role_id : $("select[name='role_id'] option:selected").val(),
			prefix : $("input[name='prefix']").val(),
			last_name : $("input[name='last_name']").val(),
		},function(data){
			show_save_message();
		});
	});
</script>