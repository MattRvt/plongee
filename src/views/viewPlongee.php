<?php $this->_title = "Plongée" ?>
<form name="plongee" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><b>plongee</b></legend>
        <label for="date">Date: </label>
        <input type="date" name="date"
               value="<?php $this->controller->verifierRempli("date"); ?>"
        ><br/>
        <label for="date">moment: </label>
        <select name="moment" value="<?php $this->controller->verifierRempli("moment"); ?>">
            <?php $this->controller->selectMoment() ?>
        </select>
        <br/>
        <label for="directeurDePlongee">Directeur de plongée: </label>
        <select name="directeurDePlongee">
            <?php $this->controller->selectDirecteurDePlongee() ?>
        </select><br/>
        <label for="siteNom">nom du site: </label>

        <select name="site" value="<?php $this->controller->verifierRempli("site"); ?>">
            <?php $this->controller->selectSite() ?>
        </select>

        <br/>
        <label for="effectifs">effectifs: </label> <--calc auto--> <br/>
        <label for="securiteDeSurface">securite de surface: </label> <br/>
        <select name="securiteDeSurface">
            <?php $this->controller->selectSecuriteDeSurface() ?>
        </select><br/>
        <label for="embarcation">embarcation: </label>
        <select name="embarcation">
            <?php $this->controller->selectEmbarcation() ?>
        </select><br/>

        <label for="etat">etat; </label>
        <input type="text" name="etat" size="30"
               maxlength="50"
               value="<?php $this->controller->verifierRempli("etat"); ?>"
        ><br/>
    </fieldset>
    <fieldset>

        <div id="listePalanque"></div>

        <br/><br/>
    </fieldset>
    <br/><br>

    <div id="btnAjout"></div>
    <fieldset>
        <legend><b>enregistrer:</b></legend>
        <input type="submit" value="enregistrer"><br/>
        <input type="button" value="annuler" onclick="window.location.href='Accueil'"><br/>
    </fieldset>
</form>

