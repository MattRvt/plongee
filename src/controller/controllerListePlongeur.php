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
        $text = "<table>";

        $reader = new modelPlongeur();
        $plongeur = $reader->selectPlongeurPersonne();

        foreach($plongeur as $key=>$content) {

            $text = $text.'<tr>';

            foreach ($content as $key2 => $content2) {
                $text = $text.'<td>';
                $text = $text.$key2 . ' => ' . $content2;
                $text = $text.'</td>';
            }
            $text = $text.'<td><a class="waves-effect waves-light btn modal-trigger" onclick="initModalAjoutPers('.$content["PER_NUM"].')">Modifier</a>

<!--<input type="button" value="Modifier Plongeur" onclick="window.location.href=\'ModifierPlongeur&param=' . $content["PER_NUM"] . '\'">--> </td>';

            $text = $text.'</tr>';
        }

        $text = $text."</table>";

        echo $text;
    }
}