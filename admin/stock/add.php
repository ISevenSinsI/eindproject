<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/products.php");

	$factories = get_all_factories();
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
				<td>Product</td>
				<td><input type="text" name="product" placeholder="Product" required/></td>
			</tr>	
			<tr>
				<td>Type</td>
				<td><input type="text" name="type" placeholder="Type" required/></td>
			</tr>	
			<tr>
				<td>Fabriek</td>
				<td>
					<select name="factory_id" style="width: 200px">
						<option value="0">Selecteer een fabriek</option>
						<?php foreach($factories as $factory): ?>
							<?php ($factory["id"] == $user["id"] ? $selected = "selected" : $selected = ""); ?>
							<option value="<?= $factory["id"]; ?>" <?= $selected; ?>><?= $factory["factory"]; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Inkoopprijs</td>
				<td><input type="text" name="buy_price" placeholder="Inkoopprijs"/></td>
			</tr>
			<tr>
				<td>Verkoopprijs</td>
				<td><input type="text" name="sell_price" placeholder="Verkoopprijs" required/></td>
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
$(document).ready(function(){
	$("select[name='factory_id']").select2({width: '200px', allowClear: true, placeholder: "Selecteer een fabriek"});

	$(".save_button").on("click",function(){
		link = "<?= $breadcrumb['module']['link'] ?>";

		$.post("../functions/products.php",{
			action: "new_product",
			id : $("input[name='id']").val(),
			product : $("input[name='product']").val(),
			type: $("input[name='type'").val(),
			factory_id: $("select[name='factory_id'] option:selected").val(),
			buy_price : $("input[name='buy_price']").val(),
			sell_price : $("input[name='sell_price']").val(),
		},function(data){
			// window.location = link;
		});
	});
});
</script>