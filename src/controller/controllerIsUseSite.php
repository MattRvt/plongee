<?php


class controllerIsUseSite
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->isSecuriteSurface();
        }
    }

    function isSecuriteSurface()
    {
        $num = $_POST["num"];

        $reader = new modelSite();
        $site = $reader->nbUseSite($num);

        echo $site != 0;
    }
}