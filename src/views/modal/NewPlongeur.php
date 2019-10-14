<?php
require_once ("controller/controllerNewPlongeur.php");
$controller = new controllerNewPlongeur();
?>
<div class="modal" id="newPlongeurModal">
    <div class="modal-content">
        <form name="plongeur" action="../controller/controllerNewPlongeur" method="post" enctype="multipart/form-data">
                <legend><b>Ajouter une personne</b></legend>
                <br/>

                <label for="nom">Nom: </label><input type="text" name="nom" size="30" maxlength="50" placeholder="Nom" value="<?php $controller->verifierRempli("nom");?>"><br/>
                <label for="prenom">Prenom: </label><input type="text" name="prenom" size="30" maxlength="50" placeholder="Prénom" value="<?php $controller->verifierRempli("prenom");?>" ><br/>

                <label for="fonction">Fonction<label>
                        <select id="fonction">
                            <option value="rien">--Please choose an option--</option>
                            <option value="plongeur" <?php $controller->VerifSelectFonction("fonction","plongeur"); ?>>Plongeur</option>
                            <option value="directeur" <?php $controller->VerifSelectFonction("fonction","directeur"); ?>>Directeur</option>
                            <option value="securiteSurface" <?php $controller->VerifSelectFonction("fonction","securiteSurface"); ?>>Sécurité de surface</option>
                        </select><br/>

                        <label for="aptitude">Aptitude: </label>
                        <select id="aptitude">
                            <option value="">--Please choose an option--</option>
                            <?php
                                $aptitude = $this->controller->selectAptitude();
                            ?>
                        </select>
            <br />
            <input type="submit" name="EN" value="Envoyer" onclick="return testerValid()">
        </form>
    </div>
</div>