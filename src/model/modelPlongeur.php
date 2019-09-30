<?php


class modelPlongeur extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_plongeur');
    }

    public function addPersonne($PER_NUM,$APT_CODE)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `plo_plongeur`(`PER_NUM`, `APT_CODE`) VALUES (:PER_NUM,:APT_CODE)");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':APT_CODE', $APT_CODE);

        $res = $statement->execute();
        return $res;
    }
}