<?php


class controllerIsUse
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->isUse();
        }
    }

    function isUse()
    {
        $num = $_POST["num"];

        $model = "model".$_POST["name"];
        $reader = new $model();

        $name = "nbUse".$_POST["name"];
        $object = $reader->$name($num);

        echo $object != 0;
    }
}