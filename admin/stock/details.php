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
                <td>Gebruikersnaam</td>
                <td><?=$product["product"]?></td>
            </tr>
            <tr>
            	<td>Voorletters</td>
            	<td><?= $product["type"]; ?></td>
            </tr>
            <tr>
                <td>Voorvoegsel</td>
                <td><?=$product["factory_id"]?></td>
            </tr>
            <tr>
                <td>Achternaam</td>
                <td><?=$product["buy_price"];?></td>
            </tr>
            <tr>
                <td>Rol</td>
                <td><?=$product["sell_price"]?></td>
            </tr>
        </tbody>
    </table>
</fieldset>

<?php include("../base/footer.php"); ?>
