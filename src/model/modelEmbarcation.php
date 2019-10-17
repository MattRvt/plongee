<?php


class modelEmbarcation extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_embarcation');
    }

    public function addPersonne($EMB_NUM,$EMB_NOM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_EMBARCATION`(`EMB_NUM`, `EMB_NOM`) VALUES (:EMB_NUM,:EMB_NOM)");

        $statement->bindParam(':EMB_NUM', $EMB_NUM);
        $statement->bindParam(':EMB_NOM', $EMB_NOM);

        $res = $statement->execStatement();
        return $res;
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
}