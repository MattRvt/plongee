<?php
/*$num = $_GET["param"]; // faire vérif en JS pour les champs
require_once ('model/modelPersonne.php');
?>
<form id="send" onsubmit="return verifSubmit()" method="post" >
    Numero d'identification : <?php $Personne = $this->controller->selectPersonne($num); //Apres recup $_POST['PER_NUM'] et echo
                $numPersonne = $Personne['PER_NUM'];
                echo $numPersonne."<br/>" ;
                echo "<input type=\"hidden\" value =".$numPersonne."  id=\"num\" name=\"num\"/> <br/>" ;?>
    Nom : <?php if (isset($_POST['nom'])){
        $nomPersonne = $_POST['nom'];
    } else {
        $nomPersonne = $Personne['PER_NOM'];
    }
    echo "<input type=\"text\" value =\"".$nomPersonne."\" class=\"inputBox\" id=\"nom\" name=\"nom\" onkeyup=\"validation(0)\" onfocusout='unfocus(\"nom\")' autocomplete='off'/> <br/>" ;
    echo "<span id = \"spannom\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(0)</script></span>";?>
    Prénom : <?php if (isset($_POST['prenom'])){
        $prenomPersonne = $_POST['prenom'];
    } else {
        $prenomPersonne = $Personne['PER_PRENOM'];
    }
    echo "<input type=\"text\" value =\"".$prenomPersonne."\" class=\"inputBox\" id=\"prenom\" name=\"prenom\" onkeyup=\"validation(1)\" onfocusout='unfocus(\"prenom\")' autocomplete='off' /> <br/>" ;
    echo "<span id = \"spanprenom\" class=\"red-text text-darken-2\"><script type=\"text/javascript\">afficheErreur(1)</script></span>";?> <br/>
    <?php
    $instancePersonne = new modelPersonne();
    $Plonger = $instancePersonne->isPlongeur($numPersonne);
    if (!empty($Plonger)){
        echo 'Aptitude : ';
        $Plongeur = $this->controller->selectPlongeur($numPersonne);
        $aptitudePlongeur = $Plongeur['APT_CODE'];
        echo $aptitudePlongeur .'<br/>';
    }?>
    <input type="submit" value="Modifier" name="modifier"/>
    <input type="submit" value=<?php  if ($Personne['PER_ACTIVE']==0) {
        echo "\"Activer\"";
    }
    else {
        echo "\"Désactiver\"";
    }?> name="etat"/>

</form>*/



