<?php
require_once("controller/controllerNewPlongeur.php");
$controller = new controllerNewPlongeur();
?>
<div class="modal" id="newPlongeurModal">
    <div class="modal-content">
        <form>
            <legend><b>Ajouter une personne</b></legend>
            <br/>

            <h6 for="nom">Nom: </h6><input type="text" id="nom" name="nom" size="30" maxlength="50" placeholder="Nom"
                                                 value="<?php $controller->verifierRempli("nom"); ?>" required><br/>
            <h6 for="prenom">Prenom: </h6><input type="text" id="nom" name="prenom" size="30" maxlength="50"
                                                       placeholder="Prénom"
                                                       value="<?php $controller->verifierRempli("prenom"); ?>" required><br/>
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

            <input type="submit" name="EN" value="Envoyer" onclick="addPersonne()">
        </form>
        <div id="erreur"></div>
    </div>
</div>
