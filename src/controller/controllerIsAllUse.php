<?php


class controllerIsAllUse
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
        $model = "model".$_POST["name"];
        $reader = new $model();

        $name = "allUse".$_POST["name"];
        $data = $reader->$name();
        $text = "";

        foreach ($data as $key => $content)
        {
            $text = $text.$content[$_POST["param"]]." ";
        }

        $name = "allNonUse".$_POST["name"];
        $data = $reader->$name();
        $text = $text."|";

        foreach ($data as $key => $content)
        {
            $text = $text.$content[$_POST["param"]]." ";
        }

        echo $text;
    }
}