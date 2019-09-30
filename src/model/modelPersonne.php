<?php


class modelPersonne extends model
{
    public function addPersonne($PER_NOM,$PER_PRENOM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `plo_personne`(`PER_NOM`, `PER_PRENOM`) VALUES (:PER_NOM,:PER_PRENOM)");

        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);

        $res = $statement->execute();
        return $res;
    }
}