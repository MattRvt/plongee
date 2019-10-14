<?php


abstract class controller
{
    /**
     * A utilisé dans une balise select
     * renvoie la liste des option avec les donnes d'une table.
     * @param $reader model servant à lire la base
     * @param $label colonne qui sera utilisé pour afficher sur la page
     * @param $code valeur du select (value)
     */
    public function listeDeroulante($reader, $label, $code)
    {
        echo "<option value='' disabled hidden>--Please choose an option--</option>";
        $req = $reader->getAll(); //cause erreur
        $values = $req;
        foreach ($values as $ligne) {
            $labelOption = $ligne[$label];
            $codeOption = $ligne[$code];
            echo "<option value=\"" . $codeOption . "\" > " . $labelOption . "</option>";
        }
    }
}