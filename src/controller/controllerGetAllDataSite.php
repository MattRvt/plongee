<?php


class controllerGetAllDataSite
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getAllDataSite();
        }
    }

    function getAllDataSite()
    {
        $reader = new modelSite();

        $site = $reader->getAll();

        foreach ($site as $key => $contents)
        {
            echo $contents["SIT_NUM"].";".$contents["SIT_NOM"]."|";
        }
    }
}
