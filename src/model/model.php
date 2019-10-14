<?php

abstract class model
{
    //patron singleton pour éviter les multi-instance
    private static $_bdd;

    private static function setBdd()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ';charset=utf8';
        self::$_bdd = new PDO($dsn, DB_USER, DB_PASSWORD);
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if(self::$_bdd == null)
        {
            $this->setBdd();
        }
        return self::$_bdd;
    }

    protected function selectAll($table)
    {
        $pdo = $this->getBdd();
        $table = strtoupper($table);

        $sql = "SELECT * FROM ".$table;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }
}