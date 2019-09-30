<?php


class modelAptitude extends model
{

    public function getAll()
    {
        return $this->selectAll('plo_aptitude');
    }

    public function addPersonne($APT_CODE,$APT_LIBELLE)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `plo_aptitude`(`APT_CODE`, `APT_LIBELLE`) VALUES (:APT_CODE,:APT_LIBELLE)");

        $statement->bindParam(':APT_CODE', $APT_CODE);
        $statement->bindParam(':APT_LIBELLE', $APT_LIBELLE);

        $res = $statement->execute();
        return $res;
    }
}