<?php


class modelSite extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_site');
    }

    public function addSite($SIT_NOM,$SIT_LOCALISATION)
    {
        $bdd = $this->getBdd();

        $sql = "select max(SIT_NUM) FROM PLO_SITE";
        $statement = $bdd->prepare($sql);
        $statement->execute();
        $num = $statement->fetch(PDO::FETCH_ASSOC);
        $num = $num["max(SIT_NUM)"]+1;

        $sql = "INSERT INTO `PLO_SITE`(`SIT_NUM`, `SIT_NOM`, `SIT_LOCALISATION`) VALUES ($num,'$SIT_NOM','$SIT_LOCALISATION')";

        $statement = $bdd->prepare($sql);

        $statement->execute();
        $statement->closeCursor();

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

    public function updateSite($num,$nom,$localisation)
    {
        $pdo = $this->getBdd();

        $sql = "UPDATE `PLO_SITE` SET `SIT_NOM`=\"".$nom."\",`SIT_LOCALISATION`=\"".$localisation."\" WHERE SIT_NUM =".$num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }

    public function nbUseSite($num)
    {
        $pdo = $this->getBdd();
        $sql = "SELECT count(*) FROM `PLO_SITE` join PLO_PLONGEE using(`SIT_NUM`) WHERE `SIT_NUM` = ".$num;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data["count(*)"];
    }

    public function deleteSite($num)
    {
        $pdo = $this->getBdd();
        $sql = "DELETE FROM `PLO_SITE` WHERE `SIT_NUM` = ".$num;
        $req = $pdo->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }

    public function allUseSite()
    {
        $pdo = $this->getBdd();
        $sql = "SELECT DISTINCT SIT_NUM FROM PLO_PLONGEE";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function allNonUseSite()
    {
        $pdo = $this->getBdd();
        $sql = "SELECT SIT_NUM FROM PLO_SITE where SIT_NUM not in ( SELECT SIT_NUM FROM PLO_PLONGEE)";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }
}