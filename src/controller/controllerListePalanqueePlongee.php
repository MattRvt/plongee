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
        if (isset($_POST['moment']) && isset($_POST['date']) && isset($_POST['passerOuPas']))
        {
            $return_arr = array();
            $return_arr2 = array();

            $reader = new modelPalanquee();

            $passerOuPas = $_POST['passerOuPas'];

            if($passerOuPas == "false")
            {
                $reader2 = new modelPlongee();
                $etat = $reader2->getEtat($_POST['date'],$_POST['moment']);
                $palanquee = $reader->getDansPlongee($_POST['date'],$_POST['moment']);

                foreach($palanquee as $key=>$content)
                {
                    if($content["PAL_HEURE_IMMERSION"] == "" || $content["PAL_HEURE_SORTIE_EAU"] == "" || $content["PAL_PROFONDEUR_REELLE"] == "" || $content["PAL_DUREE_FOND"] == "")
                    {
                        if($etat != "Dépassée") {
                                $btn = "<a class='waves-effect waves-light btn modal-trigger orange' onclick='initCompleterPal(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'>à compléter</a>";
                            }
                        else {
                            $btn = "<a class='waves-effect waves-light modal-trigger' onclick='initInfoPal(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'><i class='material-icons black-text' >remove_red_eye</i></a>";
                        }

                        $return_arr[] = array(
                            "PAL_NUM" => $content['PAL_NUM'],
                            "PAL_PROFONDEUR_MAX" => $content['PAL_PROFONDEUR_MAX'],
                            "PAL_DUREE_MAX" => $content['PAL_DUREE_MAX'],
                            "PAL_HEURE_IMMERSION" => $content['PAL_HEURE_IMMERSION'],
                            "PAL_HEURE_SORTIE_EAU" => $content['PAL_HEURE_SORTIE_EAU'],
                            "PAL_PROFONDEUR_REELLE" => $content['PAL_PROFONDEUR_REELLE'],
                            "PAL_DUREE_FOND" => $content['PAL_DUREE_FOND'],
                            "nbPlongeur" => $reader->getNbPlongeur($content['PLO_DATE'],$content['PLO_MAT_MID_SOI'],$content['PAL_NUM'])["count(*)"],
                            "btn" => "<td>".$btn."</td>");

                    }
                    else
                    {
                        if($etat != "Dépassée")
                        {
                            $btn = "<a class='waves-effect waves-light btn modal-trigger' onclick='initCompleterPal(\"" . $content['PLO_DATE'] . "\",\"" . $content['PLO_MAT_MID_SOI'] . "\"," . $content['PAL_NUM'] . ")'>complète</a>";
                        }
                        else {
                            $btn = "<a class='waves-effect waves-light modal-trigger' onclick='initInfoPal(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'><i class='material-icons black-text' >remove_red_eye</i></a>";
                        }

                        $return_arr2[] = array(
                            "PAL_NUM" => $content['PAL_NUM'],
                            "PAL_PROFONDEUR_MAX" => $content['PAL_PROFONDEUR_MAX'],
                            "PAL_DUREE_MAX" => $content['PAL_DUREE_MAX'],
                            "PAL_HEURE_IMMERSION" => $content['PAL_HEURE_IMMERSION'],
                            "PAL_HEURE_SORTIE_EAU" => $content['PAL_HEURE_SORTIE_EAU'],
                            "PAL_PROFONDEUR_REELLE" => $content['PAL_PROFONDEUR_REELLE'],
                            "PAL_DUREE_FOND" => $content['PAL_DUREE_FOND'],
                            "nbPlongeur" => $reader->getNbPlongeur($content['PLO_DATE'],$content['PLO_MAT_MID_SOI'],$content['PAL_NUM'])["count(*)"],
                            "btn" => "<td>".$btn."</td>");
                    }
                }
                $return_arr = array_merge($return_arr, $return_arr2);
            }
            else
            {
                $palanquee = $reader->getDansPlongee($_POST['date'],$_POST['moment']);

                foreach($palanquee as $key=>$content)
                {
                    $btn1 = "<a class='waves-effect waves-light btn modal-trigger' onclick='initModifPalanquee(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'>Modifier</a>";
                    $btn2 = "<a class='center' onclick='supprimerPal(\"".$content['PLO_DATE']."\",\"".$content['PLO_MAT_MID_SOI']."\",".$content['PAL_NUM'].")'><i class='small material-icons red-text'>clear</i></a>";

                    $return_arr[] = array(
                        "PAL_NUM" => $content['PAL_NUM'],
                        "PAL_PROFONDEUR_MAX" => $content['PAL_PROFONDEUR_MAX'],
                        "PAL_DUREE_MAX" => $content['PAL_DUREE_MAX'],
                        "nbPlongeur" => $reader->getNbPlongeur($content['PLO_DATE'],$content['PLO_MAT_MID_SOI'],$content['PAL_NUM'])["count(*)"],
                        "btn" => "<td>".$btn1."</td>".
                                "<td>".$btn2."</td>");
                }
            }
            echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
        }
    }
}