<?php


class modelSite extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_site');
    }

    public function addPersonne($SIT_NUM,$SIT_NOM,$SIT_LOCALISATION)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_SITE`(`SIT_NUM`, `SIT_NOM`, `SIT_LOCALISATION`) VALUES (:SIT_NUM,:SIT_NOM,:SIT_LOCALISATION)");

        $statement->bindParam(':SIT_NUM', $SIT_NUM);
        $statement->bindParam(':SIT_NOM', $SIT_NOM);
        $statement->bindParam(':SIT_LOCALISATION', $SIT_LOCALISATION);

        $res = $statement->execute();
        return $res;
    }

    public function getSiteByNum($num)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_SITE WHERE SIT_NUM = ".$num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }
}