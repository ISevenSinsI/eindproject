<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/factories.php");
?>

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
				<td>Fabriek</td>
				<td><input type="text" name="factory" placeholder="Fabriek" required/></td>
			</tr>	
			<tr>
				<td>Telefoonnummer</td>
				<td><input type="text" name="phone" placeholder="Telefoonnummers" required/></td>
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

		$.post("../functions/factories.php",{
			action: "new_factory",
			id : $("input[name='id']").val(),
			factory : $("input[name='factory']").val(),
			phone : $("input[name='phone']").val(),

		},function(data){
			window.location = link;
		});
	});
</script>