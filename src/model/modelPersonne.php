<?php


class modelPersonne extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_personne');
    }

    public function addPersonne($PER_NOM,$PER_PRENOM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_PERSONNE`(`PER_NOM`, `PER_PRENOM`) VALUES (:PER_NOM,:PER_PRENOM)");

        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);

        $res = $statement->execute();
        return $res;
    }

   public function getNonPlongeur()
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * from PLO_PERSONNE where per_num not in
                (
                    SELECT per_num from PLO_PLONGEUR
                )";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function isPlongeur($PER_NUM)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * from PLO_PERSONNE where :PER_NUM in
                (
                    SELECT PER_NUM from PLO_PLONGEUR
                )";

        $req = $pdo->prepare($sql);
        $req->bindParam(':PER_NUM', $PER_NUM);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }
}