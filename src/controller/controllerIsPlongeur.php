<?php


class controllerIsPlongeur
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
        $num = $_POST["num"];

        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $plongeur = $reader->isPlongeur($num);

        echo $plongeur;
    }
}