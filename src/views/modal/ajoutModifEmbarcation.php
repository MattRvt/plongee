<div class="genModal modal" id="embarcationModal">
    <div class="modal-content">
        <legend><b id="titreAjoutModifEmbarcation"></b></legend>

        <div id="numEmbarcation"></div>

        <div>
            <h6>Nom : </h6>
            <label>
                <input type="text" id="nomEmbarcation" name="nomEmbarcation" required><br />
            </label>
        </div>

        <a class="waves-effect waves-light btn-large modal-trigger" onclick="traitementEmbarcation()">Valider</a>

        <div class="erreur" id="erreurEmbarcation"></div>
    </div>
</div>
