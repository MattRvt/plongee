<?php

class controllerNewPlongeur extends controller
{
    public  function selectAptitude()
    {
        $reader = new modelAptitude();
        echo $this->listeDeroulante($reader, "APT_LIBELLE","APT_CODE");
    }

    public function getLastNum(){
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $lastPlongeur = $reader->getLastPlongeur();
        return $lastPlongeur[0]++;
    }

    public function addPersonnePlongeur($num, $nom, $prenom, $aptitude){
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader->addPersonnePlongeur($num, $nom, $prenom);
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $reader->addPlongeur($num, $aptitude);
    }

    public function addPersonneDirecteur($num, $nom, $prenom, $aptitude){
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader->addPersonne($num, $nom, $prenom);
        require_once('model/modelDirecteur.php');
        $reader = new modelDirecteur();
        $reader->addDirecteur($num);
    }

    public function addPersonneSecuriteSurface($num, $nom, $prenom, $aptitude){
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader->addPersonne($num, $nom, $prenom);
        require_once('model/modelSecuriteSurface.php');
        $reader = new modelSecuriteSurface();
        $reader->addSecuriteSurface($num);
    }

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
        if (isset($_POST["aptitude"])) {
            if ($_POST["aptitude"] == $n)
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

    public function traitementFormulaire(){
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
                echo "le prénom n'a pas été sélectionné <br />";
                $erreur = true;
            }
        
            if (isset($_POST['fonction']) && ($_POST['fonction'] != 'rien')) 
                $fonction = $_POST['fonction'] ; 
            else 
            {
                echo "la fonction n'est pas renseignée <br />";
                $erreur = true;
            }
        
            if (isset($_POST['aptitude']) && ($_POST['aptitude'] != 'rien')) 
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
            include("../views/viewAjouterPlongeur.php");
        } else {
            echo "Vous avez bien été enregistré! <br/>";
        }
    }
    
    
    }
    
    ?>