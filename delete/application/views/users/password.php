<form method="post" action="users/save_password/">

    <table class="pure-table pure-table-bordered pure-table-striped pure-form">
        <thead>
            <tr>
                <th>Gegevens</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Wachtwoord</td>
                <td><input type="password" name="password" value="" required/></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?= $user["id"] ?>" />
                <input type="submit" class="pure-button  pure-button-primary" value="Opslaan" /></td>
            </tr>
        </tbody>
    </table>

</form>