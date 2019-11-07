<?php


class controllerGetDataSite
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getDataSite();
        }
    }

    function getDataSite()
    {
        $num = $_POST["num"];

        $reader = new modelSite();
        $site = $reader->getSiteByNum($num);

        echo $site["SIT_NOM"]."|".$site["SIT_LOCALISATION"];
    }
}
