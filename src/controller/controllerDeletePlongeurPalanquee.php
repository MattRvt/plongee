<?php


class controllerDeletePlongeurPalanquee
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

        $writer = new modelConcerner();

        $writer->deletePersonne($date,$moment,$palNum);
    }
}