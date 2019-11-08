<?php

class modelConcerner extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_concerner');
    }

    public function addPersonne($PLO_DATE,$PLO_MATIN_APRESMIDI, $PAL_NUM, $PER_NUM)
    {
        $model = new modelPersonne();
        $model->statePersonne($PER_NUM,1);

        $sql = "INSERT INTO `PLO_CONCERNER`(`PLO_DATE`, `PLO_MAT_MID_SOI`, `PAL_NUM`, `PER_NUM`) VALUES (\"".$PLO_DATE."\",\"".$PLO_MATIN_APRESMIDI."\",\"".$PAL_NUM."\",\"".$PER_NUM."\")";
        $statement = $this->getBdd()->prepare($sql);
        $statement->execute();
    }

    public function deletePersonne($PLO_DATE,$PLO_MATIN_APRESMIDI, $PAL_NUM)
    {
        $sql = "DELETE FROM `PLO_CONCERNER` WHERE PLO_DATE=\"".$PLO_DATE."\" and PLO_MAT_MID_SOI=\"".$PLO_MATIN_APRESMIDI."\" and PAL_NUM=".$PAL_NUM;
        $statement = $this->getBdd()->prepare($sql);
        $statement->execute();
    }

    public function deletebyMomentDate($PLO_DATE,$PLO_MATIN_APRESMIDI)
    {
        $sql = "DELETE FROM `PLO_CONCERNER` WHERE PLO_DATE=\"".$PLO_DATE."\" and PLO_MAT_MID_SOI=\"".$PLO_MATIN_APRESMIDI."\"";
        $statement = $this->getBdd()->prepare($sql);
        $statement->execute();
    }

    public function isConcerned($num){
            $pdo = $this->getBdd();

            $sql = "SELECT * FROM PLO_CONCERNER WHERE PER_NUM = :PER_NUM";

            $req = $pdo->prepare($sql);
            $req->bindParam(':PER_NUM', $num);
            $req->execute();

            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            $req->closeCursor();

            return $data;
    }
}