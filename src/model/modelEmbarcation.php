<?php


class modelEmbarcation extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_embarcation');
    }


    public function addEmbarcation($EMB_NOM)
    {
        $bdd = $this->getBdd();

        $sql = "select max(EMB_NUM) FROM PLO_EMBARCATION";
        $statement = $bdd->prepare($sql);
        $statement->execute();
        $num = $statement->fetch(PDO::FETCH_ASSOC);
        $num = $num["max(EMB_NUM)"]+1;

        $sql = "INSERT INTO `PLO_EMBARCATION`(`EMB_NUM`, `EMB_NOM`) VALUES ($num,'$EMB_NOM')";
        $statement = $bdd->prepare($sql);

        $statement->execute();
        $statement->closeCursor();
    }

    public function getEmbarcationByNum($num)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_EMBARCATION WHERE EMB_NUM = ".$num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function updateEmbarcation($num,$nom)
    {
        $pdo = $this->getBdd();

        $sql = "UPDATE `PLO_EMBARCATION` SET `EMB_NOM`=\"".$nom."\" WHERE EMB_NUM =".$num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }

    public function nbUseEmbarcation($num)
    {
        $pdo = $this->getBdd();
        $sql = "SELECT count(*) FROM `PLO_EMBARCATION` join PLO_PLONGEE using(`EMB_NUM`) WHERE `EMB_NUM` = ".$num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();


        return $data["count(*)"];
    }

    public function deleteEmbarcation($num)
    {
        $pdo = $this->getBdd();
        $sql = "DELETE FROM `PLO_EMBARCATION` WHERE `EMB_NUM` = ".$num;
        $req = $pdo->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }

    public function allUseEmbarcation()
    {
        $pdo = $this->getBdd();
        $sql = "SELECT DISTINCT EMB_NUM FROM PLO_PLONGEE";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function allNonUseEmbarcation()
    {
        $pdo = $this->getBdd();
        $sql = "SELECT EMB_NUM FROM PLO_EMBARCATION where EMB_NUM not in ( SELECT EMB_NUM FROM PLO_PLONGEE)";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }
}