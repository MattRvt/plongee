<?php $this->_title = "Plongée" ?>
    <form name="plongee" action="controller/traitementPlongeur" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><b>plongee</b></legend>
            <br/>
            <label for="date">Date: </label><input type="date" name="date" size="30" maxlength="50" placeholder="Nom"
                                                   value="<?php verifierRempli("date"); ?>"><br/>
            <label for="directeurDePlongee">Directeur de plongée: </label><input type="text" name="directeurDePlongee"
                                                                                 size="30" maxlength="50"
                                                                                 value="<?php verifierRempli("directeurDePlongee"); ?>"><br/>
            <label for="siteNom">nom du site: </label><input type="text" name="siteNom" size="30" maxlength="50"
                                                             value="<?php verifierRempli("siteNom"); ?>"><br/>
            <label for="effectifs">effectifs: </label><br/>
            <label for="nomSecuriteDeSurface">sécurité de surface: </label><input type="text"
                                                                                  name="nomSecuriteDeSurface" size="30"
                                                                                  maxlength="50"
                                                                                  value="<?php verifierRempli("nomSecuriteDeSurface"); ?>"><br/>
            <label for="observation">observation: </label><br/>
            <label for="meteoEtMaree">météo et marée: </label><input type="text" name="meteoEtMaree" size="30"
                                                                     maxlength="50"
                                                                     value="<?php verifierRempli("meteoEtMaree"); ?>"><br/>
        </fieldset>
        <fieldset>
            <legend><b>données prévu</b></legend>
            <label for="hDepart">heure de départ: </label><input type="text" name="hDepart" size="30" maxlength="50"
                                                                 value="<?php verifierRempli("hDepart"); ?>"><br/>
            <label for="tpsPervu">temps prévu: </label><input type="text" name="tpsPervu" size="30" maxlength="50"
                                                              value="<?php verifierRempli("tpsPervu"); ?>"><br/>
            <label for="profondeurPrevu">nom du site: </label><input type="text" name="siteNom" size="30" maxlength="50"
                                                                     value="<?php verifierRempli("profondeurPrevu"); ?>"><br/>
        </fieldset>
        <fieldset>
            <legend><b>données realisé</b></legend>
            <label for="hArrivee">heure d'arrivé: </label><input type="text" name="hArrivee" size="30" maxlength="50"
                                                                 value="<?php verifierRempli("hArrivee"); ?>"><br/>
            <label for="tpsRealise">temps réalisé: </label><input type="text" name="tpsRealise" size="30" maxlength="50"
                                                              value="<?php verifierRempli("tpsRealise"); ?>"><br/>
            <label for="profondeurRealise">profondeur réalisé: </label><input type="text" name="profondeurRealise" size="30" maxlength="50"
                                                                     value="<?php verifierRempli("profondeurRealise"); ?>"><br/>
        </fieldset>
        <-- liste des palanquées -->
    </form>

<?php
function verifierRempli($n)
{
    if (isset($_POST[$n])) {
        $var = $_POST[$n];
        if ($var <> "")
            echo $var;
    } else
        echo "";
}

function VerifSelectAptitude($n)
{
    if (isset($_POST["seance"])) {
        if ($_POST["seance"] == $n)
            echo "selected";
    }
}

function VerifSelectFonction($n)
{
    if (isset($_POST["fonction"])) {
        if ($_POST["fonction"] == $n)
            echo "selected";
    }
}

?>