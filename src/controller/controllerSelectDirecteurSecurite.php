<?php

class controllerSelectDirecteurSecurite extends controller
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->selectDirecteurSecurite();
        }
    }

    public function selectDirecteurSecurite()
    {
        $reader = new modelPersonne();

        if($this->isPlongeePassee()) $bon = "disabled";
        else $bon = "";

        $plongeur = explode(",",$_POST["plongeurNum"]);

        $text = "<select id='directeurDePlongee' name='directeurDePlongee' $bon>";

        $req = $reader->getDirecteurDePlongee();

        $defaultCode = $this->defaut()[0];

        $text = $text.$this->listeDeroulante($req, "PER_NOM", "PER_NUM", $defaultCode["PER_NUM_DIR"], $plongeur)."</select>";

        $text = $text."|"."<select id='securiteDeSurface' name='securiteDeSurface' $bon >";

        $req = $reader->getSecuriteDeSurface();

        $text = $text.$this->listeDeroulante($req, "PER_NOM", "PER_NUM", $defaultCode["PER_NUM_SECU"], $plongeur)."</select>";

        echo $text;
        echo "|".$defaultCode["PER_NUM_DIR"];
        echo "|".$defaultCode["PER_NUM_SECU"];
    }

    public function defaut()
    {
        if($_POST['date']!="null" && $_POST['moment']!="null")
        {
            $reader = new modelPlongee();
            return $reader->getMatch($_POST['date'],$_POST['moment']);
        }
        return null;
    }

    public function isPlongeePassee()
    {
        if($_POST['date']!="null")
        {
            $dateAujourdhui = explode("-", date("Y-m-d"));
            $datePlongee = explode("-", $_POST['date']);
            $dateValide = $dateAujourdhui[0] >= $datePlongee[0];

            if ($dateValide) {
                $dateValide = $dateAujourdhui[1] >= $datePlongee[1];
                if ($dateValide) {
                    $dateValide = $dateAujourdhui[2] >= $datePlongee[2];
                    return $dateValide;
                }
            }
        }
        return false;
    }
}