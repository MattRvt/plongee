<?php

class DbPlongeeWriter
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function addPersonne($PLO_DATE,$PLO_MATIN_APRESMIDI,$SIT_NUM,$EMB_NUM,$PER_NUM_DIR,$PER_NUM_SECU,$PLO_EFFECTIF_PLONGEURS,$PLO_EFFECTIF_BATEAU,$PLO_NB_PALANQUEES)
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }

        $statement = $this->dbConnector->prepStatement($pdo,"INSERT INTO `plo_plongee`(`PLO_DATE`, `PLO_MATIN_APRESMIDI`, `SIT_NUM`, `EMB_NUM`, `PER_NUM_DIR`, `PER_NUM_SECU`, `PLO_EFFECTIF_PLONGEURS`, `PLO_EFFECTIF_BATEAU`, `PLO_NB_PALANQUEES`) VALUES (:PLO_DATE,:PLO_MATIN_APRESMIDI,:SIT_NUM,:EMB_NUM,:PER_NUM_DIR,:PER_NUM_SECU,:PLO_EFFECTIF_PLONGEURS,:PLO_EFFECTIF_BATEAU,:PLO_NB_PALANQUEES)");

        $statement->bindParam(':PLO_DATE', $PLO_DATE);
        $statement->bindParam(':PLO_MATIN_APRESMIDI', $PLO_MATIN_APRESMIDI);
        $statement->bindParam(':SIT_NUM', $SIT_NUM);
        $statement->bindParam(':EMB_NUM', $EMB_NUM);
        $statement->bindParam(':PER_NUM_DIR', $PER_NUM_DIR);
        $statement->bindParam(':PER_NUM_SECU', $PER_NUM_SECU);
        $statement->bindParam(':PLO_EFFECTIF_PLONGEURS', $PLO_EFFECTIF_PLONGEURS);
        $statement->bindParam(':PLO_EFFECTIF_BATEAU', $PLO_EFFECTIF_BATEAU);
        $statement->bindParam(':PLO_NB_PALANQUEES', $PLO_NB_PALANQUEES);

        $res = $this->dbConnector->execStatement($statement);
        return $res;
    }
}