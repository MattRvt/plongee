<?php
require_once("controller/controllerNewPlongeur.php");
$controller = new controllerNewPlongeur();
?>
<div class="modal" id="newPlongeurModal">
    <div class="modal-content">
        <form>
            <legend><b>Ajouter une personne</b></legend>
            <br/>

            <label for="nom">Nom: </label><input type="text" id="nom" name="nom" size="30" maxlength="50" placeholder="Nom"
                                                 value="<?php $controller->verifierRempli("nom"); ?>" required><br/>
            <label for="prenom">Prenom: </label><input type="text" id="nom" name="prenom" size="30" maxlength="50"
                                                       placeholder="Prénom"
                                                       value="<?php $controller->verifierRempli("prenom"); ?>" required><br/>

            <label for="fonction">Fonction</label>
            <select id="fonction">
                <option value="rien">--Please choose an option--</option>
                <option value="plongeur" <?php $controller->VerifSelectFonction("fonction", "plongeur"); ?>>
                    Plongeur
                </option>
                <option value="directeur" <?php $controller->VerifSelectFonction("fonction", "directeur"); ?>>
                    Directeur
                </option>
                <option value="securiteSurface" <?php $controller->VerifSelectFonction("fonction", "securiteSurface"); ?>>
                    Sécurité de surface
                </option>
            </select><br/>

            <label for="aptitude">Aptitude: </label>
            <select id="aptitude">
                <option value="">--Please choose an option--</option>
                <?php
                $aptitude = $controller->selectAptitude();
                ?>
            </select>

            <input type="submit" name="EN" value="Envoyer" onclick="addPersonne()">
        </form>
        <div id="erreur"></div>
    </div>
</div>