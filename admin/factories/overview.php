<?php
	include("../base/header.php");
	require("../functions/factories.php"); 
	$factories = get_all_factories();
	session_start();
?>
	<table class="pure-table pure-table-bordered pure-table-striped dataTable no-footer" id="datatable">
		<thead>
			<tr class="pure-form">
				<th class="column_id"><input data-column="0" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="#" /></th>
				<th><input data-column="1" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Fabriek" /></th>
				<th><input data-column="2" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Telefoonnummer" /></th>
				<th class="table_actions"></th>
			</tr>
	        <tr class="table_legend">
	        	<th class="column_id">#</th>
	        	<th>Fabriek</th>
	            <th>Telefoonnummer</th>
	            <th>Acties</th>
	        </tr>
		</thead>
		<tbody>
			<?php foreach($factories as $factory): ?>
				<tr>
					<td><?= $factory["id"]; ?></td>
					<td><?= $factory["factory"]; ?></td>
					<td><?= $factory["phone"]; ?></td>
					<td>
					 	<a href="details.php?id=<?= $factory['id'] ?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Details">
			          		<i class="fa fa-info-circle"></i>
			        	</a>

			       		<?php if($_SESSION["user"]["role_id"] == 1): ?>
			          		<a href="edit.php?id=<?=$factory["id"]?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Bewerken">
			            		<i class="fa fa-pencil"></i>
			          		</a>
			        	<?php endif; ?>

			        	<?php if($_SESSION["user"]["role_id"] == 1): ?>
							<a href="#" class="pure-button pure-button-primary pure-button-small delete_button" data-id="<?=$factory['id'] ?>" data-name="<?= $factory['factory'] ?>" title="Verwijderen"><i class="fa fa-trash-o"></i></a>
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