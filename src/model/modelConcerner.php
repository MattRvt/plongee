<?php

class modelConcerner extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_aptitude');
    }

    public function addPersonne($PLO_DATE,$PLO_MATIN_APRESMIDI, $PAL_NUM, $PER_NUM)
    {

        $statement = $this->getBdd()->prepare("INSERT INTO `plo_concerner`(`PLO_DATE`, `PLO_MATIN_APRESMIDI`, `PAL_NUM`, `PER_NUM`) VALUES (:PLO_DATE,:PLO_MATIN_APRESMIDI,:PAL_NUM,:PER_NUM)");

        $statement->bindParam(':PLO_DATE', $PLO_DATE);
        $statement->bindParam(':PLO_MATIN_APRESMIDI', $PLO_MATIN_APRESMIDI);
        $statement->bindParam(':PAL_NUM', $PAL_NUM);
        $statement->bindParam(':PER_NUM', $PER_NUM);


        $res = $statement->execute();
        return $res;
    }
}