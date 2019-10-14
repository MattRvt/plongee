<?php

class modelSecuSurface extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_securite_de_surface');
    }

    public function addSecuriteSurface($PER_NUM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_SECURITE_DE_SURFACE`(`PER_NUM`) VALUES (:PER_NUM)");

        $statement->bindParam(':PER_NUM', $PER_NUM);

        $res = $statement->execute();
        return $res;
    }
}