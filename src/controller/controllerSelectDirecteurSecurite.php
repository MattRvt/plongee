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

        $plongeur = $_POST["plongeurNum"];
        foreach ($plongeur as $key => $content)
        {
            $plongeur[$key] = rtrim($content);
        }
        var_dump($plongeur);

        $defaultCode = $this->defaut();
        $dernier = sizeof($plongeur);

        if($_POST["dirSecu"] == "true") {
            $plongeur[$dernier] = $defaultCode["Secu"];
            $req = $reader->getDirecteurDePlongee();
            $text = $this->listeDeroulante($req, "PER_NOM", "PER_NUM", $defaultCode["Dir"], $plongeur);
        }
        else
        {
            $plongeur[$dernier] = $defaultCode["Dir"];
            $req = $reader->getSecuriteDeSurface();
            $text = $this->listeDeroulante($req, "PER_NOM", "PER_NUM", $defaultCode["Secu"], $plongeur);
        }

        echo $text;
    }

    public function defaut()
    {
        $defaut = array();
        if($_POST['selectDir']!=null)
        {
            $defaut["Dir"] = $_POST['selectDir'];
        }
        if($_POST["selectSecu"]!=null)
        {
            $defaut["Secu"] = $_POST['selectSecu'];
        }
        if($_POST['date']!="null" && $_POST['moment']!="null")
        {
            $reader = new modelPlongee();
            $plongee = $reader->getMatch($_POST['date'],$_POST['moment'])[0];
            if(!isset($defaut["Dir"]))
            {
                $defaut["Dir"] = $plongee["PER_NUM_DIR"];
            }
            if(!isset($defaut["Secu"]))
            {
                $defaut["Secu"] = $plongee["PER_NUM_SECU"];
            }
        }
        if(!isset($defaut["Secu"]))
        {
            $defaut["Secu"] = null;
        }
        if(!isset($defaut["Dir"]))
        {
            $defaut["Dir"] = null;
        }
        return $defaut;
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