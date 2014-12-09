<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/locations.php");

	$id = $_GET["id"];
	$location = get_location($id);
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
				<td>Locatienaam</td>
				<td><input type="text" name="location" value="<?= $location['location']; ?>" /></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?= $location['id']; ?>"/></td>
				<td>
					<div class="pure-button pure-button-primary edit_button">
						Wijzigen
					</div>
				</td>
			</tr>	
		</tbody>
	</table>
</fieldset>

<?php include("../base/footer.php"); 
?>


<script>
	$(".edit_button").on("click",function(){

		$.post("../functions/locations.php",{
			action: "edit_location",
			id : $("input[name='id']").val(),
			location : $("input[name='location']").val(),
		},function(data){
			window.location = window.location;
		});
	});
</script>