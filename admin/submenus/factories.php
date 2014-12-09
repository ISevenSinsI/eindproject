<ul>
	<li><a href="../factories"><i class="fa fa-building-o"></i> Fabrieken</a></li>
	<? if($_SESSION["user"]["role_id"] == 1): ?>
		<li><a href="add.php"><i class="fa fa-plus"></i> Toevoegen</a></li>
	<? endif; ?>
</ul>