<?php
    // $a = actie
    if($page_title == 'Gebruikers Toevoegen'){
        $a = 'add';
    }else{
        $a = 'edit';
    }

?>


<div class="pure-g-r">
    <div class="pure-u-1 tabs">
        <span id="tab1" class="active" >Algemeen</span>
    </div>
</div>

<form method="post" action="users/save/">

<fieldset data-tab="tab1">
    <table class="pure-table pure-table-bordered pure-table-striped pure-form">
        <thead>
            <tr>
                <th>Gegevens</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?=($a) == 'add' ? '' : $user["email"]?>" required /></td>
            </tr>
            <tr>
                <td>Naam</td>
                <td><input type="text" name="name" value="<?=($a) == 'add' ? '' : $user["name"]?>" required /></td>
            </tr>
            <tr>
                <td>Rol</td>
                <td>
                    <select name="role_id">
                        <?php foreach($roles as $role): ?>
                        <?php $selected = @($role["id"] == $user["role_id"]) ? "selected" : ""; ?>
                        <option value="<?=$role["id"]?>" <?=$selected?>><?=$role["name"]?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Telefoon</td>
                <td><input type="text" name="phone" value="<?=($a) == 'add' ? '' : $user["phone"]?>" required /></td>
            </tr>
            <tr>
                <td>Woonplaats</td>
                <td><input type="text" name="city" value="<?=($a) == 'add' ? '' : $user["city"]?>" required /></td>
            </tr>
            <tr>
                <td>Adres</td>
                <td><input type="text" name="address" value="<?=($a) == 'add' ? '' : $user["address"]?>" required /></td>
            </tr>
            <tr>
                <td>Postcode</td>
                <td><input type="text" name="zipcode" value="<?=($a) == 'add' ? '' : $user["zipcode"]?>" required /></td>
            </tr>
            <tr>
                <td>Land</td>
                <td><input type="text" name="country" value="<?=($a) == 'add' ? '' : $user["country"]?>" required/></td>
            </tr>
            <?php if($a != "add"): ?>
                <tr>
                    <td>Wachtwoord</td>
                    <td>
                        <a href="users/password/<?=$user["id"]?>" class="pure-button pure-button-primary pure-button-small" title="Wachtwoord wijzigen">
                            Wachtwoord aanpassen <i class="fa fa-lock"></i>
                        </a>
                  </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td><input type="hidden" name="id" value="<?=($a) == 'add' ? '' : $user["id"]?>" /></td>
                <td><input type="submit" class="pure-button  pure-button-primary" value="Opslaan" /></td>
            </tr>
        </tbody>
    </table>
</fieldset>

</form>