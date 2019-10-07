<?php


class modelPlongeur extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_plongeur');
    }

    public function get($numPersonne)
    {
        return $this->getBdd()->query("select * from PLO_PLONGEUR where PLO_NUM = $numPersonne");
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