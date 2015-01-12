<?php session_start(); ?>
<div class="menu-item first">
    <div class="menu-item-inner">
        <a class="pure-button secondary-button" href="../users/overview.php">
            <i class="fa fa-users fa-2x"></i>
            <p>Gebruikers</p>
        </a>
    </div>
</div>

<?php if($_SESSION["user"]["role_id"] < 3): ?>
    <div class="menu-item first">
        <div class="menu-item-inner">
            <a class="pure-button secondary-button" href="../locations/overview.php">
                <i class="fa fa-globe fa-2x"></i>
                <p>Locaties</p>
            </a>
        </div>
    </div>
<?php endif; ?>

<div class="menu-item first">
    <div class="menu-item-inner">
        <a class="pure-button secondary-button" href="../stock/">
            <i class="fa fa-inbox fa-2x"></i>
            <p>Voorraad</p>
        </a>
    </div>
</div>

<?php if($_SESSION["user"]["role_id"] < 3): ?>
<div class="menu-item first">
    <div class="menu-item-inner">
        <a class="pure-button secondary-button" href="../factories/overview.php">
            <i class="fa fa-building-o fa-2x"></i>
            <p>Fabrieken</p>
        </a>
    </div>
</div>
<?php endif; ?>

<?php if($_SESSION["user"]["role_id"] < 3): ?>
<div class="menu-item first">
    <div class="menu-item-inner">
        <a class="pure-button secondary-button" href="../reports/overview.php">
            <i class="fa fa-files-o fa-2x"></i>
            <p>Rapportages</p>
        </a>
    </div>
</div>
<?php endif; ?>

<div class="menu-item last">
    <div class="menu-item-inner">
        <a class="pure-button secondary-button" href="../logout.php">
            <i class="fa fa-sign-out fa-2x"></i>
            <p>Uitloggen</p>
        </a>
    </div>
</div>