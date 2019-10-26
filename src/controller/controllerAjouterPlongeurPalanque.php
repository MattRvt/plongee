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
        $reader = new modelPlongeur();
        $plongeur = $reader->selectPlongeurPersonne();

        $text = "";

        $text = $text."<div class='col s6'>
                            <h6>Plongeur 1:</h6>
                                <label>
                                     <input type='text' id='plongeur1' name='plongeur1' size='30' maxlength='50' placeholder='Nom' required>
                                 </label>
                        </div>";

        echo $text;
    }
}