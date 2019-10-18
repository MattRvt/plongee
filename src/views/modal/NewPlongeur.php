<div class="modal" id="newPlongeurModal">
    <div class="modal-content"">
        <div >
            <a href="#" onclick="closeModal('newPlongeur')"><img src="views/image/icone_fermer.png" alt=""></a>
        </div>
        <legend><b>Ajouter une personne</b></legend>
        <br/>

        <h6 for="nom">Nom: </h6><input type="text" id="nom" name="nom" size="30" maxlength="50" placeholder="Nom" onkeyup="validation(0)"
                                       onfocusout="unfocus('nom')" autocomplete='off'><br/>
        <h6 for="prenom">Prenom: </h6><input type="text" id="prenom" name="prenom" size="30" maxlength="50" placeholder="Prénom" onkeyup="validation(1)"
                                             onfocusout="unfocus('prenom')" autocomplete='off'><br/>
        <h6>Date du certificat médicale :</h6><input type="date" id="date">

        <h6>Fonction </h6>

        <label>
            <input type="checkbox" id="Plongeur" onclick="selectAptitude()"/>
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
        <div class="erreur" id="erreurN"></div>
        <div class="erreur" id="erreurP"></div>
        <div class="erreur" id="erreur"></div>
    </div>
</div>
