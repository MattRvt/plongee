<?php

$GLOBALS["db_logpath"] = __DIR__ . 'php.log';
$GLOBALS["bEchoLogs"] = false;
$GLOBALS["bEnableLogging"] = true;
$GLOBALS["bWriteLogs"] = true;

class DbConnector
{
    /**
     * @throws \Exception
     */
    public function getConnection()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ';charset=utf8';
        try {
            $pdo = new \PDO($dsn, DB_USER, DB_PASSWORD);
        } catch (\PDOException $exception) {
            throw new \Exception("No connection to database");
        }
        return $pdo;
    }

    public function prepStatement($pdo,$sql)
    {
        $req_prep = $pdo->prepare($sql);
        return $req_prep;
    }

    public function execStatement($statement)
    {
        $statement->execute();
        preg_replace('/\s+/S', " ", $statement->queryString);
        $result = $statement->fetchAll(2);
        return $result; // FETCH_ASSOC
    }
}


/*Exemple pour la suite

include_once 'Settings.php';
include_once('model/BDD/DbConnector.php');

$dbreader = new DbConnector();
$pdo = $dbreader->getConnection();
$statement = $dbreader->prepStatement($pdo, "select * from plo_aptitude");
$res = $dbreader->execStatement($statement);
print_r($res);*/
