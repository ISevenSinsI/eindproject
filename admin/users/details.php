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
                <td>Gebruikersnaam</td>
                <td><?=$user["username"]?></td>
            </tr>
            <tr>
            	<td>Voorletters</td>
            	<td><?= $user["initials"]; ?></td>
            </tr>
            <tr>
                <td>Voorvoegsel</td>
                <td><?=$user["prefix"]?></td>
            </tr>
            <tr>
                <td>Achternaam</td>
                <td><?=$user["last_name"];?></td>
            </tr>
            <tr>
                <td>Rol</td>
                <td><?=$user["role"]?></td>
            </tr>
        </tbody>
    </table>
</fieldset>

<?php include("../base/footer.php"); ?>
