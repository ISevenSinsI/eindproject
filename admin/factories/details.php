<?php 
	include("../base/header.php");
	require("../functions/factories.php"); 
	session_start();

	$id = $_GET["id"];
	$factory = get_factory($id);
?>
<fieldset>
    <a href="edit.php?id=<?= $factory['id']; ?>" class="pure-button pure-button-primary pure-button-small fright" style="float: right">
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
        		<td><?= $factory["id"]; ?></td>
        	</tr>
            <tr>
                <td>Fabriek</td>
                <td><?=$factory["factory"]?></td>
            </tr>
            <tr>
            	<td>Telefoonnummer</td>
            	<td><?= $factory["phone"]; ?></td>
            </tr>
        </tbody>
    </table>
</fieldset>

<?php include("../base/footer.php"); ?>
