<?php


class controllerUpdateDataEmbarcation
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->modifierEmbarcation();
        }
    }

    public function modifierEmbarcation()
    {
        $writer = new modelEmbarcation();

        $num = $_POST["num"];
        $nom = $_POST["nom"];

        $writer->updateEmbarcation($num, $nom);
    }
}