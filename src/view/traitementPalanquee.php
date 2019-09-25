<?php
$erreur = true;
if ( !empty($_POST ))	
{
	echo"<pre>";
	print_r($_POST);
	echo "</PRE>";
	echo "décodage sur le serveur <br />";
	  
	$erreur = false;
	if (!empty($_POST['date']) 
    $date = $_POST['date'];  
	else 
	{
		echo "la date n'est pas renseignée <br />";
		$erreur = true;
	}
	if (isset($_POST['seance']) ) 
		$pays = $_POST['seance'];  
	else 
	{
		echo "la séance n'a pas été sélectionné <br />";
		$erreur = true;
    }
    if (!empty($_POST['lieu']) && $_POST['lieu'] != "") 
    $lieu = $_POST['lieu'] ; 
    else 
    {
        echo "le lieu est vide <br />";
        $erreur = true;
    }
    if (isset($_POST['embarcation']) ) 
		$embarcation = $_POST['embarcation'];  
	else 
	{
		echo "l'embarcation' n'a pas été sélectionné <br />";
		$erreur = true;
	}
	if (!empty($_POST['discret']) ) 	
		$val = $_POST['discret'];
			
	if ($erreur == false)
	{
        echo "date : $date <br />";
        echo "séance : $seance <br />";
        echo "lieu : $lieu <br />";
        echo "embarcation : $embarcation <br />";
		echo "CIVILITE : $civ <br />";
		echo "PAYS : $pays <br />";
	}
}
if ($erreur == true)
{
	include ("util.php");
	include ("palanquee.php")	 ;
}
?>