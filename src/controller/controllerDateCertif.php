<?php


class controllerDateCertif
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getDateCertif();
        }
    }

    function getDateCertif()
    {
        $num = $_POST["num"];

        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $plongeur = $reader->getPersonneByNum($num);

        echo $plongeur["PER_DATE_CERTIF_MED"];
    }
}
