<?php

class modelSecuSurface extends model
{
    public function addPersonne($PER_NUM)
    {
        $statement = $this->getBdd()->prepStatement("INSERT INTO `plo_securite_de_surface`(`PER_NUM`) VALUES (:PER_NUM)");

        $statement->bindParam(':PER_NUM', $PER_NUM);

        $res = $this->getBdd()->execStatement($statement);
        return $res;
    }
}