<?php

include_once('DbConnector.php');

class DbDirecteurWriter
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function addPersonne($PER_NUM)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `plo_directeur`(`PER_NUM`) VALUES (:PER_NUM);");

        $statement->bindParam(':PER_NUM', $PER_NUM);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}