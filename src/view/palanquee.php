<?php require_once ("Header.php");?>
<form name="palanquee" action= "" method="post" enctype="multipart/form-data">
		<fieldset>
		<legend><b>Créer une palanquée</b></legend>
		<br />
		<label for="date">Date : </label><input type="date" name="date" size="30" maxlength="50" <?php verifierRempli("date");?>><br />
        <select name="seance" size="1">
		    <option value="" <?php VerifSelect("seance","rien"); ?>>------</option>
		    <option value="matin" <?php VerifSelect("seance","matin"); ?>>Matin</option>
		    <option value="apres-Midi" <?php VerifSelect("seance","apres-midi")?>>Après-midi</option>
		    <option value="soir" <?php VerifSelect("seance","apres-misoirdi")?>>Soir</option>
        </select>
        <label for="lieu">Lieu de la plongée : </label><input type="text" name="lieu" <?php verifierRempli("lieu");?>><br />
        <select name="embarcation" size="1">
            <option value="" <?php VerifSelect("embarcation","rien"); ?>>------</option>
		    <option value="beclem" <?php VerifSelect("embarcation","beclem"); ?>>Beclem</option>
		    <option value="estelenn" <?php VerifSelect("embarcation","estelem"); ?>>Estelenn</option>
		</select>
        <label for="effectifPlongeurs">Effectif de plongeurs : </label><input type="number" name="effectifPlongeurs" <?php verifierRempli("effectifPlongeurs");?>><br />
        <label for="effectifBateau">Effectif du bateau : </label><input type="number" name="effectifBateau" <?php verifierRempli("effectifBateau");?>><br />
		<label for="directeurPlongee">Directeur de plongée : </label><input type="text" name="directeurPlongee" <?php verifierRempli("directeurPlongee");?>> <br />
        <label for="securiteSurface">Sécurité de surface : </label><input type="text" name="securiteSurface" <?php verifierRempli("securiteSurface");?>> <br />
		<br />	   
	  </fieldset>
        <br />
		<input type="submit" name="EN" value="Envoyer" onclick="return testerValid()"> 		&nbsp;&nbsp;&nbsp;
        <br />
	  <br />	  
	</form>
<?php require_once ("Footer.php");?>

