<div class="genModal modal" id="siteModal">
    <div class="modal-content">
        <legend><b id="titreAjoutModifSite"></b></legend>

        <div id="numSite"></div>

        <div>
            <h6>Nom : </h6>
            <label>
                <input type="text" id="nomSite" name="nomSite" min="0" required><br />
            </label>
        </div>

        <div>
            <h6>Localisation : </h6>
            <label>
                <input type="text" id="localisationSite" name="localisationSite" min="0" required><br />
            </label>
        </div>

        <a class="waves-effect waves-light btn-large modal-trigger" onclick="traitementSite()">Valider</a>

        <div class="erreur" id="erreurSite"></div>
    </div>
</div>
