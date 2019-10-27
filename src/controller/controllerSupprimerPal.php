<?php


class controllerSupprimerPal
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->supprimerPal();
        }
    }

    function supprimerPal()
    {
        $date = $_POST["date"];
        $moment = $_POST["moment"];
        $num = $_POST["num"];

        $reader = new modelPalanquee();
        $reader->deletePalanquee($date,$moment,$num);
    }
}