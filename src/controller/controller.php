<?php


abstract class controller
{
    /**
     * A utilisé dans une balise select
     * renvoie la liste des option avec les donnes d'une table.
     * @param $req tableau conteant le resultat de la requet
     * @param $label colonne qui sera utilisé pour afficher sur la page
     * @param $code valeur du select (value)
     * @param $defaultCode parametre optionel permetant de definir une valeur par defaut
     */

    public function listeDeroulante($req, $label, $code, $defaultCode=null)
    {
        $defaultValue = "--Sélectionnez une option--";
        if($defaultCode == null)
        {
            $text = "<option value=\"rien\" hidden selected disabled>".$defaultValue."</option>";

        }
        else
        {
            $text = "<option value=\"rien\" hidden disabled>".$defaultValue."</option>";
        }
        foreach ($req as $ligne) {
            $labelOption = $ligne[$label];
            $codeOption = $ligne[$code];
            if ($defaultCode == $codeOption) {
                $text = $text."<option value=\"" . $codeOption . "\" Selected> " . $labelOption . "</option>";
            } else {
                $text = $text."<option value=\"" . $codeOption . "\" > " . $labelOption . "</option>";
            }
        }
        return $text;
    }
}