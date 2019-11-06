<?php


class controllerFicheSecurite
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->FicheSecurite();
        }
    }

    private function FicheSecurite()
    {
        $this->_view = require_once("views/FicheSecurite.php");
    }

}