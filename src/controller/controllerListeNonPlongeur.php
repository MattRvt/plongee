<?php


class controllerListeNonPlongeur
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listNonPlongeur();
        }
    }

    public function listNonPlongeur()
    {
        $reader = new modelPersonne();
        $plongeur = $reader->getNonPlongeur();
        $reader2 = new modelPersonne();

        $return_arr = array();
        foreach($plongeur as $key=>$content) {
            $dir = $reader2->isDirecteur($content['PER_NUM']);
            $secu = $reader2->isSecuriteSurface($content['PER_NUM']);

            if ($dir) $dir="dir";
            else $dir = "";
            if ($secu) $secu="secu";
            else $secu = "";

            $return_arr[] = array("PER_NUM" => $content['PER_NUM'],
                "PER_NOM" => $content['PER_NOM'],
                "PER_PRENOM" => $content['PER_PRENOM'],
                "PER_ACTIVE" => $content['PER_ACTIVE'],
                "PER_DATE_CERTIF_MED" => $content['PER_DATE_CERTIF_MED'],
                "DIR" => $dir,
                "SECU" => $secu);

        }
        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
    }
}