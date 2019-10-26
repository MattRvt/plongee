<?php


class controllerAjouterPlongeurPalanque
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->ajouterPlongeurPalanque();
        }
    }

    function ajouterPlongeurPalanque()
    {
        $nb = $_POST["nb"];

        $reader = new modelPlongeur();
        $plongeur = $reader->selectPlongeurPersonne();

        $text = "";

        $text = $text."<div>
                            <h6>Plongeur ".$nb.":</h6>
                                <label class='row'>
                                     <input class='col s11' type='text' id='plongeur".$nb."' name='plongeur".$nb."' placeholder='Nom' required>
                                     <div class='col s1' id='supprPlongeurPal".$nb."'></div>
                                 </label>
                        </div>";

        echo $text;
    }
}