<?php


class controllerGetNbPlongeur
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
        $num = $_POST["num"];

        require_once('model/modelPalanquee.php');
        $reader = new modelPalanquee();
        $count = $reader->getNbPlongeur($date, $moment, $num);
        echo $count["count(*)"];
    }
}