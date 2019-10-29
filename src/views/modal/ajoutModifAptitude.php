<div class="aesModal modal" id="aptitudeModal">
    <div class="modal-content">
        <legend><b id="titreAjoutModifAptitude"></b></legend>

        <div>
            <h6>CODE : </h6>
            <label>
                <div id="aptCode"></div>
            </label>
        </div>

        <div>
            <h6>Libelle : </h6>
            <label>
                <input type="text" id="libelleAptitude" name="libelleAptitude" required><br />
            </label>
        </div>

        <a class="waves-effect waves-light btn-large" onclick="traitementAptitude()">Valider</a>

        <div class="erreur" id="erreurAptitude"></div>
    </div>
</div>
