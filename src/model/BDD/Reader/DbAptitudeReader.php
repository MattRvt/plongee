<?php

class DbAptitudeReader
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function getAllAptitude()
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"SELECT * FROM `plo_aptitude`");

        return $this->dbConnector->execStatement($statement);
    }
}