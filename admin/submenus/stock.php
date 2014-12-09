<?php session_start(); ?>
<ul>
	<li><a href="../products"><i class="fa fa-tag"></i> Artikelen</a></li>
	<?php if($_SESSION["user"]["role_id"] == 1): ?>
		<li><a href="add.php"><i class="fa fa-plus"></i> Toevoegen</a></li>
	<?php endif; ?>
	<?php if($_SESSION["user"]["role_id"] >= 2): ?>
		<li><a href"search_stock.php"><i class="fa fa-search"></i></a></li>
	<?php endif; ?>
</ul>