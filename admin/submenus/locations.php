<?php session_start(); ?>
<ul>
	<li><a href="../locations"><i class="fa fa-locations"></i> Locaties</a></li>
	<?php if($_SESSION["user"]["role_id"] == 1): ?>
		<li><a href="add.php"><i class="fa fa-plus"></i> Toevoegen</a></li>
	<?php endif; ?>
</ul>