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


<table class="stock_value">
<?php foreach($data["locations"] as $location){ ?>
	<tr>
		<th colspan="7">Locatie <?php echo $location["name"]; ?> </th>
	</tr>
	<tr>
		<th>Product </th>
		<th>Type </th>
		<th>Fabriek </th>
		<th>Aantal </th>
		<th>Inkoopprijs </th>
		<th>Verkoopprijs</th>
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
<?php } ?>



</table>