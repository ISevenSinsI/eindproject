<?php 
	include("../base/header.php");
	require("../functions/products.php"); 

	$id = $_GET["id"];
	$product = get_product($id);
?>
<fieldset>
    <a href="edit.php?id=<?= $product['id']; ?>" class="pure-button pure-button-primary pure-button-small fright" style="float: right">
        <i class="fa fa-pencil"></i>
    </a>
    <table class="pure-table pure-table-bordered pure-table-striped pure-form form_overview">
        <thead>
            <tr>
                <th>Gegevens</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        	<tr>
        		<td>Id</td>
        		<td><?= $product["id"]; ?></td>
        	</tr>
            <tr>
                <td>Product</td>
                <td><?=$product["product"]?></td>
            </tr>
            <tr>
            	<td>Type</td>
            	<td><?= $product["type"]; ?></td>
            </tr>
            <tr>
                <td>Fabriek</td>
                <td><?=$product["factory"]?></td>
            </tr>
            <tr>
                <td>Minimum voorraad</td>
                <td><?= number_format($product["minimum_stock"],0,",",".");?></td>  
            </tr>
            <tr>
                <td>Inkoopprijs</td>
                <td>&euro; <?= number_format($product["buy_price"],2,",","."); ?></td>
            </tr>
            <tr>
                <td>Verkoopprijs</td>
                <td>&euro; <?= number_format($product["sell_price"],2,",","."); ?></td>
            </tr>
        </tbody>
    </table>
</fieldset>

<?php include("../base/footer.php"); ?>
