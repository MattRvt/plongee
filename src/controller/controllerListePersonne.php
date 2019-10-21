<?php


class controllerListePersonne  extends controller
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
        if (!empty($_POST['modifier'])){
            $id = $_POST['num'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $this->modifierPersonne($id, $nom, $prenom);
        }
        else if (!empty($_POST['etat'])){
            $id = $_POST['num'];
            $_POST['etat']=="Activer" ? $val = 1 : $val = 0;
            $this->changeEtatPersonne($id, $val);
        }
        $this->_view = new View('ListePersonne');
        $this->_view->generate(array(), $this);
    }


    public function modifierPersonne($id, $nom, $prenom)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $modify = $reader -> modifyPersonne($id, $nom, $prenom);
        return $modify;
    }

    public function changeEtatPersonne($id,$val)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $supp = $reader -> statePersonne($id, $val);
        return $supp;
    }
}