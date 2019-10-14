<?php
$erreur = true;
if ( !empty($_POST ))	
{
    $erreur = false;
    
	if (isset($_POST['nom']) && $_POST['nom'] != "") 
        $nom = $_POST['nom'];  
	else 
	{
		echo "le nom n'est pas renseignée <br />";
		$erreur = true;
    }
    
	if (isset($_POST['prenom']) && $_POST['prenom'] != "") 
		$prenom = $_POST['prenom'];  
	else 
	{
		echo "le prénom n'a pas été renseigné <br />";
		$erreur = true;
    }

    if (isset($_POST['fonction'])) 
        $fonction = $_POST['fonction'] ; 
    else 
    {
        echo "la fonction n'est pas renseignée <br />";
        $erreur = true;
    }

    if (isset($_POST['aptitude']))
        $aptitude = $_POST['aptitude'] ; 
    else 
    {
        echo "l'aptitude n'est pas renseignée <br />";
        $erreur = true;
    }
    
    
	if ($erreur == false)
	{
        echo "nom : $nom <br />";
        echo "prenom : $prenom <br />";
        echo "fonction : $fonction <br />";
        echo "aptitude : $aptitude <br />";
	}
}
if ($erreur == true)
{
    include("../views/viewNewPlongeur.php");
} else {
    echo "Vous avez bien été enregistré! <br/>";
    $num = $this->controller->getLastNum();
    $this->controller->addPersonne($num, $nom, $prenom);
    if ($fonction == "plongeur")
        $this->controller->addPlongeur($num, $aptitude);
        //TODO: Faire les fonctions
    /*if ($fonction == "directeur")
        $this->controller->addPlongeur($num, $aptitude);
    if ($fonction == "securiteSurface")
        $this->controller->addPlongeur($num, $aptitude);*/
}
?>