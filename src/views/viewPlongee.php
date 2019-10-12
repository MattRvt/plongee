<?php $this->_title = "Plongée" ?>
<form name="plongee" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><b>plongee</b></legend>
        <label for="date">Date: </label>
        <input type="date" name="date" size="30"
               value="<?php $this->controller->verifierRempli("date"); ?>"
        ><br/>
        <label for="directeurDePlongee">Directeur de plongée: </label>
        <input type="text" name="directeurDePlongee" size="30" maxlength="50"
               value="<?php $this->controller->verifierRempli("directeurDePlongee"); ?>"

        ><br/>
        <label for="siteNom">nom du site: </label>

        <select id="fonction">
            <?php $this->controller->listeDeroulante("table","raw") ?>
        </select>

        <br/>
        <label for="effectifs">effectifs: </label> <--calc auto--> <br/>
        <label for="nomSecuriteDeSurface">sécurité de surface: </label>
        <input type="text"
               name="nomSecuriteDeSurface" size="30"
               maxlength="50"
               value="<?php $this->controller->verifierRempli("nomSecuriteDeSurface"); ?>"
        ><br/>
        <label for="observation">observation: </label> <--probablement inutile --> <br/>
        <label for="meteoEtMaree">météo et marée: </label>
        <input type="text" name="meteoEtMaree" size="30"
               maxlength="50"
               value="<?php $this->controller->verifierRempli("meteoEtMaree"); ?>"
        ><br/>
    </fieldset>
    <fieldset>
        <legend><b>données prévu</b></legend>
        <label for="hDepart">heure de départ: </label>
        <input type="text" name="hDepart" size="30" maxlength="50" value="<?php $this->controller->verifierRempli("hDepart"); ?>"
        ><br/>
        <label for="tpsPervu">temps prévu: </label>
        <input type="text" name="tpsPervu" size="30" maxlength="50" value="<?php $this->controller->verifierRempli("tpsPervu"); ?>"
        ><br/>
        <label for="profondeurPrevu">profondeur prévu </label>
        <input type="text" name="profondeurPrevu" size="30" maxlength="50" value="<?php $this->controller->verifierRempli("profondeurPrevu"); ?>"
        ><br/>
    </fieldset>
    <fieldset>
        <legend><b>données realisé</b></legend>
        <label for="hArrivee">heure d'arrivé: </label><input type="text" name="hArrivee" size="30" maxlength="50" value="<?php $this->controller->verifierRempli("hArrivee"); ?>"
        ><br/>
        <label for="tpsRealise">temps réalisé: </label><input type="text" name="tpsRealise" size="30" maxlength="50" value="<?php $this->controller->verifierRempli("tpsRealise"); ?>"
        ><br/>
        <label for="profondeurRealise">profondeur réalisé: </label><input type="text" name="profondeurRealise" value="<?php $this->controller->verifierRempli("profondeurRealise"); ?>"
                                                                          size="30" maxlength="50"
        ><br/>
    </fieldset>
    <-- liste des palanquées -->
    <fieldset>
        <legend><b>enregistrer:</b></legend>
        <input type="submit" alue="enregistrer"><br/>
        <input type="button" value="annuler" onclick="window.location.href='Acceuil'"><br/>
    </fieldset>
</form>

