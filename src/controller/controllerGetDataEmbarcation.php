<?php


class controllerGetDataEmbarcation
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getDataEmbarcation();
        }
    }

    function getDataEmbarcation()
    {
        $num = $_POST["num"];

        $reader = new modelEmbarcation();
        $embarcation = $reader->getEmbarcationByNum($num);

        echo $embarcation["EMB_NOM"];
    }
}