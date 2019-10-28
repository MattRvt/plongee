<?php


class controllerAjoutPlongeurPalanquee
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
        $palNum = $_POST["palnum"];
        $perNum = $_POST["pernum"];

        $writer = new modelConcerner();
        
        $writer->addPersonne($date,$moment,$palNum,$perNum);
    }
}