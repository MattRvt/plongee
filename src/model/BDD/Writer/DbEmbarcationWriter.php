<?php

class DbEmbarcationWriter
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function addPersonne($EMB_NUM,$EMB_NOM)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `plo_embarcation`(`EMB_NUM`, `EMB_NOM`) VALUES (:EMB_NUM,:EMB_NOM)");

        $statement->bindParam(':EMB_NUM', $EMB_NUM);
        $statement->bindParam(':EMB_NOM', $EMB_NOM);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}