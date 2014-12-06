<?php 
	include("../base/header.php");
	require("../functions/users.php"); 
	session_start();

	$id = $_GET["id"];
	$user = get_user($id);
?>
<fieldset>
    <a href="edit.php?id=<?= $user['id']; ?>" class="pure-button pure-button-primary pure-button-small fright" style="float: right">
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
        		<td><?= $user["id"]; ?></td>
        	</tr>
            <tr>
                <td>Naam</td>
                <td><?=$user["name"]?></td>
            </tr>
            <tr>
            	<td>E-mail</td>
            	<td><?= $user["email"]; ?></td>
            </tr>
            <tr>
                <td>Rol</td>
                <td><?=$user["role"]?></td>
            </tr>
            <tr>
                <td>Telefoon</td>
                <td><?=$user["phone"]?></td>
            </tr>
            <tr>
                <td>Adres</td>
                <td><?=$user["address"]?></td>
            </tr>
            <tr>
                <td>Postcode</td>
                <td><?=$user["zipcode"]?></td>
            </tr>
            <tr>
                <td>Stad</td>
                <td><?=$user["city"]?></td>
            </tr>
            <tr>
                <td>Land</td>
                <td><?=$user["country"]?></td>
            </tr>            
        </tbody>
    </table>
</fieldset>

<?php include("../base/footer.php"); ?>
