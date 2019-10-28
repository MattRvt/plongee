<?php


class controllerGetNbPlongeurPlongee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getNbPlongeur();
        }
    }

    public function getNbPlongeur()
    {
        $date = $_POST["date"];
        $moment = $_POST["moment"];

        require_once('model/modelPalanquee.php');
        $reader = new modelPlongee();
        $count = $reader->getNbPersonne($date, $moment);
        echo $count["count(*)"];
    }
}