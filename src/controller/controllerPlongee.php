<?php

class controllerPlongee
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->mentions();
        }
    }

    public function mentions()
    {
        $this->_view = new View('Plongee');
        $this->_view->generate(array(), $this);

        //traitemnt du formulaire
        $this->traitementFormulaire();


    }


    public function verifierRempli($n)
    {

        if (isset($_POST[$n])) {
            $var = $_POST[$n];
            //if ($var <> "")
            echo $var;
        } else {
            echo "";
        }
    }


    public function traitementFormulaire()
    {
        if (isset($_POST['date'])) {
            $date = $_POST['date'];
            echo "date : $date <br />";
        }


        echo "données post :<br>";
        if (!empty($_POST)) {

            //debug:
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
        } else {
            echo "vide <br>";
        }
        echo "fin données";
    }


    /*
requette ajout plongé

*/

}

?>