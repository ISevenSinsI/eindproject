<?php
	include("../base/header.php");
	require("../functions/users.php"); 
	$users = get_all_users();
	session_start();
?>
	<table class="pure-table pure-table-bordered pure-table-striped dataTable no-footer" id="datatable">
		<thead>
			<tr class="pure-form">
				<th class="column-id"><input data-column="0" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="#"/></th>
				<th><input data-column="1" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Naam" /></th>
				<th><input data-column="2" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Inlogcode" /></th>
				<th><input data-column="3" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Rol" /></th>
				<th><input data-column="4" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Tel-nr" /></th>
				<th><input data-column="5" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Woonplaats" /></th>
				<th></th>
			</tr>
	        <tr class="table_legend">
	        	<th>#</th>
	            <th>Naam</th>
	            <th>E-mail</th>
	            <th>Rol</th>
	            <th>Tel-nr</th>
	            <th>Woonplaats</th>
	            <th>Acties</th>
	        </tr>
		</thead>
		<tbody>
			<?php foreach($users as $user): ?>
				<tr>
					<td><?= $user["id"]; ?></td>
					<td><?= $user["name"]; ?></td>
					<td><?= $user["email"]; ?></td>
					<td><?= $user["role"]; ?></td>
					<td><?= $user["phone"]; ?></td>
					<td><?= $user["city"]; ?></td>
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
							<a href="#" class="pure-button pure-button-primary pure-button-small but_user_index button-delete-user delete_button" data-id="<?=$user['id'] ?>" data-name="<?= $user['name'] ?>" title="Verwijderen"><i class="fa fa-trash-o"></i></a>
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