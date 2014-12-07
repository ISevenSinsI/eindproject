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
				<td><input type="text" name="name" value="<?= $user['name']; ?>" /></td>
			</tr>	
			<tr>
				<td>E-mail</td>
				<td><input type="text" name="email" value="<?= $user['email']; ?>"/></td>
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
				<td>Telefoonnummer</td>
				<td><input type="text" name="phone" value="<?= $user['phone']; ?>"/></td>
			</tr>
			<tr>
				<td>Adres</td>
				<td><input type="text" name="address" value="<?= $user['address']; ?>"/></td>
			</tr>
			<tr>
				<td>Postcode</td>
				<td><input type="text" name="zipcode" value="<?= $user['zipcode']; ?>"/></td>
			</tr>
			<tr>
				<td>Plaats</td>
				<td><input type="text" name="city" value="<?= $user['city']; ?>"/></td>
			</tr>
			<tr>
				<td>Land</td>
				<td><input type="text" name="country" value="<?= $user['country']; ?>"/></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?= $user['id']; ?>"/></td>
				<td>
					<div class="pure-button pure-button-primary edit_button">
						Wijzigen
					</div>
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
			name : $("input[name='name']").val(),
			email: $("input[name='email']").val(),
			role_id : $("select[name='role_id'] option:selected").val(),
			phone : $("input[name='phone']").val(),
			address : $("input[name='address']").val(),
			city : $("input[name='city']").val(),
			country : $("input[name='country']").val(),
		},function(data){
			window.location = window.location;
		});
	});
</script>