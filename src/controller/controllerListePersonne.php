<?php


class controllerListePersonne
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listPersonne();
        }
    }

    public function listPersonne()
    {
        $this->_view = new View('ListePersonne');
        $this->_view->generate(array(), $this);
        echo "<script type='text/javascript'>update()</script>";
    }
}