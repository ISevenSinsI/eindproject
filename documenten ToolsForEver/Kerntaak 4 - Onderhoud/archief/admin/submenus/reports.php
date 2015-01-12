<?php
if(!isset($_SESSION["user"])){
	session_start();
}
?>
<ul>
	<?php if($_SESSION["user"]["role_id"] == 1): ?>
		<li><a href="stock_value.php"><i class="fa fa-file-o"></i> Waarde Voorraad</a></li>
		<li><a href="order_list.php"><i class="fa fa-file"></i> Bestellijst</a></li>
		<li><a href="stock.php"><i class="fa fa-file-o"></i> Voorraad</a></li>
	<?php endif; ?>
</ul>