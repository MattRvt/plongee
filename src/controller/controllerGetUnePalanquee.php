<?php


class controllerGetUnePalanquee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->getNom();
        }
    }

    function getNom()
    {
        $date = $_POST["date"];
        $moment = $_POST["moment"];
        $num = $_POST["num"];

        $reader = new modelPalanquee();
        $palanquee = $reader->getPalanqueeByDateMomentNum($date,$moment,$num);

        echo $palanquee["PAL_HEURE_IMMERSION"]."|".$palanquee["PAL_HEURE_SORTIE_EAU"]."|".$palanquee["PAL_PROFONDEUR_REELLE"]."|".$palanquee["PAL_DUREE_FOND"]."|".$palanquee["PAL_PROFONDEUR_MAX"]."|".$palanquee["PAL_DUREE_MAX"];
    }
}