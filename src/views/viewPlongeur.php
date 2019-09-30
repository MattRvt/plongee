<form name="palanquee" action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><b>Ajouter une personne</b></legend>
        <br/>
        <label for="nom">Nom: </label><input type="text" name="nom" size="30" maxlength="50" placeholder="Nom" value="<?php verifierRempli("nom");?>"><br/>
        <label for="prenom">Prenom: </label><input type="text" name="prenom" size="30" maxlength="50" placeholder="Prénom" value="<?php verifierRempli("prenom");?>" ><br/>
         <label for="fonction">Fonction<label
        <label for="aptitude">Aptitude: </label>
        <select id="aptitude">
            <option value="">--Please choose an option--</option>
            <?php
            require_once('../controller/controllerPlongeur.php');
            $controller = new ControllerPlongeur;
            $aptitude = $controller->selectAptiude();
            foreach ($aptitude as $item) {
                $label = $item[0];
                $code = $item[1];
                $option = "<option value=\"" . $code . $label . "</option>";
            }
            ?>
        </select>


    </fieldset>
    <br/>
    <input type="submit" name="EN" value="Ajouter" onclick="return testerValid()"> &nbsp;&nbsp;&nbsp;
    <br/>
    <br/>
</form>