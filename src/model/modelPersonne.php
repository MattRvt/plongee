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


    public function addPersonne($PER_NUM, $PER_NOM, $PER_PRENOM, $dateCertif, $active)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_PERSONNE`(`PER_NUM`, `PER_NOM`, `PER_PRENOM`, `PER_ACTIVE`, `PER_DATE_CERTIF_MED` ) VALUES (:PER_NUM, :PER_NOM,:PER_PRENOM,:ACTIVE,:DATECERTIF)");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);
        $statement->bindParam(':DATECERTIF', $dateCertif);
        $statement->bindParam(':ACTIVE', $active);

        $res = $statement->execute();
        return $res;
    }

    public function deletePersonne($num)
    {
        $pdo = $this->getBdd();

        $sql = "DELETE FROM `PLO_PERSONNE` WHERE PER_NUM =" . $num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }

    public function getNonPlongeur()
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * from PLO_PERSONNE where per_num not in
                (
                    SELECT per_num from PLO_PLONGEUR ORDER BY per_num
                ) order by per_nom ";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function getSecuriteDeSurface()
    {
        $pdo = $this->getBdd();
        $sql = "select * from PLO_PERSONNE where PER_NUM in (
                     select PER_NUM from PLO_SECURITE_DE_SURFACE
                ) order by per_nom";
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDirecteurDePlongee()
    {
        $pdo = $this->getBdd();
        $sql = "select * from PLO_PERSONNE where PER_NUM in (
                     select PER_NUM from PLO_DIRECTEUR
                ) order by per_nom";
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

    public function isDirecteur($PER_NUM)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * from PLO_PERSONNE where :PER_NUM in
                (
                    SELECT PER_NUM from PLO_DIRECTEUR
                )";

        $req = $pdo->prepare($sql);
        $req->bindParam(':PER_NUM', $PER_NUM);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function isSecuriteSurface($PER_NUM)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * from PLO_PERSONNE where :PER_NUM in
                (
                    SELECT PER_NUM from PLO_SECURITE_DE_SURFACE
                )";

        $req = $pdo->prepare($sql);
        $req->bindParam(':PER_NUM', $PER_NUM);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function modifyPersonne($PER_NUM, $PER_NOM, $PER_PRENOM, $dateCertif, $active)
    {
        $statement = $this->getBdd()->prepare("UPDATE PLO_PERSONNE SET PER_NOM = :PER_NOM, PER_PRENOM = :PER_PRENOM, PER_DATE_CERTIF_MED = :DATECERTIF, PER_ACTIVE = :ACTIVE WHERE PER_NUM = :PER_NUM");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);
        $statement->bindParam(':DATECERTIF', $dateCertif);
        $statement->bindParam(':ACTIVE', $active);

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

    public function getPersonneByNum($num)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_PERSONNE WHERE PER_NUM = ".$num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function existPersonne($nom, $prenom)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_PERSONNE WHERE PER_NOM = :PER_NOM AND PER_PRENOM = :PER_PRENOM";

        $req = $pdo->prepare($sql);
        $req->bindParam(':PER_NOM', $nom);
        $req->bindParam(':PER_PRENOM', $prenom);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function modifyPlongeur($num, $aptitude)
    {
        if(!$this->isPlongeur($num) && $aptitude != -1)
        {
            require_once ("modelPlongeur.php");
            $reader = new modelPlongeur();
            $reader->addPlongeur($num,$aptitude);
        }
        else if($this->isPlongeur($num) && $aptitude == -1)
        {
            require_once ("modelPlongeur.php");
            $reader = new modelPlongeur();
            $reader->deletePlongeur($num);
        }
        else if($aptitude != -1)
        {
            $pdo = $this->getBdd();

            $sql = "UPDATE PLO_PLONGEUR SET APT_CODE = :APTCODE WHERE PER_NUM = ".$num;

            $req = $pdo->prepare($sql);
            $req->bindParam(":APTCODE",$aptitude);
            $req->execute();

            $req->closeCursor();
        }
    }

    public function modifyDirecteur($num, $bool)
    {
        if(!$this->isDirecteur($num) && $bool != -1)
        {
            require_once ("modelDirecteur.php");
            $reader = new modelDirecteur();
            $reader->addDirecteur($num);
        }
        else if($this->isDirecteur($num) && $bool == -1)
        {
            require_once ("modelDirecteur.php");
            $reader = new modelDirecteur();
            $reader->deleteDirecteur($num);
        }
    }
    public function modifySecuSurface($num, $bool)
    {
        if(!$this->isSecuriteSurface($num) && $bool != -1)
        {
            require_once ("modelSecuSurface.php");
            $reader = new modelSecuSurface();
            $reader->addSecuriteSurface($num);
        }
        else if($this->isSecuriteSurface($num) && $bool == -1)
        {
            require_once ("modelSecuSurface.php");
            $reader = new modelSecuSurface();
            $reader->deleteSecuSurface($num);
        }
    }


}