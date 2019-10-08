<?php

class controllerListePersonne
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
        $this->_view = new View('ListePersonne');
        $this->_view->generate(array(), $this);
    }

    public function selectAllNonPlongeur()
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $nonPlongeur = $reader->getNonPlongeur();
        return $nonPlongeur;
    }

    public function selectAllPlongeur()
    {
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $nonPlongeur = $reader->selectPlongeurPersonne();
        return $nonPlongeur;
    }
}