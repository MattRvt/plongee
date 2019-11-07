<?php

class controllerSupprimerPlongee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->supprimerPlon();
        }
    }

    function supprimerPlon()
    {
        $date = $_POST["date"];
        $moment = $_POST["moment"];;

        $reader = new modelConcerner();
        $reader->deletebyMomentDate($date,$moment);

        $reader = new modelPalanquee();
        $reader->deletePalanqueeByDateMoment($date,$moment);

        $reader = new modelPlongee();
        $reader->deletebyMomentDate($date,$moment);
    }
}
