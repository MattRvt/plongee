<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Creer une palanquée</title>
	    <script></script>
  </head>
  <body>
	<form name="palanquee" action= "" method="post" enctype="multipart/form-data">
		<fieldset>
		<legend><b>Créer une palanquée</b></legend>
		<br />
		<label for="date">Date : </label><input type="date" name="date" size="30" maxlength="50" ><br />
        <select name="seance" size="1">
		    <option value="">------</option>
		    <option value="Matin">Matin</option>
		    <option value="Apres-Midi">Après-midi</option>
		    <option value="Soir">Soir</option>
        </select>
        <label for="lieu">Lieu de la plongée : </label><input type="text" name="lieu" ><br />
        <select name="embarcation" size="1">
            <option value="">------</option>
		    <option value="beclem">Beclem</option>
		    <option value="estelenn">Estelenn</option>
		</select>
        <label for="effectifPlongeurs">Effectif de plongeurs : </label><input type="number" name="effectifPlongeurs"><br />
        <label for="effectifBateau">Effectif du bateau : </label><input type="number" name="effectifBateau"><br />
		<label for="directeurPlongee">Directeur de plongée : </label><input type="text" name="directeurPlongee" > <br />
        <label for="securiteSurface">Sécurité de surface : </label><input type="text" name="securiteSurface" > <br />
		<br />	   
	  </fieldset>
        <br />
		<input type="submit" name="EN" value="Envoyer" onclick="return testerValid()"> 		&nbsp;&nbsp;&nbsp;
        <br />
	  <br />	  
	</form>
  </body>
</html>
