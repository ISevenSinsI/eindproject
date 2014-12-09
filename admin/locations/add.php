<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/locations.php");
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
				<td>Locatie</td>
				<td><input type="text" name="name" placeholder="Locatie" /></td>
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

		$.post("../functions/locations.php",{
			action: "new_location",
			id : $("input[name='id']").val(),
			name : $("input[name='name']").val(),
		},function(data){
			window.location = window.location;
		});
	});
</script>