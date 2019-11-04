<?php

class controllerAjoutPalanquee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->ajoutPalanquee();
        }
    }

    public function ajoutPalanquee()
    {
        require_once("model/entite/palanquee.php");

        $date = $_POST["date"];
        $moment = $_POST["moment"];
        $profMax = $_POST["profMax"];
        $durMax = $_POST["durMax"];

        $nbPlong = $_POST["nb"];
        $plongeur = $_POST["plongeur"];
        $plongeur = explode(",",$plongeur);

        if(isset($_POST["num"]))
        {
            $palanquee = new palanquee($date,$moment,$profMax,$durMax,$nbPlong,$plongeur,$_POST["num"]);
        }
        else
        {
            $palanquee = new palanquee($date,$moment,$profMax,$durMax,$nbPlong,$plongeur);
        }

        echo json_encode($palanquee->getArray(),JSON_UNESCAPED_UNICODE);
    }
}