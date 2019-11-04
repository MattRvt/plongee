<?php


class controllerGetEtatPlongee
{

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getDataPlongee();
        }
    }

    function getDataPlongee()
    {
        $date = $_POST["date"];
        $moment = $_POST["moment"];

        $reader = new modelPlongee();
        $etat = $reader->getEtat($date,$moment);

        echo $etat;
    }
}