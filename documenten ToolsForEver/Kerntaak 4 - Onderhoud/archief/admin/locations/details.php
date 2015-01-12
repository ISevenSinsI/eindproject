<?php 
	include("../base/header.php");
	require("../functions/locations.php"); 

	if(!isset($_SESSION["user"])){
        session_start();
    }

	$id = $_GET["id"];
	$location = get_location($id);
?>
<fieldset>
    <a href="edit.php?id=<?= $location['id']; ?>" class="pure-button pure-button-primary pure-button-small fright" style="float: right">
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
        		<td><?= $location["id"]; ?></td>
        	</tr>
            <tr>
                <td>Locatie</td>
                <td><?=$location["location"]?></td>
            </tr>  
            <tr>
                <td>Beschrijving</td>
                <td><?=$location["description"]?></td>
            </tr>          
        </tbody>
    </table>
</fieldset>

<?php include("../base/footer.php"); ?>
