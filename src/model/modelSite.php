<?php


class modelSite extends model
{
    public function addPersonne($SIT_NUM,$SIT_NOM,$SIT_LOCALISATION)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `site`(`SIT_NUM`, `SIT_NOM`, `SIT_LOCALISATION`) VALUES (:SIT_NUM,:SIT_NOM,:SIT_LOCALISATION)");

        $statement->bindParam(':SIT_NUM', $SIT_NUM);
        $statement->bindParam(':SIT_NOM', $SIT_NOM);
        $statement->bindParam(':SIT_LOCALISATION', $SIT_LOCALISATION);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}