<?php

class modelDirecteur extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_directeur');
    }

    public function addDirecteur($PER_NUM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_DIRECTEUR`(`PER_NUM`) VALUES (:PER_NUM)");

        $statement->bindParam(':PER_NUM', $PER_NUM);

        $res = $statement->execute();
        return $res;
    }
}