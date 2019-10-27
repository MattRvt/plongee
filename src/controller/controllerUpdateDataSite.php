<?php


class controllerUpdateDataSite
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->modifierPalanquee();
        }
    }

    public function modifierPalanquee()
    {
        $writer = new modelSite();

        $num = $_POST["num"];
        $nom = $_POST["nom"];
        $localisation = $_POST["localisation"];

        $writer->updateSite($num, $nom, $localisation);
    }
}