<?php if(is_authorized("users::index")): ?>
    <div class="menu-item first">
        <div class="menu-item-inner">
            <a class="pure-button secondary-button" href="admin/users/">
                <i class="fa fa-users fa-2x"></i>
                <p>Gebruikers</p>
            </a>
        </div>
    </div>
<?php endif; ?>

<div class="menu-item last">
    <div class="menu-item-inner">
        <a class="pure-button secondary-button" href="admin/logout/">
            <i class="fa fa-sign-out fa-2x"></i>
            <p>Uitloggen</p>
        </a>
    </div>
</div>

<div class="menu-item last">
    <div class="menu-item-inner">
        <a class="pure-button secondary-button" href="admin/users/password/<?= $_SESSION['user']['id'] ?>">
            <i class="fa fa-lock fa-2x"></i>
            <p>Wachtwoord</p>
        </a>
    </div>
</div>