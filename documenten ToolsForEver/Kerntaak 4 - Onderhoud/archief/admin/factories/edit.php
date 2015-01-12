<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/factories.php");

	$id = $_GET["id"];
	$factory = get_factory($id);
?>
<div class="pure-button pure-button-primary edit_button">
	Wijzigen
</div>
<fieldset>
	<table class="pure-table pure-table-bordered pure-table-striped pure-form form form_overview">
		<thead>
			<tr>
				<th>Gegevens aanpassen</th>
				<th>

				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Fabriek</td>
				<td><input type="text" name="factory" value="<?= $factory['factory']; ?>" required/></td>
			</tr>	
			<tr>
				<td>Telefoonnummer</td>
				<td><input type="text" name="phone" value="<?= $factory['phone']; ?>" required/></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?= $factory['id']; ?>"/></td>
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
		$.post("../functions/factories.php",{
			action: "edit_factory",
			id : $("input[name='id']").val(),
			factory : $("input[name='factory']").val(),
			phone: $("input[name='phone']").val(),
		},function(data){
			show_save_message();
		});
	});
</script>