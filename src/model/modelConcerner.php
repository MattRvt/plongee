<?php

class modelConcerner extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_concerner');
    }

    public function addPersonne($PLO_DATE,$PLO_MATIN_APRESMIDI, $PAL_NUM, $PER_NUM)
    {

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
}