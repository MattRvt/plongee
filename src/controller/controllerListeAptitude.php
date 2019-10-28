<?php


class controllerListeAptitude
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listeAptitude();
        }
    }

    public function listeAptitude()
    {
        $reader = new modelAptitude();
        $site= $reader->getAll();

        $return_arr = array();
        foreach($site as $key=>$content)
        {
            $return_arr[] = array("APT_CODE" => $content['APT_CODE'],
                "APT_LIBELLE" => $content['APT_LIBELLE']);
        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }
}