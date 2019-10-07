<?php

class controllerModifierPlongeur
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
        $this->_view = new View('ModifierPlongeur');
        $this->_view->generate(array(),$this);
    }

    public function selectPlongeur($numPersonne)
    {
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $plongeur = $reader->get($numPersonne);
    return $plongeur;
    }

    public function selectPersonne($numPersonne)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $personne = $reader->getAll();
    return $personne[$numPersonne];
    }

}

?>