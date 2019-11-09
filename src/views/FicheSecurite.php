<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Fiche de sécurité</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <style>
                html {
                    line-height: 1.2;
                }
                th {
                    border-radius: 0;
                }

                .saut {
                    display: block !important;
                    page-break-after: always;
                    position: relative;
                }

                body {
                    -webkit-print-color-adjust: exact;
                }

                @page {
                    size: auto;
                    margin: 0;  /* enlève l'affichage de l'url dans le pdf */
                }
            </style>
            <script type="text/javascript">
                function f(date, moment){
                    document.title = "Plongee_du_"+date+"_"+moment;
                    window.print();
                    setTimeout(function(){ closePrintView(); }, 800);

                }

                function closePrintView() {
                    document.location.href = 'ListePlongee';
                }
            </script>
            <?php
                $readerpl = new modelPlongee();
                $readerpers = new modelPersonne();
                $readersite = new modelSite();
                $readerpal = new modelPalanquee();
                $readerapt = new modelAptitude();
                $req = $readerpl->getMatch($_GET['date'], $_GET['moment']);
                $plongee=$req[0];
                $palanquee = $readerpal->getDansPlongee($_GET['date'], $_GET['moment']);
            ?>
        </head>
        <body onload="f(<?php echo "'".$_GET['date']."','". $_GET['moment']."'" ?>);">
            <h4 class="center-align">FICHE DE SECURITE</h4>
            <div class="container">
                <div class="row">
                    <table class="col s6 centered">
                        <tr>
                            <th>Date</th>
                            <td id="date"><?php echo $plongee['PLO_DATE'] ;?><br> <?php switch ($plongee['PLO_MAT_MID_SOI']) {
                                    case 'M':
                                        echo "Matin";
                                        break;
                                    case 'A':
                                        echo "Après-midi";
                                        break;
                                    case 'S':
                                        echo "Soir";
                                        break;
                                }?></td>
                        </tr>
                        <tr>
                            <th>Directeur de plongée</th>
                            <td><?php $dir = $readerpers->getPersonneByNum($plongee['PER_NUM_DIR']); echo $dir['PER_NOM']." ".$dir['PER_PRENOM'] ?></td>
                        </tr>
                        <tr>
                            <th>Site de plongée</th>
                            <td><?php $site = $readersite->getSiteByNum($plongee['SIT_NUM']); echo $site['SIT_NOM'] ?></td>
                        </tr>
                        <tr>
                            <th>Effectif</th>
                            <td><?php echo $plongee['PLO_EFFECTIF_PLONGEURS'] ;?></td>
                        </tr>
                    </table>
                    <div class="col offset-s2">
                        <img class="responsive-img" alt="Logo" style="max-width: 180px;margin-top: 50px" src="views/image/company-name.jpg">
                    </div>
                </div>

                <div class="row">
                    <table class="col s10">
                        <tr>
                            <th>Sécurité de surface</th>
                            <td><?php $dir = $readerpers->getPersonneByNum($plongee['PER_NUM_SECU']); echo $dir['PER_NOM']." ".$dir['PER_PRENOM'] ?></td>
                        </tr>
                        <tr>
                            <th>Observation(s)</th>
                            <td></td>
                        </tr>
                    </table>
                </div>

                <?php
                for ($i = 0; $i<$plongee['PLO_NB_PALANQUEES'] ; $i++){
                    if ($i%2==1){
                        echo " <div>";
                    }
                    else {
                        echo " <div class=\"saut\">";
                    }
                    echo " 
                    <div class=\"row\" style=\"border: 5px #424242 solid;\">
                        <table class=\"col s12 centered\">
                            <tr>
                                <th class=\"grey darken-3 white-text center-align\">PALANQUEE ".($i+1)."</th>
                            </tr>
                        </table>
                        <table class=\"col s12 centered\">
                            <tr>
                                <th style=\"width: 170px;\">Temps Prévu</th>
                                <td>".$palanquee[$i]['PAL_DUREE_MAX']." min</td>
                                <th style=\"width: 170px;\">Profondeur Prévue</th>
                                <td>".$palanquee[$i]['PAL_PROFONDEUR_MAX']."m</td>
                            </tr>
                            <tr>
                                <th style=\"width: 170px;\">Heure Départ</th>
                                <td>".$palanquee[$i]['PAL_HEURE_IMMERSION']."</td>
                                <th style=\"width: 170px;\">Heure Retour</th>
                                <td>".$palanquee[$i]['PAL_HEURE_SORTIE_EAU']."</td>
                            </tr>
                            <tr>
                                <th style=\"width: 170px;\">Temps Réalisé</th>
                                <td>".$palanquee[$i]['PAL_DUREE_FOND']." min</td>
                                <th style=\"width: 170px;\">Profondeur Réalisée</th>
                                <td>".$palanquee[$i]['PAL_PROFONDEUR_REELLE']."m</td>
                            </tr>
                        </table>
                        <table class=\"centered\">
                            <thead class=\"grey darken-3 white-text\">
                            <tr>
                                <th>Nom Prénom</th>
                                <th>Niveau</th>
                            </tr>
                            </thead>
                            <tbody>";
                    $nbplongeur = $readerpal->getNbPlongeur($_GET['date'], $_GET['moment'], $i+1);
                    $getplongeur = $readerpal->getPlongeur($_GET['date'], $_GET['moment'], $i+1);

                    if ($nbplongeur['count(*)'] > 0){
                        for ($j = 0; $j<$nbplongeur['count(*)']; $j++){
                            $apt = $readerapt->getDataByCode($getplongeur[$j]['APT_CODE']);
                            echo "<tr>
                                <td>".$getplongeur[$j]['PER_NOM']." ".$getplongeur[$j]['PER_PRENOM']."</td>
                                <td>".$apt['APT_LIBELLE']."</td>
                            </tr>";
                        }
                    } else {
                        echo " <tr>
                                <td colspan=\"2\" class=\"pink lighten-5 red-text text-darken-4 center\"><strong>AUCUN PLONGEUR DANS CETTE PALANQUEE</strong></td>
                            </tr>";
                    }
                    echo "</tbody>
                        </table>
                    </div>
                </div>";

                }

                ?>

            </div>
        </body>
    </html>