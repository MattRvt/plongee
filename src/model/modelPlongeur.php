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

        $sql = "select * from PLO_PERSONNE join PLO_PLONGEUR using(per_num) ORDER BY per_nom;";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function deletePlongeur($num)
    {
        if(empty($this->plongeurIsConcerner($num)))
        {
            $pdo = $this->getBdd();

            $sql = "DELETE FROM `PLO_PLONGEUR` WHERE PER_NUM =" . $num;

            $req = $pdo->prepare($sql);
            $req->execute();

            $req->closeCursor();
        }
        else
        {
            echo "Impossible de supprimer le plongeur car il fait partie d'une ou plusieurs plongée";
        }
    }

    public function plongeurIsConcerner($num)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM `PLO_PLONGEUR` where per_num = ".$num." and per_num in 
                ( 
                    select per_num from plo_concerner
                )";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $req->closeCursor();

        return $data;
    }
}