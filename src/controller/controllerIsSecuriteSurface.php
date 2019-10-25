<?php


class controllerIsSecuriteSurface
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

        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $plongeur = $reader->isSecuriteSurface($num);

        echo    !empty($plongeur);
    }
}