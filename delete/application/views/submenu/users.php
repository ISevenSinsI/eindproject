<ul>
	<li><a href="users/"><i class="fa fa-users"></i> Gebruikers</a></li>
	<? if(is_authorized("users::add")): ?>
		<li><a href="users/add"><i class="fa fa-plus"></i> Toevoegen</a></li>
	<? endif; ?>
</ul>