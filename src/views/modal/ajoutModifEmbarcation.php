<div class="aesModal modal" id="embarcationModal">
    <div class="modal-content">
        <legend><b id="titreAjoutModifEmbarcation"></b></legend>

        <div id="numEmbarcation"></div>

        <div>
            <h6>Nom : </h6>
            <label>
                <input type="text" id="nomEmbarcation" name="nomEmbarcation" required><br />
            </label>
        </div>

        <button class="green waves-effect waves-light btn" type="submit" name="EN" onclick="traitementEmbarcation()"><i class="material-icons right">send</i>Valider</button>

        <div class="erreur" id="erreurEmbarcation"></div>
    </div>
</div>
