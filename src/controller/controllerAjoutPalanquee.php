<?php

class controllerAjoutPalanquee
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
        $date = $_POST["date"];
        $moment = $_POST["moment"];
        $profMax = $_POST["profMax"];
        $durMax = $_POST["durMax"];

        $writer = new modelPalanquee();

        $writer->addPalanque($date,$moment,$profMax,$durMax);
    }
}