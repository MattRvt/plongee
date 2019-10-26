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

    public function deleteDirecteur($num)
    {
        if(empty($this->directeurInPlongee($num))) {
            $pdo = $this->getBdd();

            $sql = "DELETE FROM `PLO_DIRECTEUR` WHERE PER_NUM =" . $num;

            $req = $pdo->prepare($sql);
            $req->execute();

            $req->closeCursor();
        }
        else {
            echo "Impossible de supprimer le directeur de surface car il fait partie d'une ou plusieurs plongée";
        }
    }

    public function directeurInPlongee($num)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM `PLO_DIRECTEUR` where per_num = ".$num." and per_num in 
                ( 
                    select per_num_dir from PLO_PLONGEE
                )";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $req->closeCursor();

        return $data;
    }
}