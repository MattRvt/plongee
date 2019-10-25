<?php


class controllerListePlongeur
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listPlongeur();
        }
    }

    public function listPlongeur()
    {
        $reader = new modelPlongeur();
        $plongeur = $reader->selectPlongeurPersonne();
        $return_arr = array();
        foreach($plongeur as $key=>$content) {

            $return_arr[] = array("PER_NUM" => $content['PER_NUM'],
                "PER_NOM" => $content['PER_NOM'],
                "PER_PRENOM" => $content['PER_PRENOM'],
                "PER_ACTIVE" => $content['PER_ACTIVE'],
                "PER_DATE_CERTIF_MED" => $content['PER_DATE_CERTIF_MED'],
                "APT_CODE" => $content['APT_CODE']);

            //$text = $text.'<td><a class="waves-effect waves-light btn modal-trigger" onclick="initModalAjoutPers('.$content["PER_NUM"].')">Modifier</a>

//<input type="button" value="Modifier Plongeur" onclick="window.location.href=\'ModifierPlongeur&param=' . $content["PER_NUM"] . '\'"> </td>';

        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }
}