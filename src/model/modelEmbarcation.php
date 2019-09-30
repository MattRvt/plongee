<?php


class modelEmbarcation extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_embarcation');
    }

    public function addPersonne($EMB_NUM,$EMB_NOM)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `plo_embarcation`(`EMB_NUM`, `EMB_NOM`) VALUES (:EMB_NUM,:EMB_NOM)");

        $statement->bindParam(':EMB_NUM', $EMB_NUM);
        $statement->bindParam(':EMB_NOM', $EMB_NOM);

        $res = $statement->execStatement();
        return $res;
    }
}