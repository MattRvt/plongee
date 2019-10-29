<?php


class controllerGetAllDataEmbarcation
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getAllDataEmbarcation();
        }
    }

    function getAllDataEmbarcation()
    {
        $reader = new modelEmbarcation();

        $site = $reader->getAll();

        foreach ($site as $key => $contents)
        {
            echo $contents["EMB_NUM"].";".$contents["EMB_NOM"]."|";
        }
    }
}