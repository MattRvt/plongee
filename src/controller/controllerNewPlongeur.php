<?php

class controllerNewPlongeur extends controller
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->mentions();
        }
    }

    public function mentions()
    {
        $this->_view = new View('NewPlongeur');
        $this->_view->generate(array(),$this);
    }
    
    public function selectAptitude()
    {
        require_once('model/modelAptitude.php');
        $reader = new modelAptitude();
        $aptitude = $reader->getAll();
        return $aptitude;
    }

    public function getLastNum(){
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $lastPlongeur = $reader->getLastPlongeur();
        return $lastPlongeur[0];
    }

    public function addPlongeurPersonne($aptitude){
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $num = $reader->getLastNum;
        $reader->addPlongeur($num, $aptitude);
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader->addPersonne($num, $nom, $prenom);
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