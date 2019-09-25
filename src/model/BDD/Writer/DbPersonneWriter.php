<?php

include_once('../DbConnector.php');

class DbPersonneWriter
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function addPersonne($PER_NOM,$PER_PRENOM)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `plo_personne`(`PER_NOM`, `PER_PRENOM`) VALUES (:PER_NOM,:PER_PRENOM)");

        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}