<?php


abstract class controller
{
    /**
     * A utilisé dans une balise select
     * renvoie la liste des option avec les donnes d'une table.
     * @param $req tableau conteant le resultat de la requet
     * @param $label colonne qui sera utilisé pour afficher sur la page
     * @param $code valeur du select (value)
     */
    public function listeDeroulante($req, $label, $code)
    {//TODO enregistrer valeur saisie
        echo "<option value=\"\" hidden>--Please choose an option--</option>";
        foreach ($req as $ligne) {
            $labelOption = $ligne[$label];
            $codeOption = $ligne[$code];
            echo "<option value=\"" . $codeOption . "\" > " . $labelOption . "</option>";
        }
    }
}