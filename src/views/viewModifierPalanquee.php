<?php
$numPalanquee = $_GET["param"]; // faire vérif en JS pour les champs
require_once ('model/modelPalanquee.php');
?>

<form id="send" action="ListePalanquee"  method="post" >
    Numero d'identification : <?php $palanquee = $this->controller->selectPalanquee($numPalanquee); //Apres recup $_POST['PAL_NUM'] et echo
                $numPalanquee = $palanquee['PAL_NUM'];
                echo $numPalanquee.'<br/>';
                echo "<input type=\"hidden\" value =".$numPalanquee."  id=\"numPalanquee\" name=\"numPalanquee\"/> <br/>" ;?>

    Date : <?php if (isset($_POST['date'])){
        $datePalanquee = $_POST['date'];
    } else {
        $datePalanquee = $palanquee['PLO_DATE'];
    }
    echo "<input type=\"date\" value =".$datePalanquee." class=\"inputBox\" id=\"datePalanquee\" name=\"datePalanquee\"  <br/>";
    echo $datePalanquee; ?>

    Séance : <?php if (isset($_POST['seance'])){
        $seancePalanquee = $_POST['seance'];
    } else {
        $seancePalanquee = $palanquee['PLO_MAT_MID_SOI'];
    }
    ?>
    <select name="seancePalanquee">
        <option value="m" <?php if($palanquee['PLO_MAT_MID_SOI'] == "m"){echo "selected";}?>>Matin</option>
        <option value="A" <?php if($palanquee['PLO_MAT_MID_SOI'] == "A"){echo "selected";}?>>Apres-Midi</option>
        <option value="s" <?php if($palanquee['PLO_MAT_MID_SOI'] == "s"){echo "selected";}?>>Soir</option>
    </select>
    

    Profondeur maximum : <?php if (isset($_POST['profondeurMax'])){
        $profondeurMaxPalanquee = $_POST['profondeurMax'];
    } else {
        $profondeurMaxPalanquee = $palanquee['PAL_PROFONDEUR_MAX'];
    }
    echo "<input type=\"number\" value =".$profondeurMaxPalanquee." class=\"inputBox\" id=\"profondeurMaxPalanquee\" name=\"profondeurMaxPalanquee\"  <br/>";?>


    Durée maximum : <?php if (isset($_POST['dureeMax'])){
        $dureeMaxPalanquee = $_POST['dureeMax'];
    } else {
        $dureeMaxPalanquee = $palanquee['PAL_DUREE_MAX'];
    }
    echo "<input type=\"number\" value =".$dureeMaxPalanquee." class=\"inputBox\" id=\"dureeMaxPalanquee\" name=\"dureeMaxPalanquee\"  <br/>";?>


    Heure d'immersion : <?php if (isset($_POST['heureImmersion'])){
        $heureImmersionPalanquee = $_POST['heureImmersion'];
    } else {
        $heureImmersionPalanquee = $palanquee['PAL_HEURE_IMMERSION'];
    }
    echo "<input type=\"time\" value =".$heureImmersionPalanquee." class=\"inputBox\" id=\"heureImmersionPalanquee\" name=\"heureImmersionPalanquee\"  <br/>";?>


    Heure de sortie de l'eau : <?php if (isset($_POST['heureSortieEau'])){
        $heureSortieEauPalanquee = $_POST['heureSortieEau'];
    } else {
        $heureSortieEauPalanquee = $palanquee['PAL_HEURE_SORTIE_EAU'];
    }
    echo "<input type=\"time\" value =".$heureSortieEauPalanquee." class=\"inputBox\" id=\"heureSortieEauPalanquee\" name=\"heureSortieEauPalanquee\"  <br/>";?>


    Profondeur réelle : <?php if (isset($_POST['profondeurReelle'])){
        $profondeurReellePalanquee = $_POST['profondeurReelle'];
    } else {
        $profondeurReellePalanquee = $palanquee['PAL_PROFONDEUR_REELLE'];
    }
    echo "<input type=\"number\" value =".$profondeurReellePalanquee." class=\"inputBox\" id=\"profondeurReellePalanquee\" name=\"profondeurReellePalanquee\"  <br/>";?>

    Durée au fond : <?php if (isset($_POST['dureeFond'])){
        $dureeFondPalanquee = $_POST['dureeFond'];
    } else {
        $dureeFondPalanquee = $palanquee['PAL_DUREE_FOND'];
    }
    echo "<input type=\"number\" value =".$dureeFondPalanquee." class=\"inputBox\" id=\"dureeFondPalanquee\" name=\"dureeFondPalanquee\"  <br/>";?>

    <input type="submit" value="Modifier" name="modifier"/>

</form>
