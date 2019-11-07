<div class="aesModal modal" id="siteModal">
    <div class="modal-content">
        <legend><b id="titreAjoutModifSite"></b></legend>

        <div id="numSite"></div>

        <div>
            <h6>Nom : </h6>
            <label>
                <input type="text" id="nomSite" name="nomSite" required><br />
            </label>
        </div>

        <div>
            <h6>Localisation : </h6>
            <label>
                <input type="text" id="localisationSite" name="localisationSite" required><br />
            </label>
        </div>

        <button class="green waves-effect waves-light btn" type="submit" name="EN" onclick="traitementSite()"><i class="material-icons right">send</i>Valider</button>

        <div class="erreur" id="erreurSite"></div>
    </div>
</div>
