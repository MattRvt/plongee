<form name="palanquee" action="controller/traitementPlongeur" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><b>Ajouter une personne</b></legend>
        <br/>
        <label for="nom">Nom: </label><input type="text" name="nom" size="30" maxlength="50" placeholder="Nom"
                                             value="<?php $this->controller->verifierRempli("nom"); ?>"><br/>
        <label for="prenom">Prenom: </label><input type="text" name="prenom" size="30" maxlength="50"
                                                   placeholder="Prénom" value="<?php $this->controller->verifierRempli("prenom"); ?>"><br/>
        <label for="fonction">Fonction<label>
                <select id="fonction">
                    <option value="rien">--Please choose an option--</option>
                    <option value="plongeur" <?php $this->controller->VerifSelectFonction("fonction", "plongeur"); ?>>Plongeur</option>
                    <option value="directeur" <?php $this->controller->VerifSelectFonction("fonction", "directeur"); ?>>Directeur</option>
                    <option value="securiteSurface" <?php $this->controller->VerifSelectFonction("fonction", "securiteSurface"); ?>>
                        Sécurité de surface
                    </option>
                </select><br/>
                <label for="aptitude">Aptitude: </label>
                <select id="aptitude">
                    <?php echo $this->controller->selectAptitude(); ?>
                </select>
    </fieldset>
    <br/>
    <input type="submit" name="EN" value="Envoyer" onclick="return testerValid()">
    <br/>
    <br/>
</form>