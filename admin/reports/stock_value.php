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

<table class="stock_value">
	<?php foreach($data["locations"] as $location): ?> 
		<tr>
			<th colspan="7">Locatie <?php echo $location["name"]; ?> </th>
		</tr>

		<tr>
			<th>Product </th>
			<th>Type </th>
			<th>Fabriek </th>
			<th>Aantal </th>
			<th>Prijs </th>
			<th>Waarde inkoop </th>
			<th>Waarde verkoop </th>
		</tr>
		<?php foreach($location["products"] as $product): ?>
			<tr>
				<td> <?= $product["name"]; ?> </td>
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

