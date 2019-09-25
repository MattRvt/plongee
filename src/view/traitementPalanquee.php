<?php
$erreur = true;
if ( !empty($_POST ))	
{
    $erreur = false;
    
	if (isset($_POST['datePalanquee'])) 
        $datePalanquee = $_POST['datePalanquee'];  
	else 
	{
		echo "la date n'est pas renseignée <br />";
		$erreur = true;
    }
    
	if (isset($_POST['seance'])) 
		$seance = $_POST['seance'];  
	else 
	{
		echo "la séance n'a pas été sélectionné <br />";
		$erreur = true;
    }

    if (!empty($_POST['lieu']) && $_POST['lieu'] != "") 
        $lieu = $_POST['lieu'] ; 
    else 
    {
        echo "le lieu n'est pas renseigné <br />";
        $erreur = true;
    }

    if ($_POST['embarcation'] != 'rien')
		$embarcation = $_POST['embarcation'];  
	else 
	{
		echo "l'embarcation' n'a pas été sélectionné <br />";
		$erreur = true;
    }
    
    if (!empty($_POST['effectifPlongeurs']))
        $effectifPlongeurs = $_POST['effectifPlongeurs'] ; 
    else 
    {
        echo "le nombre de plongeurs n'est pas renseigné <br />";
        $erreur = true;
    }

    if (!empty($_POST['effectifBateau'])) 
        $effectifBateau = $_POST['effectifBateau'] ; 
    else 
    {
        echo "le nombre de personnes sur le bateau n'est pas renseigné <br />";
        $erreur = true;
    }

    if (!empty($_POST['directeurPlongee']) && $_POST['directeurPlongee'] != "") 
        $directeurPlongee = $_POST['directeurPlongee'] ; 
    else 
    {
        echo "le directeur de la plongée n'est pas renseigné <br />";
        $erreur = true;
    }

    if (!empty($_POST['securiteSurface']) && $_POST['securiteSurface'] != "") 
        $securiteSurface = $_POST['securiteSurface'] ; 
    else 
    {
        echo "la sécurité de surface n'est pas renseigné <br />";
        $erreur = true;
    }
    
    
	if ($erreur == false)
	{
        echo "date : $datePalanquee <br />";
        echo "séance : $seance <br />";
        echo "lieu : $lieu <br />";
        echo "embarcation : $embarcation <br />";
		echo "effectif de plongeurs : $effectifPlongeurs <br />";
        echo "effectif du bateau : $effectifBateau <br />";
        echo "directeur de plongée : $directeurPlongee <br />";
        echo "sécurité de surface : $securiteSurface <br />";
	}
}
if ($erreur == true)
{
    include ("palanquee.php");
} else {
	echo "Votre palanquee a bien été enregistrée! <br/>";
}
?>