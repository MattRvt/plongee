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

        $text = "";

        $text = $text."<div>
                                <div class='input-field row'>
                                     <input class='col s11 autocomplete' type='text' id='plongeur".$nb."' name='plongeur".$nb."' placeholder='Nom' required>
                                      <label for='plongeur".$nb."'>Plongeur ".$nb."</label>
                                     <div class='col s1' id='supprPlongeurPal".$nb."'></div>
                                 </div>
                        </div>";

        echo $text;
    }
}