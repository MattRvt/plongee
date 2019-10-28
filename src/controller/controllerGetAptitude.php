<?php


class controllerGetAptitude
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->aptitude();
        }
    }

    function aptitude()
    {
        $num = $_POST["num"];

        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $plongeur = $reader->get($num);

        echo $plongeur["APT_CODE"];
    }
}