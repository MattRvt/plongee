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

    public function deleteSecuSurface($num)
    {
        if (empty($this->SecuSurfaceInPlongee($num))) {
            $pdo = $this->getBdd();

            $sql = "DELETE FROM `PLO_SECURITE_DE_SURFACE` WHERE PER_NUM =" . $num;

            $req = $pdo->prepare($sql);
            $req->execute();

            $req->closeCursor();
        } else {
            echo "Impossible de supprimer la securité de surface car il fait partie d'une ou plusieurs plongée";
        }
    }

    public function SecuSurfaceInPlongee($num)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM `PLO_SECURITE_DE_SURFACE` where per_num = ".$num." and per_num in 
                ( 
                    select per_num_secu from plo_plongee
                )";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $req->closeCursor();

        return $data;
    }
}