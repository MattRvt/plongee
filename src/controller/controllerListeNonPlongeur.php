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
        $text = "<table>";

        $reader = new modelPersonne();
        $nonPlongeur = $reader->getNonPlongeur();

        foreach ($nonPlongeur as $key => $content) {

            $text = $text.'<tr>';

            foreach ($content as $key2 => $content2) {
                $text = $text.'<td>';
                $text = $text.$key2 . ' => ' . $content2;
                $text = $text.'</td>';
            }
            $text = $text.'<td> <input type="button" value="Modifier non Plongeur" onclick="window.location.href=\'ModifierPlongeur&param=' . $content["PER_NUM"] . '\'"> </td>';

            $text = $text.'</tr>';
        }

        $text = $text."</table>";

        echo $text;
    }
}