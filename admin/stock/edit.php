<?php
	session_start();
	if($_SESSION["user"]["role_id"] != 1){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/products.php");

	$id = $_GET["id"];
	$product = get_product($id);
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
				<td><input type="text" name="product" value="<?= $product['product']; ?>" required/></td>
			</tr>	
			<tr>
				<td>Type</td>
				<td><input type="text" name="type" value="<?= $product['type']; ?>" required/></td>
			</tr>
			<tr>
				<td>Fabriek</td>
				<td>
					<select name="factory_id" style="width: 14.7%">
						<?php foreach($factories as $factory): ?>
							<?php ($factory["id"] == $product["id"] ? $selected = "selected" : $selected = ""); ?>
							<option value="<?= $factory["id"]; ?>" <?= $selected; ?>><?= $factory["factory"]; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Inkoopprijs</td>
				<td><input type="text" name="buy_price" value="<?= $product['buy_price']; ?>" required	/></td>
			</tr>
			<tr>
				<td>Verkoopprijs</td>
				<td><input type="text" name="sell_price" value="<?= $product['sell_price']; ?>" required	/></td>
			</tr>	
			
			<tr>
				<td><input type="hidden" name="id" value="<?= $product['id']; ?>"/></td>
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
		$.post("../functions/products.php",{
			action: "edit_product",
			id : $("input[name='id']").val(),
			product : $("input[name='product']").val(),
			type: $("input[name='type']").val(),
			factory_id : $("select[name='factory_id'] option:selected").val(),
			buy_price : $("input[name='buy_price']").val(),
			sell_price : $("input[name='sell_price']").val(),
		},function(data){
			show_save_message();
		});
	});
</script>