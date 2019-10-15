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

        $sql = "SELECT * FROM PLO_PLONGEUR where PER_NUM = :numPersonne";

        $req = $pdo->prepare($sql);
        $req->bindParam(":numPersonne",$numPersonne);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data[0];
    }

    public function addPlongeur($PER_NUM,$APT_CODE)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_PLONGEUR`(`PER_NUM`, `APT_CODE`) VALUES (:PER_NUM,:APT_CODE)");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':APT_CODE', $APT_CODE);

        $res = $statement->execute();
        return $res;
    }

    public function selectPlongeurPersonne()
    {
        $pdo = $this->getBdd();

        $sql = "select * from PLO_PERSONNE join PLO_PLONGEUR using(per_num);";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }
}