<?php
require_once("controller/controllerNewPalanquee.php");
$controller = new controllerNewPalanquee();
?>
<div class="modal" id="newPalanqueeModal">
    <div class="modal-content">
        <form>
            <legend><b>Créer une palanquée</b></legend>
		    <br />
		    <label for="date">Date : </label><input type="date" name="datePalanquee" size="30" maxlength="50" value="<?php verifierRempli("date");?>"><br />
            <select name="seance" size="1">
		    	<option value="rien">--Please choose an option--</option>
		        <option value="matin" <?php VerifSelectSeance("seance","matin"); ?>>Matin</option>
		        <option value="apres-Midi" <?php VerifSelectSeance("seance","apres-midi")?>>Après-midi</option>
		        <option value="soir" <?php VerifSelectSeance("seance","soir")?>>Soir</option>
            </select><br/>
            <label for="lieu">Lieu de la plongée : </label><input type="text" name="lieu" placeholder="Lieu?" value="<?php verifierRempli("lieu");?>"><br />
            <select name="embarcation" size="1"> 
		    	<option value="rien">--Please choose an option--</option>
		        <option value="beclem" <?php VerifSelectEmbarcation("embarcation","beclem"); ?>>Beclem</option>
		        <option value="estelenn" <?php VerifSelectEmbarcation("embarcation","estelem"); ?>>Estelenn</option>
		    </select><br/>
            <label for="effectifPlongeurs">Effectif de plongeurs : </label><input type="number" name="effectifPlongeurs" value="<?php verifierRempli("effectifPlongeurs");?>" min="2" max="5"><br />
            <label for="effectifBateau">Effectif du bateau : </label><input type="number" name="effectifBateau" value="<?php verifierRempli("effectifBateau");?>" min="4" max="7"><br />
		    <label for="directeurPlongee">Directeur de plongée : </label><input type="text" name="directeurPlongee" placeholder="directeur de plongée?" value="<?php verifierRempli("directeurPlongee");?>"> <br />
            <label for="securiteSurface">Sécurité de surface : </label><input type="text" name="securiteSurface" placeholder="sécurité de surface?" value="<?php verifierRempli("securiteSurface");?>"> <br />
		    <br />	   
            <br />
		    <input type="submit" name="EN" value="Envoyer" onclick="return testerValid()"> 		&nbsp;&nbsp;&nbsp;
        </form>
        <div id="erreur"></div>
    </div>
</div>