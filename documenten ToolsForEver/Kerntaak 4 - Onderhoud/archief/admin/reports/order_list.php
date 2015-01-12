<?php
	session_start();
	if($_SESSION["user"]["role_id"] > 2){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/reports.php");

	$data = order_list();
	// d($data);
?>

<?php foreach($data as $location): ?>
	<table class="stock_value pure-table">
		<tr>
			<th colspan="5">Locatie <?= $location["location_name"]; ?></th>
		</tr>
		<tr class="table_legend">
			<th class="table_actions">Product</th>
			<th class="table_actions">Type</th>
			<th class="table_actions">Fabriek</th>
			<th class="table_actions">Minimum aantal</th>
			<th class="table_actions">Aantal te bestellen</th>
		</tr>
		<?php foreach($location["products"] as $product): ?>
			<tr>
				<td>
					<?= $product["name"]; ?>
				</td>
				<td><?= $product["type"]; ?></td>
				<td><?= $product["factory"]; ?></td>
				<td><?= $product["minimum_stock"]; ?></td>
				<td><?= $product["to_order"]; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<br />
<?php endforeach; ?>
