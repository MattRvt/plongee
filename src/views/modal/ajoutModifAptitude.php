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

        <button class="green waves-effect waves-light btn" type="submit" name="EN" onclick="traitementAptitude()"><i class="material-icons right">send</i>Valider</button>

        <div class="erreur" id="erreurAptitude"></div>
    </div>
</div>
