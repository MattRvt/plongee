<?php

class controllerListePalanqueePlongee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listePalanqueePlongee();
        }
    }

    public function listePalanqueePlongee()
    {
        require_once("model/entite/palanquee.php");
        if (isset($_POST['moment']) && isset($_POST['date']) && isset($_POST['passerOuPas']))
        {
            $return_arr = array();
            $reader = new modelPalanquee();
            $palanquees = $reader->getDansPlongee($_POST['date'],$_POST['moment']);

            foreach($palanquees as $key=>$content)
            {
                $palanquee = new palanquee($content['PLO_DATE'],$content['PLO_MAT_MID_SOI'],$content['PAL_PROFONDEUR_MAX'],$content['PAL_DUREE_MAX'],$content['PAL_HEURE_IMMERSION'],$content['PAL_HEURE_SORTIE_EAU'],$content['PAL_PROFONDEUR_REELLE'],$content['PAL_DUREE_FOND'],$content['PAL_NUM']);
                $return_arr[] = $palanquee->getArray();
            }
            echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
        }
    }
}