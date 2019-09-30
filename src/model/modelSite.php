<?php


class modelSite extends model
{
    public function addPersonne($SIT_NUM,$SIT_NOM,$SIT_LOCALISATION)
    {
        $this->getBdd();

        $statement = $this->dbConnector->prepare("INSERT INTO `site`(`SIT_NUM`, `SIT_NOM`, `SIT_LOCALISATION`) VALUES (:SIT_NUM,:SIT_NOM,:SIT_LOCALISATION)");

        $statement->bindParam(':SIT_NUM', $SIT_NUM);
        $statement->bindParam(':SIT_NOM', $SIT_NOM);
        $statement->bindParam(':SIT_LOCALISATION', $SIT_LOCALISATION);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}