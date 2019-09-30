<?php

abstract class model
{
    //patron singleton pour éviter les multi-instance
    private static $_bdd;

    private static function setBdd()
    {
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

    protected function selectAll($table, $obj)
    {
        $req = self::$_bdd->prepare('SELECT * FROM'.$table);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $data;
    }

    protected function selectAllCondition($table, $obj, $condition,$valeur)
    {
        $req = self::$_bdd->prepare('SELECT * FROM'.$table.'WHERE'.$condition.'='.$valeur);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $data;
    }
}