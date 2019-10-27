<?php

class controllerGetPlongeurPal
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getNom();
        }
    }

    function getNom()
    {
        $date = $_POST["date"];
        $moment = $_POST["moment"];
        $num = $_POST["num"];

        $reader = new modelPalanquee();
        $plongeur = $reader->getPlongeur($date,$moment,$num);

        foreach ($plongeur as $key => $contents)
        {
            echo "|".$contents["PER_NUM"]." ".$contents["PER_NOM"]." ".$contents["PER_PRENOM"];
        }
    }
}