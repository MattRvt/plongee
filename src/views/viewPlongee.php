<?php $this->_title = "Plongée" ?>
<form name="plongee" method="post" enctype="multipart/form-data">
    <h3 class="center-align">Plongée</h3><br>
    <div class="row">
        <div class="col offset-s1 s3">
            <label for="date">Date: </label>
            <input type="date" name="date"
                   min="<?php echo date("Y-m-d"); ?>"
                   value=<?php $this->controller->verifierRempliPrimaire("date"); ?>
            ><br/>
        </div>
        <div class="col offset-s1 s2">
            <label for="moment">Moment: </label>
            <select name="moment" <?php $this->controller->selectIsDisabledPrimaire("moment") ?> >
                <?php $this->controller->selectMoment() ?>
            </select>
            <br/>
        </div>
        <div class="col  offset-s1 s3">
            <label for="siteNom">Nom du site: </label>
            <select name="site" <?php $this->controller->selectIsDisabled("site") ?> >
                <?php $this->controller->selectSite() ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s10 offset-s1">
            <label for="directeurDePlongee">Directeur de plongée: </label>
            <select name="directeurDePlongee" <?php $this->controller->selectIsDisabled("directeurDePlongee") ?>>
                <?php $this->controller->selectDirecteurDePlongee() ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s10 offset-s1">
            <label for="securiteDeSurface">Sécurite de surface: </label> <br/>
            <select name="securiteDeSurface" <?php $this->controller->selectIsDisabled("securiteDeSurface") ?>>
                <?php $this->controller->selectSecuriteDeSurface() ?>
            </select>
        </div>

    </div>
    <div class="row">
        <div class="col s10 offset-s1">
            <label for="embarcation">Embarcation: </label>
            <select name="embarcation" <?php $this->controller->selectIsDisabled("embarcation") ?>>
                <?php $this->controller->selectEmbarcation() ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s3 offset-s3">
            <p>État : <?php $this->controller->etat() ?></p>
        </div>
        <div class="col s3 offset-s1">
            <p id="effectifs">
            </p>
        </div>
    </div>


    <table class="centered" id="listePalanque" border="1"></table>

    <br/>
    <div class="row" id="btnAjout"></div>
    <a class='waves-effect waves-light btn' onclick="printExternal('FicheSecurite')">imprimer</a>

    <div class="row">
        <div class="col s1 offset-s4">
            <input type="submit" class="btn green" value="Enregistrer plongée">
        </div>
        <div class="col s1 offset-s1">
            <input type="button" class="btn red" value="Annuler" onclick="window.location.href='ListePlongee'"><br/>
        </div>
    </div>
</form>

