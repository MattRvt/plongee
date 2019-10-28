<?php


class controllerUpdateDataAptitude
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->ajoutDataAptitude();
        }
    }

    public function ajoutDataAptitude()
    {
        $writer = new modelAptitude();

        $code = $_POST["newCode"];
        $libelle = $_POST["libelle"];

        $writer->updateAptitude($code,$libelle);
    }
}