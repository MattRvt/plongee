<form name="palanquee" action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><b>Ajouter une personne</b></legend>
        <br/>
        <label for="nom">Nom: </label><input type="text" name="nom" size="30" maxlength="50"><br/>
        <label for="prenom">Prenom: </label><input type="text" name="Prénom" size="30" maxlength="50"><br/>
        <label for="aptitude">Aptitude: </label>
        <select id="aptitude">
            <option value="">--Please choose an option--</option>
            <?php

            $aptitude = selectAptiude();
            foreach ($aptitude as $item) {
                $labelle = $item[0];
                $code = $item[1];
                $option = "<option value=\"" . $code + "\">" . $labelle . "</option>";

            }
            ?>
        </select>


    </fieldset>
    <br/>
    <input type="submit" name="EN" value="Ajouter" onclick="return testerValid()"> &nbsp;&nbsp;&nbsp;
    <br/>
    <br/>
</form>