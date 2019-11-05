<?php


class controllerIsConcerne
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->isConcerned();
        }
    }

    public function isConcerned()
    {
        $num = $_POST['num'];
        $reader = new modelConcerner();
        $personne= $reader->isConcerned($num);

        echo sizeof($personne);
    }
}