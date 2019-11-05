<div class="genModal modal" id="newPlongeurModal">
    <div class="modal-content">
        <div class="row">
            <div class="col s3">
                <legend><b id="modfiAjout"></b></legend>
            </div>
                <a href="#" onclick="closeModal('newPlongeur')" style="float: right">
                    <i class="material-icons">close</i>
                </a>
        </div>

        <div class="row">
            <div class="col s6">
                <h6>Nom: </h6>
                <label>
                    <input type="text" id="nomPlongeur" name="nom" size="30" maxlength="50" placeholder="Nom" onkeyup="validation(0)" onfocusout="unfocus('nomPlongeur')" autocomplete='off'>
                </label>
            </div>
            <div class="col s6">
                <h6>Prenom: </h6>
                <label>
                    <input type="text" id="prenomPlongeur" name="prenom" size="30" maxlength="50" placeholder="Prénom" onkeyup="validation(1)" onfocusout="unfocus('prenomPlongeur')" autocomplete='off'>
                </label>
            </div>
        </div>


        <h6>Est actif</h6>
        <label>
            <input type="radio" name="active" id="estActive" value="1">
            <span>Oui</span>
        </label>
        <label>
            <input type="radio" name="active" id="pasActive" value="0">
            <span>Non</span>
        </label>

        <div class="input-field">
            <input name="certif" type="text" class="datepicker" id="date">
            <label for="date">Date du certificat médical :</label>
        </div>

        <h6>Fonction </h6>

        <label>
            <input type="checkbox" id="Plongeur" checked="checked" onclick="selectAptitude()" />
            <span>Plongeur</span>
        </label>

        <br/>
        <label>
            <input type="checkbox" id="Directeur"/>
            <span>Directeur</span>
        </label>

        <br/>
        <label>
            <input type="checkbox" id="SecuriteSurface"/>
            <span>Securite de Surface</span>
        </label>

        <div id="selectAptitude" class="input-field col s12"></div>

        <input type="submit" name="EN" onclick="addPersonne()">
        <div id="supprime"></div>
        <div class="erreur" id="erreurN"></div>
        <div class="erreur" id="erreurP"></div>
        <div class="erreur" id="erreur"></div>
    </div>
</div>
