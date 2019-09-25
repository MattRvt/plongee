<?php

include_once('../DbConnector.php');

class DbPlongeurWriter
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function addPersonne($PER_NUM,$APT_CODE)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `plo_plongeur`(`PER_NUM`, `APT_CODE`) VALUES (:PER_NUM,:APT_CODE)");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':APT_CODE', $APT_CODE);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}