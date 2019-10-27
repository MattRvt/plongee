<?php


class controllerUpdatePalanquee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->updatePalanquee();
        }
    }

    public function updatePalanquee()
    {
        $date = $_POST["date"];
        $moment = $_POST["moment"];
        $num = $_POST["num"];
        $profMax = $_POST["profMax"];
        $durMax = $_POST["durMax"];

        $writer = new modelPalanquee();

        $writer->modifyPalanquee($num,$date,$moment,$profMax,$durMax,null,null,null,null);

        echo $num;
    }
}