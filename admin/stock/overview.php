<?php
	include("../base/header.php");
	require("../functions/products.php"); 
	$products = get_all_products();
?>
	<table class="pure-table pure-table-bordered pure-table-striped dataTable no-footer" id="datatable">
		<thead>
			<tr class="pure-form">
				<th class="column_id"><input data-column="0" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="#" /></th>
				<th><input data-column="1" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Product" /></th>
				<th><input data-column="2" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Type" /></th>
				<th><input data-column="3" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Fabriek" /></th>
				<th><input data-column="4" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Minimum voorraad" /></th>
				<th><input data-column="5" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Inkoopprijs" /></th>
				<th><input data-column="6" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Verkoopprijs" /></th>
				<th class="table_actions"></th>
			</tr>
	        <tr class="table_legend">
	        	<th>#</th>
	            <th>Product</th>
	            <th>Type</th>
	            <th>Fabriek</th>
	            <th>Min. Voorraad</th>
	            <th>Inkoopprijs</th>
	            <th>Verkoopprijs</th>
	            <th>Acties</th>
	        </tr>
		</thead>
		<tbody>
			<?php foreach($products as $product): ?>
				<tr>
					<td><?= $product["id"]; ?></td>
					<td><?= $product["product"]; ?></td>
					<td><?= $product["type"]; ?></td>
					<td><?= $product["factory"]; ?></td>
					<td><?= number_format($product["minimum_stock"],0,",","."); ?></td>
					<td>&euro; <?= number_format($product["buy_price"],2,",","."); ?></td>
					<td>&euro; <?= number_format($product["sell_price"],2,",","."); ?></td>

					<td>
					 	<a href="details.php?id=<?= $product['id'] ?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Details">
			          		<i class="fa fa-info-circle"></i>
			        	</a>

			       		<?php if($_SESSION["user"]["role_id"] == 1): ?>
			          		<a href="edit.php?id=<?=$product["id"]?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Bewerken">
			            		<i class="fa fa-pencil"></i>
			          		</a>
			        	<?php endif; ?>

			        	<?php if($_SESSION["user"]["role_id"] == 1): ?>
							<a href="#" class="pure-button pure-button-primary pure-button-small but_user_index button-delete-product delete_button" data-id="<?=$product['id'] ?>" data-name="<?= $product['product'] ?>" title="Verwijderen"><i class="fa fa-trash-o"></i></a>
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
		product = $(this).data("product");

		$(".title").html(product);
		$("input[name='deleted_id']").val(id);

		$(".dialog").show();

		return false;
	})
</script>

<?php include("delete_dialog.php"); ?>