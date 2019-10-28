<?php

class controllerAjoutDataEmbarcation
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->ajoutDataEmbarcation();
        }
    }

    public function ajoutDataEmbarcation()
    {
        $writer = new modelEmbarcation();

        $nom = $_POST["nom"];
        $writer->addEmbarcation($nom);
    }
}