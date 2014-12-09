<ul>
	<li><a href="../products"><i class="fa fa-tag"></i> Artikelen</a></li>
	<? if($_SESSION["user"]["role_id"] == 1): ?>
		<li><a href="add.php"><i class="fa fa-plus"></i> Toevoegen</a></li>
	<? endif; ?>
</ul>