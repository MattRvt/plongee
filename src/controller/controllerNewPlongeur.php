<?php

class controllerNewPlongeur extends controller
{

    private $num;
    private $nom;
    private $prenom;
    private $aptitude;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            echo "1111";
            $this->num = $this->getNewNum();
            $this->nom = $_POST["nom"];
            $this->prenom = $_POST["prenom"];

            if (!empty($_POST["personne"])) {
                echo "222222";
                $this->addPersonne();
            }
            if (!empty($_POST["plongeur"])) {
                echo "333333";
                $this->aptitude = $_POST["aptitude"];
                $this->addPlongeur();
            }
            if (!empty($_POST["directeur"])) {
                echo "444444";
                $this->addDirecteur();
            }
            if (!empty($_POST["securiteSurface"])) {
                echo "555555";
                $this->addSecuriteSurface();
            }
        }
    }

    public function getNewNum()
    {
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $lastPlongeur = $reader->getLastPlongeur();
        return $lastPlongeur[0]++;
    }

    public function addPersonne()
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader->addPersonne($this->num, $this->nom, $this->prenom);
    }

    public function addPlongeur()
    {
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $reader->addPlongeur($num, $this->aptitude);
    }

    public function addDirecteur()
    {
        require_once('model/modelDirecteur.php');
        $reader = new modelDirecteur();
        $reader->addDirecteur($this->num);
    }

    public function addSecuriteSurface()
    {
        require_once('model/modelSecuriteSurface.php');
        $reader = new modelSecuSurface();
        $reader->addSecuriteSurface($this->num);
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

    public function traitementFormulaire()
    {
        $erreur = true;
        if (!empty($_POST)) {
            $erreur = false;

            if (isset($_POST['nom']) && $_POST['nom'] != "")
                $nom = $_POST['nom'];
            else {
                echo "le nom n'est pas renseignée <br />";
                $erreur = true;
            }

            if (isset($_POST['prenom']) && $_POST['prenom'] != "")
                $prenom = $_POST['prenom'];
            else {
                echo "le prénom n'a pas été sélectionné <br />";
                $erreur = true;
            }

            if (isset($_POST['fonction']) && ($_POST['fonction'] != 'rien'))
                $fonction = $_POST['fonction'];
            else {
                echo "la fonction n'est pas renseignée <br />";
                $erreur = true;
            }

            if (isset($_POST['aptitude']) && ($_POST['aptitude'] != 'rien'))
                $aptitude = $_POST['aptitude'];
            else {
                echo "l'aptitude n'est pas renseignée <br />";
                $erreur = true;
            }


            if ($erreur == false) {
                echo "nom : $nom <br />";
                echo "prenom : $prenom <br />";
                echo "fonction : $fonction <br />";
                echo "aptitude : $aptitude <br />";
            }
        }
        if ($erreur == true) {
            include("../views/viewAjouterPlongeur.php");
        } else {
            echo "Vous avez bien été enregistré! <br/>";
        }
    }


}

?>