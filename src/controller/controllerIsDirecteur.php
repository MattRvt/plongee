<?php


class controllerIsDirecteur
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->isDirecteur();
        }
    }

    function isDirecteur()
    {
        $num = $_POST["num"];

        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $directeur = $reader->isDirecteur($num);

        echo !empty($directeur);
    }
}
