<?php
if(!isset($_SESSION["user"])){
	session_start();
}
?>
<ul>
	<?php if($_SESSION["user"]["role_id"] < 3): ?>
		<li><a href="overview.php"><i class="fa fa-tag"></i> Artikelen</a></li>
	<?php endif; ?>

	<?php if($_SESSION["user"]["role_id"] == 1): ?>
		<li><a href="add.php"><i class="fa fa-plus"></i> Toevoegen</a></li>
	<?php endif; ?>
	<li><a href="search_stock.php"><i class="fa fa-search"></i> Zoeken</a></li>
</ul>