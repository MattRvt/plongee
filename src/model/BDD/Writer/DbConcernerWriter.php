<?php

class DbConcernerWriter
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function addPersonne($PLO_DATE,$PLO_MATIN_APRESMIDI, $PAL_NUM, $PER_NUM)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `plo_concerner`(`PLO_DATE`, `PLO_MATIN_APRESMIDI`, `PAL_NUM`, `PER_NUM`) VALUES (:PLO_DATE,:PLO_MATIN_APRESMIDI,:PAL_NUM,:PER_NUM)");

        $statement->bindParam(':PLO_DATE', $PLO_DATE);
        $statement->bindParam(':PLO_MATIN_APRESMIDI', $PLO_MATIN_APRESMIDI);
        $statement->bindParam(':PAL_NUM', $PAL_NUM);
        $statement->bindParam(':PER_NUM', $PER_NUM);


        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}