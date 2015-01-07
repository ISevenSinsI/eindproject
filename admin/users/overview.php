<?php
	include("../base/header.php");
	require("../functions/users.php"); 
	
	$users = get_all_users();

	if($_SESSION["user"]["role_id"] > 2){
		echo "Geen directe toegang mogelijk, onvoldoende rechten";
		die();
	}
?>
	<table class="pure-table pure-table-bordered pure-table-striped dataTable no-footer" id="datatable">
		<thead>
			<tr class="pure-form">
				<th class="column_id"><input data-column="0" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="#" /></th>
				<th><input data-column="1" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Gebruikersnaam" /></th>
				<th><input data-column="2" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Voorletters" /></th>
				<th><input data-column="3" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Voorvoegsel" /></th>
				<th><input data-column="4" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Achternaam" /></th>
				<th><input data-column="5" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Rol" /></th>
				<th class="table_actions"></th>
			</tr>
	        <tr class="table_legend">
	        	<th class="column_id">#</th>
	            <th>Gebruikersnaam</th>
	            <th>Voorletters</th>
	            <th>Voorvoegsel</th>
	            <th>Achternaam</th>
	            <th>Rol</th>
	            <th>Acties</th>
	        </tr>
		</thead>
		<tbody>
			<?php foreach($users as $user): ?>
				<tr>
					<td><?= $user["id"]; ?></td>
					<td><?= $user["username"]; ?></td>
					<td><?= $user["initials"]; ?></td>
					<td><?= $user["prefix"]; ?></td>
					<td><?= $user["last_name"]; ?></td>
					<td><?= $user["role"]; ?></td>
					<td>
					 	<a href="details.php?id=<?= $user['id'] ?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Details">
			          		<i class="fa fa-info-circle"></i>
			        	</a>

			       		<?php if($_SESSION["user"]["role_id"] == 1): ?>
			          		<a href="edit.php?id=<?=$user["id"]?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Bewerken">
			            		<i class="fa fa-pencil"></i>
			          		</a>
			        	<?php endif; ?>

			        	<?php if($_SESSION["user"]["role_id"] == 1 && $user["id"] != "1"): ?>
							<a href="#" class="pure-button pure-button-primary pure-button-small but_user_index button-delete-user delete_button" data-id="<?=$user['id'] ?>" data-name="<?= $user['username'] ?>" title="Verwijderen"><i class="fa fa-trash-o"></i></a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?php include("../base/footer.php"); ?>

<script>
	$(document).ready(function(){
		create_datatable();
	});	

	$(".delete_button").on("click",function(){
		id = $(this).data("id");
		name = $(this).data("name");

		$(".title").html(name);
		$("input[name='deleted_id']").val(id);

		$(".dialog").show();

		return false;
	})
</script>

<?php include("delete_dialog.php"); ?>