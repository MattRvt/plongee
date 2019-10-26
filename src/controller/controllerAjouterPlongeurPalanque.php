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

        $text = $text."<div class='col s6'>
                            <h6>Plongeur ".$nb.":</h6>
                                <label>
                                     <input type='text' id='plongeur".$nb."' name='plongeur".$nb."' size='30' maxlength='50' placeholder='Nom' required>
                                 </label>
                        </div>";

        echo $text;
    }
}