<?php $this->_title = "Plongée" ?>
<form name="plongee" id="formPlongee" method="post">

    <h3 class="center-align">Plongée</h3><br>
    <div class="row">
        <div class="col offset-s1 s3">
            <label for="date">Date: </label>
            <input type="text" class="datepicker datepickerd" id="date" name="date"
                   value=<?php $this->controller->verifierRempliPrimaire("date"); ?>
            ><br/>
        </div>
        <div class="col offset-s1 s2">
            <label for="moment">Moment: </label>
            <select class="browser-default" id="moment" name="moment" <?php $this->controller->selectIsDisabledPrimaire("moment") ?> >
                <?php $this->controller->selectMoment() ?>
            </select>
            <br/>
        </div>
        <div class="col  offset-s1 s3">
            <label for="siteNom">Nom du site: </label>
            <select class="browser-default" id="site" name="site" <?php $this->controller->selectIsDisabled("site") ?> >
                <?php $this->controller->selectSite() ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s10 offset-s1">
            <label>Directeur de plongée: </label>
            <select class="browser-default" id='directeurDePlongee' name='directeurDePlongee' onchange="initDirecteurSecurite()"></select>
        </div>
    </div>

    <div class="row">
        <div class="col s10 offset-s1">
            <label>Sécurite de surface: </label> <br/>
            <select class="browser-default" id='securiteDeSurface' name='securiteDeSurface' onchange="initDirecteurSecurite()"></select>
        </div>

    </div>
    <div class="row">
        <div class="col s10 offset-s1">
            <label for="embarcation">Embarcation: </label>
            <select class="browser-default" id="embarcation" name="embarcation" <?php $this->controller->selectIsDisabled("embarcation") ?>>
                <?php $this->controller->selectEmbarcation() ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s3 offset-s3">
            <div id="etatPlong"><?php $this->controller->etat(0) ?></div>
        </div>
        <div class="col s3 offset-s1">
            <p id="effectifs">
            </p>
        </div>
    </div>
    <input type="hidden" id="hidEtat" name="etat" value="<?php $this->controller->etat(1) ?>">

    <table class="centered" id="listePalanque" border="1"></table>

    <br/>
    <div class="row" id="btnAjout"></div>

    <div class="row">
        <div id="enrPlongee" class="col s1 offset-s4"></div>
        <div class="col s1 offset-s1">
            <input type="button" class="btn red" value="Annuler" onclick="window.location.href='ListePlongee'"><br/>
        </div>
    </div>
</form>

