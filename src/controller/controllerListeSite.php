<?php

class controllerListeSite
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listSite();
        }
    }

    public function listSite()
    {
        $reader = new modelSite();
        $site= $reader->getAll();

        $return_arr = array();
        foreach($site as $key=>$content)
        {
            $return_arr[] = array("SIT_NUM" => $content['SIT_NUM'],
                "SIT_NOM" => $content['SIT_NOM'],
                "SIT_LOCALISATION" => $content['SIT_LOCALISATION']);
        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }
}