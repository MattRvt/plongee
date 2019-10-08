<?php

class controllerListPersonne
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
        $this->_view = new View('ListPersonne');
        $this->_view->generate(array(), $this);
    }

    public function selectAllNonPlongeur()
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPlongeur();
        $plongeur = $reader->getAll();
        return $plongeur;
    }
}