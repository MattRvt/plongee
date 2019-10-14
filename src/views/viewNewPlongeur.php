<form name="plongeur" action="../controller/controllerNewPlongeur" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><b>Ajouter une personne</b></legend>
        <br/>
        <label for="nom">Nom: </label><input type="text" name="nom" size="30" maxlength="50" placeholder="Nom" value="<?php verifierRempli("nom");?>"><br/>
        <label for="prenom">Prenom: </label><input type="text" name="prenom" size="30" maxlength="50" placeholder="Prénom" value="<?php verifierRempli("prenom");?>" ><br/>
        <label for="fonction">Fonction<label>
        <select id="fonction">
            <option value="rien">--Please choose an option--</option>
            <option value="plongeur" <?php VerifSelectFonction("fonction","plongeur"); ?>>Plongeur</option>
            <option value="directeur" <?php VerifSelectFonction("fonction","directeur"); ?>>Directeur</option>
            <option value="securiteSurface" <?php VerifSelectFonction("fonction","securiteSurface"); ?>>Sécurité de surface</option>
        </select><br/>
        <label for="aptitude">Aptitude: </label>
        <select id="aptitude">
            <option value="">--Please choose an option--</option>
            <?php
            
            $aptitude = $this->controller->selectAptitude();
            foreach ($aptitude as $item) {
                $label = $item['APT_LIBELLE'];
                $code = $item['APT_CODE'];
                echo "<option value=\"" . $code ."\" <?php VerifSelectAptitude(\"aptitude\", \"" . $code . "\") ?>" . $label . "</option>";
            }
            ?>
        </select>
    </fieldset>
    <br />
	<input type="submit" name="EN" value="Envoyer" onclick="return testerValid()">
    <br />
	<br />	  
</form>

<?php
function verifierRempli($n)
{  
    if (isset($_POST[$n]))
    {
    	$var = $_POST[$n];
    	if ($var <> "")
        	echo $var; 
    }
    else 
    echo ""; 
}

function VerifSelectAptitude($n)
	{
		if (isset($_POST["aptitude"]))
		{
		  if ( $_POST["aptitude"] == $n) 
			  echo "selected";
		}
	}

function VerifSelectFonction($n)
	{
	if (isset($_POST["fonction"]))
	{
	  if ( $_POST["fonction"] == $n) 
		  echo "selected";
	}
}
?>
        <label for="nom">Nom: </label><input type="text" name="nom" size="30" maxlength="50" placeholder="Nom"
                                             value="<?php $this->controller->verifierRempli("nom"); ?>" required><br/>
        <label for="prenom">Prenom: </label><input type="text" name="prenom" size="30" maxlength="50"
                                                   placeholder="Prénom" value="<?php $this->controller->verifierRempli("prenom"); ?>" required><br/>
        <label for="fonction">Fonction<label>
                <select id="fonction">
                    <option value="rien" hidden>--Please choose an option--</option>
                    <option value="plongeur" <?php $this->controller->VerifSelectFonction("fonction", "plongeur"); ?>>Plongeur</option>
                    <option value="directeur" <?php $this->controller->VerifSelectFonction("fonction", "directeur"); ?>>Directeur</option>
                    <option value="securiteSurface" <?php $this->controller->VerifSelectFonction("fonction", "securiteSurface"); ?>>
                        Sécurité de surface
                    </option>
                </select><br/>
                <label for="aptitude">Aptitude: </label>
                <select id="aptitude">
                    <?php echo $this->controller->selectAptitude(); ?>
                </select>
    </fieldset>
    <br/>
    <input type="submit" name="EN" value="Envoyer" onclick="return testerValid()">
    <br/>
    <br/>
</form>
