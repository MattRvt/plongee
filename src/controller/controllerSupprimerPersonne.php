<?php


class controllerSupprimerPersonne
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->deletePerson();
        }
    }

    public function deletePerson()
    {
        $num = $_POST['num'];
        $pl = $_POST['plongeur'];
        $dir = $_POST['directeur'];
        $secu = $_POST['secusurf'];

        if ($pl){
            $readerpl = new modelPlongeur();
            $readerpl->deletePlongeur($num);
        }
        if ($dir){
            $readerdir = new modelDirecteur();
            $readerdir->deleteDirecteur($num);
        }
        if ($secu){
            $readersecu = new modelSecuSurface();
            $readersecu->deleteSecuSurface($num);
        }

        $readerpers = new modelPersonne();
        $readerpers->deletePersonne($num);
    }
}