<?php 
	require_once ("Header.php");
	include ("util.php");
?>
<form name="palanquee" action= "traitementPalanquee.php" method="post" enctype="multipart/form-data">
		<fieldset>
		<legend><b>Créer une palanquée</b></legend>
		<br />
		<label for="date">Date : </label><input type="date" name="datePalanquee" size="30" maxlength="50" <?php verifierRempli("date");?>><br />
        <select name="seance" size="1">
		    <option value="" <?php VerifSelectSeance("seance","rien"); ?>>------</option>
		    <option value="matin" <?php VerifSelectSeance("seance","matin"); ?>>Matin</option>
		    <option value="apres-Midi" <?php VerifSelectSeance("seance","apres-midi")?>>Après-midi</option>
		    <option value="soir" <?php VerifSelectSeance("seance","apres-misoirdi")?>>Soir</option>
        </select>
        <label for="lieu">Lieu de la plongée : </label><input type="text" name="lieu" placeholder="Lieu?" <?php verifierRempli("lieu");?>><br />
        <select name="embarcation" size="1">
            <option value="" <?php VerifSelectEmbarcation("embarcation","rien"); ?>>------</option>
		    <option value="beclem" <?php VerifSelectEmbarcation("embarcation","beclem"); ?>>Beclem</option>
		    <option value="estelenn" <?php VerifSelectEmbarcation("embarcation","estelem"); ?>>Estelenn</option>
		</select>
        <label for="effectifPlongeurs">Effectif de plongeurs : </label><input type="number" name="effectifPlongeurs" <?php verifierRempli("effectifPlongeurs");?>><br />
        <label for="effectifBateau">Effectif du bateau : </label><input type="number" name="effectifBateau" <?php verifierRempli("effectifBateau");?>><br />
		<label for="directeurPlongee">Directeur de plongée : </label><input type="text" name="directeurPlongee" placeholder="directeur de plongée?" <?php verifierRempli("directeurPlongee");?>> <br />
        <label for="securiteSurface">Sécurité de surface : </label><input type="text" name="securiteSurface" placeholder="sécurité de surface?" <?php verifierRempli("securiteSurface");?>> <br />
		<br />	   
	  </fieldset>
        <br />
		<input type="submit" name="EN" value="Envoyer" onclick="return testerValid()"> 		&nbsp;&nbsp;&nbsp;
        <br />
	  <br />	  
	</form>
<?php require_once ("Footer.php");?>

