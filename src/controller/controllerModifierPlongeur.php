<?php

class controllerModifierPlongeur  extends controller
{
    public function selectPlongeur($numPersonne)
    {
        require_once('model/modelPlongeur.php');
        $reader = new modelPlongeur();
        $plongeur = $reader->get($numPersonne);
        return $plongeur;
    }

    public function selectPersonne($numPersonne)
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $personne = $reader->getAll();
    return $personne[$numPersonne];
    }

}
?>