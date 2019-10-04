<?php

abstract class model
{
    //patron singleton pour éviter les multi-instance
    private static $_bdd;

    private static function setBdd()
    {
        require_once("model/Settings.php");
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ';charset=utf8';
        self::$_bdd = new PDO($dsn, 'root', '');
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

        $r = [
            'table' => $table
        ];

        $sql = "SELECT * FROM :table";

        $req = $pdo->prepare($sql);
        $req->execute($r);

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $data;
    }
}