<?php


class modelPersonne extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_personne');
    }

    public function addPersonne($PER_NOM,$PER_PRENOM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `plo_personne`(`PER_NOM`, `PER_PRENOM`) VALUES (:PER_NOM,:PER_PRENOM)");

        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);

        $res = $statement->execute();
        return $res;
    }

   public function getNonPlongeur()
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * from plo_personne where per_num not in
                (
                    select per_num from plo_plongeur
                )";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }
}