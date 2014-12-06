<div class="pure-g-r">
	<div class="pure-u-1">
	<ul class="breadcrumb">
		<li><a href="<?=site_url('');?>">Home</a> </li>
		<?php foreach ($breadcrumb as $link): ?>
			<li>&raquo; <a href="<?=site_url($link['url'])?>"> <?=$link['title'];?></a></li>
		<?php endforeach; ?>
	</ul>
	</div>
</div>