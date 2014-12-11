<?php
//stock value

	session_start();
	if($_SESSION["user"]["role_id"] > 2){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/temp_reports.php");

	$data = stock();
	//p($data);
?>

<?php if(isset($data["locations"])): ?>
	<?php foreach($data["locations"] as $location): ?>
		<table class="stock_value pure-table">
			<tr>
				<th colspan="7">Locatie <?php echo $location["name"]; ?> </th>
			</tr>
			<tr class="table_legend">
				<th class="table_actions">Product </th>
				<th class="table_actions">Type </th>
				<th class="table_actions">Fabriek </th>
				<th class="table_actions">Aantal </th>
				<th class="table_actions">Inkoopprijs </th>
				<th class="table_actions">Verkoopprijs</th>
			</tr>
			<?php foreach($location["products"] as $product): ?>
				<tr>
					<td> <?= $product["name"]; ?> </td>
					<td> <?= $product["type"]; ?> </td>
					<td> <?= $product["factory"]; ?> </td>
					<td> <?= $product["amount"]; ?> </td>
					<td> &euro;<?= number_format($product["buy_price"], 2,",","."); ?> </td>
					<td> &euro;<?= number_format($product["sell_price"], 2,",","."); ?> </td>
				</tr>
			<?php endforeach; ?>
		</table><br />
	<?php endforeach; ?>
<?php endif; ?>