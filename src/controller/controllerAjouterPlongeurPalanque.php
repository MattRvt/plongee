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

        //à réfléchire
        $text = "";

        $text = $text."<div class='col s6'>
                            <h6>Plongeur 1:</h6>
                                <label>
                                     <input type='texte' required><br />
                                 </label>
                        </div>";

        echo $text;
    }
}