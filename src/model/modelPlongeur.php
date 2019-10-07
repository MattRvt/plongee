<?php


class modelPlongeur extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_plongeur');
    }

    public function get($numPersonne)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_PLONGEUR where PLO_NUM = :numPersonne";

        $req = $pdo->prepare($sql);
        $req.bindValue(":numPersonne",$numPersonne);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
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