<?php


class controllerHistorique
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else if (isset($_POST['histo'])){
            if ($_POST['histo'] == '0'){
                $this->afficherDernieresPlongee();
            } else {
                $this->afficherProchainesPlongee();
            }
        }
    }

    public function afficherDernieresPlongee(){
        $reader = new modelPlongee();

        $dernieres = $reader -> get3LastPlongee();

        $return_arr = array();
        foreach($dernieres as $key=>$content) {
            $return_arr[] = array("PLO_DATE" => $content['PLO_DATE'],
                "PLO_MAT_MID_SOI" => $content['PLO_MAT_MID_SOI'],
                "SIT_NUM" => $content['SIT_NUM'],
                "EMB_NUM" => $content['EMB_NUM']);
        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }

    public function afficherProchainesPlongee(){
        $reader = new modelPlongee();
        $prochaines = $reader -> get3NextPlongee();

        $return_arr = array();
        foreach($prochaines as $key=>$content) {
            $return_arr[] = array("PLO_DATE" => $content['PLO_DATE'],
                "PLO_MAT_MID_SOI" => $content['PLO_MAT_MID_SOI'],
                "SIT_NUM" => $content['SIT_NUM'],
                "EMB_NUM" => $content['EMB_NUM']);
        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }
}