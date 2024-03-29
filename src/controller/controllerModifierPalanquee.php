<?php

class controllerModifierPalanquee  extends controller
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->modifierPalanquee();
        }
    }

    public function modifierPalanquee()
    {
        $writer = new modelPalanquee();

        $num = $_POST["num"];
        $date = $_POST["date"];
        $moment = $_POST["moment"];

        $data = $writer->getPalanqueeByDateMomentNum($date,$moment,$num);

        $profMax = $data["PAL_PROFONDEUR_MAX"];
        $durMax = $data["PAL_DUREE_MAX"];

        $heureImm = $_POST["heureImm"];
        if($heureImm == "")
        {
            $heureImm = null;
        }

        $HeureSor = $_POST["HeureSor"];
        if($HeureSor == "")
        {
            $HeureSor = null;
        }

        $ProfondeurReel = $_POST["ProfondeurReel"];
        if($ProfondeurReel == 0)
        {
            $ProfondeurReel = null;
        }

        $dureeFond = $_POST["dureeFond"];
        if($dureeFond == 0)
        {
            $dureeFond = null;
        }

        $writer->modifyPalanquee($num, $date,$moment,$profMax,$durMax,$heureImm,$HeureSor,$ProfondeurReel,$dureeFond);

        $pasAJour = $writer->getDansPlongeePasAJour($_POST['date'],$_POST['moment']);
        $writer = new modelPlongee();
        if(empty($pasAJour))
        {
            $writer->setEtat("Complète", $moment,$date);
        }
        else
        {
            $writer->setEtat("Paramétrée", $moment,$date);
        }
    }
}
?>