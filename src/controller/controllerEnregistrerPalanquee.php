<?php


class controllerEnregistrerPalanquee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->enregistrerPalanquee();
        }
    }

    public function enregistrerPalanquee()
    {
        require_once("model/entite/palanquee.php");
        $data = $_POST["data"];
        $palanquees = json_decode($data,JSON_UNESCAPED_UNICODE);

        foreach ($palanquees as $key => $content)
        {
            $date = $content["date"];
            $moment = $content["moment"];
            $num = $content["num"];
            $profMax = $content["profMax"];
            $durMax = $content["durMax"];
            $heureImm = $content["heureImm"];
            $heureSor = $content["heureSor"];
            $profReel = $content["profReel"];
            $durFond = $content["durFond"];
            $nbPlongeur = $content["nbPlongeur"];
            $plongeur = $content["plongeur"];

            $palanquee = new palanquee($date,$moment,$profMax,$durMax,$heureImm,$heureSor,$profReel,$durFond,$num,$nbPlongeur,$plongeur);

            $palanquee->completerBase();
        }
    }
}