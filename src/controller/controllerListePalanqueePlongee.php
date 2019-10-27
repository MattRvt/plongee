<?php

class controllerListePalanqueePlongee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->listePalanqueePlongee();
        }
    }

    public function listePalanqueePlongee()
    {
        if (isset($_POST['moment']) && isset($_POST['date']))
        {
            $reader = new modelPalanquee();
            $text = "";

            date_default_timezone_set('UTC');
            if(date("Y-m-j")>$_POST['date'])
            {
                $pasAJour = $reader->getDansPlongeePasAJour($_POST['date'],$_POST['moment']);
                $AJour = $reader->getDansPlongeeAJour($_POST['date'],$_POST['moment']);
                if(!empty($pasAJour))
                {
                    $text = $text."<div class='center'><h6>Palanquee Passé à mettre à jour :</h6></div>";

                    $text = $text."<table>";
                    if (!empty($pasAJour)) {
                        foreach ($pasAJour as $key => $content)
                        {
                            $text = $text.'<tr>';
                            $text = $this->listeConstruction($text,$content);

                            $text = $text.'<td>';
                            $text = $text."<a class='waves-effect waves-light btn modal-trigger orange' onclick='initCompleterPal(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'>Compléter</a>";
                            $text = $text.'</td>';

                            $text = $text.'</tr>';
                        }
                    }
                    $text = $text."</table>";
                }
                if(!empty($AJour))
                {
                    $text = $text."<div class='center'><h6>Palanquee Passé :</h6></div>";

                    $text = $text."<table>";
                    if (!empty($AJour)) {
                        foreach ($AJour as $key => $content)
                        {
                            $text = $text.'<tr>';
                            $text = $this->listeConstruction($text,$content);

                            $text = $text.'<td>';
                            $text = $text."<a class='waves-effect waves-light btn modal-trigger' onclick='initCompleterPal(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'>Modifier</a>";
                            $text = $text.'</td>';

                            $text = $text.'</tr>';
                        }
                    }
                    $text = $text."</table>";
                }
            }
            else
            {
                $palanquee = $reader->getDansPlongee($_POST['date'],$_POST['moment']);

                $text = $text."<div class='center'><h6>Palanquee Non Passé :</h6></div>";

                $text = $text."<table>";
                if (!empty($palanquee)) {
                    foreach ($palanquee as $key => $content)
                    {
                        $text = $text.'<tr>';

                        $text = $this->listeConstruction($text,$content);

                        $text = $text.'<td>';
                        $text = $text."<a class='waves-effect waves-light btn modal-trigger' onclick='initModifPalanquee(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'>Modifier</a>";
                        $text = $text.'</td>';

                        $text = $text.'<td>';
                        $text = $text."<a class='center' onclick='supprimerPal(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'><i class='small material-icons red-text'>clear</i></a>";
                        $text = $text.'</td>';

                        $text = $text.'</tr>';

                    }
                }
                $text = $text."</table>";
            }
        }
        echo $text;
    }

    public function listeConstruction($text, $data)
    {
        foreach ($data as $key2 => $content)
        {
            $text = $text.'<td>';
            $text = $text.$key2 . ' => ' . $content;
            $text = $text.'</td>';
        }
        $reader = new modelPalanquee();
        $text = $text.'<td>Nombre de palanquée => '.$reader->getNbPlongeur($data['PLO_DATE'],$data['PLO_MAT_MID_SOI'],$data['PAL_NUM'])["count(*)"].'</td>';
        return $text;
    }
}