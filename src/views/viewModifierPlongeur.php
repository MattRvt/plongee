<?php
$num = $_GET["param"];
require_once ('model/modelPersonne.php');
?>
Numero d'identification : <?php $Personne = $this->controller->selectPersonne($num); //Apres recup $_POST['PER_NUM'] et echo
            $numPersonne = $Personne['PER_NUM'];
            echo $numPersonne."<br/>" ;?>
Nom : <?php $nomPersonne = $Personne['PER_NOM'];
            echo "<input type=\"text\" value =".$nomPersonne." id=\"nom\"/> <br/>" ;?>
Prénom : <?php $prenomPersonne = $Personne['PER_PRENOM'];
            echo "<input type=\"text\" value =".$prenomPersonne." id=\"prenom\"/> <br/>" ;?> <br/>
<?php
$instancePersonne = new modelPersonne();
$Plonger = $instancePersonne->isPlongeur($numPersonne);
if (!empty($Plonger)){
    echo 'Aptitude :';
    $Plongeur = $this->controller->selectPlongeur($numPersonne);
    $aptitudePlongeur = $Plongeur['APT_CODE'];
    echo $aptitudePlongeur .'<br/>';
}?>
