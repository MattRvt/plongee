<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Plongee</title>
            <script type="text/javascript">
                function f(){
                    window.print();
                    //setTimeout("closePrintView()", 500);
                }

                function closePrintView() {
                    document.location.href = 'ListePlongee';
                }
            </script>
            <?php
                require_once('model/modelPlongee.php');
                $reader = new modelPlongee();
                var_dump($_GET);
                $req = $reader->getMatch($_GET['date'], $_GET['moment']);
                var_dump($req);
            ?>
        </head>
        <body onload="f();">
            <h1>Fiche de sécurité</h1>
            <table border=2>
                <tr>
                    <td>Date</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Directeur de plongée</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Site de plongée</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Effectif</td>
                    <td></td>
                </tr>
            </table><br/>
            <table border=2>
                <tr>
                    <td>Sécurité de surface</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Observation
                        > Météo et marée
                    </td>
                    <td></td>
                </tr>
            </table><br/><br/>

            <table border=5>
                <tr>
                    <td>Palanquée n°</td>
                </tr>
                <tr>
                    <td>Heure de départ</td>
                    <td></td>
                    <td>Heure de retour</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Temps prévu</td>
                    <td></td>
                    <td>Profondeur prévue</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Temps réalisé</td>
                    <td></td>
                    <td>Profondeur réalisée</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Nom Prénom</td>
                    <td>Niveau</td>
                    <td>Formation vers</td>
                    <td>Fonction</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <input type="text" value="nonon"/>
        </body>
    </html>