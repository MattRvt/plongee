<?php
$numPalanquee = $_GET["param"]; // faire vérif en JS pour les champs
require_once ('model/modelPalanquee.php');
?>
<form id="send" onsubmit="return verifSubmit()" method="post" >
    Numero d'identification : <?php $palanquee = $this->controller->selectPalanquee($numPalanquee); //Apres recup $_POST['PAL_NUM'] et echo
                $numPalanquee = $palanquee['PAL_NUM'];
                echo $numPalanquee.'<br/>';
                //echo "<input type=\"number\" value =".$numPalanquee."  id=\"num\" name=\"num\"/> <br/>" ;?>
    

    Date : <?php if (isset($_POST['date'])){
        $datePalanquee = $_POST['date'];
    } else {
        $datePalanquee = $palanquee['PLO_DATE'];
    }
    echo "<input type=\"date\" value =".$datePalanquee." class=\"inputBox\" id=\"date\" name=\"date\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"date\")'/> <br/>" ;
    echo "<span id = \"spandate\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>
    

    Séance : <?php if (isset($_POST['seance'])){
        $seancePalanquee = $_POST['seance'];
    } else {
        $seancePalanquee = $palanquee['PLO_MAT_MID_SOI'];
    }
    ?>
    <select>
        <option value="m" <?php if($palanquee['PLO_MAT_MID_SOI'] == "m"){echo "selected";}?>>Matin</option>
        <option value="A" <?php if($palanquee['PLO_MAT_MID_SOI'] == "A"){echo "selected";}?>>Apres-Midi</option>
        <option value="s" <?php if($palanquee['PLO_MAT_MID_SOI'] == "s"){echo "selected";}?>>Soir</option>
    </select>
    

    Profondeur maximum : <?php if (isset($_POST['profondeurMax'])){
        $profondeurMaxPalanquee = $_POST['profondeurMax'];
    } else {
        $profondeurMaxPalanquee = $palanquee['PAL_PROFONDEUR_MAX'];
    }
    echo "<input type=\"number\" value =".$profondeurMaxPalanquee." class=\"inputBox\" id=\"profondeurMax\" name=\"profondeurMax\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"profondeurMax\")'/> <br/>" ;
    echo "<span id = \"spanprofondeurMax\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>


    Durée maximum : <?php if (isset($_POST['dureeMax'])){
        $dureeMaxPalanquee = $_POST['dureeMax'];
    } else {
        $dureeMaxPalanquee = $palanquee['PAL_DUREE_MAX'];
    }
    echo "<input type=\"number\" value =".$dureeMaxPalanquee." class=\"inputBox\" id=\"dureeMax\" name=\"dureeMax\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"dureeMax\")'/> <br/>" ;
    echo "<span id = \"spanDureeMax\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>


    Heure d'immersion : <?php if (isset($_POST['heureImmersion'])){
        $heureImmersionPalanquee = $_POST['heureImmersion'];
    } else {
        $heureImmersionPalanquee = $palanquee['PAL_HEURE_IMMERSION'];
    }
    echo "<input type=\"time\" value =".$heureImmersionPalanquee." class=\"inputBox\" id=\"heureImmersion\" name=\"heureImmersion\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"heureImmersion\")'/> <br/>" ;
    echo "<span id = \"spanHeureImmersion\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>


    Heure de sortie de l'eau : <?php if (isset($_POST['heureSortieEau'])){
        $heureSortieEauPalanquee = $_POST['heureSortieEau'];
    } else {
        $heureSortieEauPalanquee = $palanquee['PAL_HEURE_SORTIE_EAU'];
    }
    echo "<input type=\"time\" value =".$heureSortieEauPalanquee." class=\"inputBox\" id=\"heureSortieEau\" name=\"heureSortieEau\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"heureSortieEau\")'/> <br/>" ;
    echo "<span id = \"spanHeureSortieEau\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>


    Profondeur réelle : <?php if (isset($_POST['profondeurReelle'])){
        $profondeurReellePalanquee = $_POST['profondeurReelle'];
    } else {
        $profondeurReellePalanquee = $palanquee['PAL_PROFONDEUR_REELLE'];
    }
    echo "<input type=\"number\" value =".$profondeurReellePalanquee." class=\"inputBox\" id=\"profondeurReelle\" name=\"profondeurReelle\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"profondeurReelle\")'/> <br/>" ;
    echo "<span id = \"spanProfondeurReelle\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>

    Durée au fond : <?php if (isset($_POST['dureeFond'])){
        $dureeFondPalanquee = $_POST['dureeFond'];
    } else {
        $dureeFondPalanquee = $palanquee['PAL_DUREE_FOND'];
    }
    echo "<input type=\"number\" value =".$dureeFondPalanquee." class=\"inputBox\" id=\"dureeFond\" name=\"dureeFond\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"dureeFond\")'/> <br/>" ;
    echo "<span id = \"spanDureeFond\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>


    <?php
    $instancePalanquee = new modelPalanquee();
    $palanquee = $instancePalanquee->isPlongeur($numPersonne);
    if (!empty($Plonger)){
        echo 'Aptitude : ';
        $Plongeur = $this->controller->selectPlongeur($numPersonne);
        $aptitudePlongeur = $Plongeur['APT_CODE'];
        echo $aptitudePlongeur .'<br/>';
    }?>
    <input type="submit" value="Modifier" name="modifier"/>
</form>
