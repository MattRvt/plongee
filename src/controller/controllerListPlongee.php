<?php


class controllerListPlongee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->ListPlongee();
        }
    }

    public function ListPlongee()
    {
        $reader = new modelPlongee();
        if($_POST["archive"] == "true")
        {
            $site= $reader->getAllArchive();
        }
        else
        {
            $site= $reader->getAll();
        }

        $return_arr = array();
        foreach($site as $key=>$content)
        {
            $return_arr[] = array("PLO_DATE" => $content['PLO_DATE'],
                "PLO_MAT_MID_SOI" => $content['PLO_MAT_MID_SOI'],
                "SIT_NUM" => $content['SIT_NUM'],
                "EMB_NUM" => $content['EMB_NUM'],
                "PER_NUM_DIR" => $content['PER_NUM_DIR'],
                "PER_NUM_SECU" => $content['PER_NUM_SECU'],
                "PLO_EFFECTIF_PLONGEURS" => $content['PLO_EFFECTIF_PLONGEURS'],
                "PLO_EFFECTIF_BATEAU" => $content['PLO_EFFECTIF_BATEAU'],
                "PLO_NB_PALANQUEES" => $content['PLO_NB_PALANQUEES'],
                "PLO_ETAT" => $content['PLO_ETAT']);
        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }
}