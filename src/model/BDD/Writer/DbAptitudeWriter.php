<?php

include_once('../DbConnector.php');

class DbAptitudeWriter
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function addPersonne($APT_CODE,$APT_LIBELLE)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `plo_aptitude`(`APT_CODE`, `APT_LIBELLE`) VALUES (:APT_CODE,:APT_LIBELLE)");

        $statement->bindParam(':APT_CODE', $APT_CODE);
        $statement->bindParam(':APT_LIBELLE', $APT_LIBELLE);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}