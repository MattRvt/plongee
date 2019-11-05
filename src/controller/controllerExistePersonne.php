<?php


class controllerExistePersonne
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->exist();
        }
    }

    function exist()
    {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];

        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $personne = $reader->existPersonne($nom, $prenom);

        echo $personne;
    }
}