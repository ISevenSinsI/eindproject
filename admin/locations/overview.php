<?php
	include("../base/header.php");
	require("../functions/locations.php"); 
	$locations = get_all_locations();
	session_start();
?>
	<table class="pure-table pure-table-bordered pure-table-striped dataTable no-footer" id="datatable">
		<thead>
			<tr class="pure-form">
				<th><input data-column="0" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="#" /></th>
				<th><input data-column="1" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Locatie" /></th>
				<th></th>
			</tr>
	        <tr class="table_legend">
	        	<th>#</th>
	            <th>Locatie</th>
	            <th>Acties</th>
	        </tr>
		</thead>
		<tbody>
			<?php foreach($locations as $location): ?>
				<tr>
					<td><?= $location["id"]; ?></td>
					<td><?= $location["location"]; ?></td>
					<td>
					 	<a href="details.php?id=<?= $location['id'] ?>" class="pure-button pure-button-primary pure-button-small but_location_index" title="Details">
			          		<i class="fa fa-info-circle"></i>
			        	</a>

			       		<?php if($_SESSION["user"]["role_id"] == 1): ?>
			          		<a href="edit.php?id=<?=$location["id"]?>" class="pure-button pure-button-primary pure-button-small but_location_index" title="Bewerken">
			            		<i class="fa fa-pencil"></i>
			          		</a>
			        	<?php endif; ?>

			        	<?php if($_SESSION["user"]["role_id"] == 1 && $location["id"] != "1"): ?>
							<a href="#" class="pure-button pure-button-primary pure-button-small but_location_index button-delete-location delete_button" data-id="<?=$location['id'] ?>" data-name="<?= $location['name'] ?>" title="Verwijderen"><i class="fa fa-trash-o"></i></a>
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
		locatie = $(this).data("locatie");

		$(".title").html(locatie);
		$("input[locatie='deleted_id']").val(id);

		$(".dialog").show();

		return false;
	})
</script>

<?php include("delete_dialog.php"); ?>