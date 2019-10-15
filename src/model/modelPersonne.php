<?php


class modelPersonne extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_personne');
    }

    public function getLastPersonne(){
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_PERSONNE WHERE PER_NUM = (SELECT MAX(PER_NUM) FROM PLO_PERSONNE)";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data[0];
    }


    public function addPersonne($PER_NUM, $PER_NOM, $PER_PRENOM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_PERSONNE`(`PER_NUM`, `PER_NOM`, `PER_PRENOM`) VALUES (:PER_NUM, :PER_NOM,:PER_PRENOM)");

        $statement->bindParam(':PER_NUM', $PER_NUM);
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

    public function getSecuriteDeSurface()
    {
        $pdo = $this->getBdd();
        $sql = "select * from plo_personne where PER_NUM in (
                     select PER_NUM from plo_securite_de_surface
                )";
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDirecteurDePlongee()
    {
        $pdo = $this->getBdd();
        $sql = "select * from plo_personne where PER_NUM in (
                     select PER_NUM from plo_directeur
                )";
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
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

    public function modifyPersonne($PER_NUM, $PER_NOM, $PER_PRENOM)
    {
        $statement = $this->getBdd()->prepare("UPDATE PLO_PERSONNE SET PER_NOM = :PER_NOM, PER_PRENOM = :PER_PRENOM WHERE PER_NUM = :PER_NUM");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);

        $res = $statement->execute();
        return $res;
    }

    public function statePersonne($PER_NUM, $VAL)
    {
        $statement = $this->getBdd()->prepare("UPDATE PLO_PERSONNE SET PER_ACTIVE = :VAL WHERE PER_NUM = :PER_NUM");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':VAL', $VAL);

        $res = $statement->execute();
        return $res;
    }

}