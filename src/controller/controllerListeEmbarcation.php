<?php

class controllerListeEmbarcation
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listEmbarcation();
        }
    }

    public function listEmbarcation()
    {
        $reader = new modelEmbarcation();
        $embarcation = $reader->getAll();

        $return_arr = array();
        foreach ($embarcation as $key => $content) {
            $return_arr[] = array(
                "EMB_NUM" => $content['EMB_NUM'],
                "EMB_NOM" => $content['EMB_NOM']
            );
        }
        echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
    }
}