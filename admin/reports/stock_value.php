<?php
//stock value

	session_start();
	if($_SESSION["user"]["role_id"] > 2){
		echo "Onvoldoende rechten.<br />";
		die();
	}

	include("../base/header.php");
	require("../functions/reports.php");

	$data = getPerLocation();
	//p($data);
?>

<table class="stock_value pure-table">
	<?php foreach($data["locations"] as $location): ?> 
		<tr>
			<th colspan="7">Locatie <?php echo $location["name"]; ?> </th>
		</tr>
		<tr class="table_legend">
			<th class="table_actions">Product </th>
			<th class="table_actions">Type </th>
			<th class="table_actions">Fabriek </th>
			<th class="table_actions">Aantal </th>
			<th class="table_actions">Prijs </th>
			<th class="table_actions">Waarde inkoop </th>
			<th class="table_actions">Waarde verkoop </th>
		</tr>
		<?php foreach($location["products"] as $product): ?>
			<tr>
				<td> 
					<?php if($product["minimum_stock"] > $product["amount"]): ?>
						<i class='fa fa-exclamation-circle' title='Te bestellen' style='color: red; font-size: 18px'></i> 
					<?php endif; ?>
					<?= $product["name"]; ?> 
				</td>
				<td> <?= $product["type"]; ?> </td>
				<td> <?= $product["factory"]; ?> </td>
				<td> <?= $product["amount"]; ?> </td>
				<td> &euro;<?= number_format($product["buy_price"], 2,",","."); ?> </td>
				<td> &euro;<?= number_format($product["total_buy_price"], 2,",","."); ?> </td>
				<td> &euro;<?= number_format($product["total_sell_price"], 2,",","."); ?> </td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="5" class="total_location"><b>Totaal Locatie:</b></td>
			<td><b> &euro;<?= number_format($location["total_buy_price"], 2,",","."); ?></b></td>
			<td><b> &euro;<?= number_format($location["total_sell_price"], 2,",","."); ?></b></td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<th colspan="5" style="text-align: right;"><b>Totaal</b></th>
		<th>&euro; <?= number_format($data["total_buy_price"],2,",","."); ?></th>
		<th>&euro; <?= number_format($data["total_sell_price"],2,",","."); ?></th>
	</tr>

</table>

