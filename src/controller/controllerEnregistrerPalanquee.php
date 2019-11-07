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

        $numMax = 0;
        foreach ($palanquees as $key => $content)
        {
            if(isset($content)) {
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

                $numMax = $num;

                $palanquee = new palanquee($date, $moment, $profMax, $durMax, $heureImm, $heureSor, $profReel, $durFond, $num, $nbPlongeur, $plongeur);

                $palanquee->completerBase();
            }
        }

        $model = new modelPlongee();
        $model->supprimerAllPalanqueSup($_POST["dateAj"],$_POST["momentAj"],$numMax);

        if($numMax != 0)
        {
            $model->verifierEtat($_POST["dateAj"],$_POST["momentAj"]);
        }
        else
        {
            $model->setEtat("Créée", $_POST["momentAj"], $_POST["dateAj"]);
        }
        echo $model->getEtat($_POST["dateAj"],$_POST["momentAj"]);

        $model->verifierNbPalanquee($_POST["dateAj"],$_POST["momentAj"]);
    }
}
