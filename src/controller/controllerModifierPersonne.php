<?php


class controllerModifierPersonne  extends controller
{
    private $num;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->modifPersonne();
        }
    }

    public function modifPersonne()
    {
        if (!empty($_POST["personne"])){
            $this->num = $_POST['num'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateCertif = $_POST['dateCertif'];
            $active = $_POST['active'];
            if($active == "true")
            {
                $active = 1;
            }
            else
            {
                $active = 0;
            }
            $this->modifierPersonne($nom, $prenom, $dateCertif, $active);
        }

        if (!empty($_POST["plongeur"])) {
            $aptitude = $_POST["aptitude"];
            $this->modifierPlongeur($aptitude);
        }
        else
        {
            $this->modifierPlongeur(-1);
        }

        if (!empty($_POST["directeur"])) {
            $this->modifierDirecteur(1);
        }
        else
        {
            $this->modifierDirecteur(-1);
        }

        if (!empty($_POST["securiteSurface"])) {
            $this->modifierSecuSurface(1);
        }
        else{
            $this->modifierSecuSurface(-1);
        }
    }

    public function modifierSecuSurface($bool)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader -> modifySecuSurface($this->num, $bool);
    }

    public function modifierDirecteur($bool)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader -> modifyDirecteur($this->num, $bool);
    }

    public function modifierPlongeur($aptitude)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader -> modifyPlongeur($this->num,$aptitude);
    }

    public function modifierPersonne($nom, $prenom, $dateCertif, $active)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader -> modifyPersonne($this->num, $nom, $prenom, $dateCertif, $active);

    }

    public function changeEtatPersonne($val)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $reader -> statePersonne($this->num, $val);
    }
}