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
        $reader2 = new modelPersonne();

        $return_arr = array();
        foreach($plongeur as $key=>$content) {
            $dir = $reader2->isDirecteur($content['PER_NUM']);
            $secu = $reader2->isSecuriteSurface($content['PER_NUM']);

            if ($dir) $dir="<i class='material-icons' title='Directeur'>assignment</i>";
            else $dir = "";
            if ($secu) $secu="<i class='material-icons' title='Sécurité de surface'>pan_tool</i>";
            else $secu = "";

            $return_arr[] = array("PER_NUM" => $content['PER_NUM'],
                "PER_NOM" => $content['PER_NOM'],
                "PER_PRENOM" => $content['PER_PRENOM'],
                "PER_ACTIVE" => $content['PER_ACTIVE'],
                "PER_DATE_CERTIF_MED" => $content['PER_DATE_CERTIF_MED'],
                "APT_CODE" => $content['APT_CODE'],
                "DIR" => $dir,
                "SECU" => $secu);

        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }
}