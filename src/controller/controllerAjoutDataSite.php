<?php

class controllerAjoutDataSite
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->ajoutDataSite();
        }
    }

    public function ajoutDataSite()
    {
        $writer = new modelSite();

        $nom = $_POST["nom"];
        $localisation = $_POST["localisation"];

        $writer->addSite($nom, $localisation);
    }
}