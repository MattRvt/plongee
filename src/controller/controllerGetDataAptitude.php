<?php

class controllerGetDataAptitude
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getDataAptitude();
        }
    }

    function getDataAptitude()
    {
        $code = $_POST["code"];

        $reader = new modelAptitude();
        $aptitude = $reader->getDataByCode($code);

        echo $aptitude["APT_CODE"]."|".$aptitude["APT_LIBELLE"];
    }
}