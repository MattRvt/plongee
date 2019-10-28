<?php

class modelAptitude extends model
{

    public function getAll()
    {
        return $this->selectAll('plo_aptitude');
    }

    public function addPersonne($APT_CODE,$APT_LIBELLE)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_APTITUDE`(`APT_CODE`, `APT_LIBELLE`) VALUES (:APT_CODE,:APT_LIBELLE)");

        $statement->bindParam(':APT_CODE', $APT_CODE);
        $statement->bindParam(':APT_LIBELLE', $APT_LIBELLE);

        $res = $statement->execute();
        return $res;
    }

    public function getDataByCode($APT_CODE)
    {
        $bdd = $this->getBdd();

        $sql = "SELECT * FROM `PLO_APTITUDE` WHERE APT_CODE=\"".$APT_CODE."\"";

        $statement = $bdd->prepare($sql);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $data;
    }

    public function updateAptitude($APT_CODE,$APT_LIBELLE)
    {
        $pdo = $this->getBdd();

        $sql = "UPDATE `PLO_APTITUDE` SET `APT_LIBELLE`=\"".$APT_LIBELLE."\" WHERE APT_CODE = \"".$APT_CODE."\"";

        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }

    public function nbUseAptitude($code)
    {
        $pdo = $this->getBdd();
        $sql = "SELECT count(*) FROM `PLO_APTITUDE` join PLO_PLONGEUR using(`APT_CODE`) WHERE `APT_CODE` = \"".$code."\"";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data["count(*)"];
    }

    public function deleteAptitude($code)
    {
        $pdo = $this->getBdd();
        $sql = "DELETE FROM `PLO_APTITUDE` WHERE `APT_CODE` = \"".$code."\"";
        $req = $pdo->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }
}