<ul>
	<li><a href="../users"><i class="fa fa-users"></i> Gebruikers</a></li>
	<? if($_SESSION["user"]["role_id"] == 1): ?>
		<li><a href="add.php"><i class="fa fa-plus"></i> Toevoegen</a></li>
	<? endif; ?>
</ul>