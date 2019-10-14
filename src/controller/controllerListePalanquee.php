<?php

class controllerListePalanquee  extends controller
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
        //TODO Melmel
        /*if (!empty($_POST['modifier'])){
            $datePalanquee = $_POST['num'];
            $seance = $_POST['nom'];
            $ = $_POST['prenom'];
            $this->modifierPalanquee($id, $nom, $prenom);
        }
        else if (!empty($_POST['etat'])){
            $id = $_POST['num'];
            $_POST['etat']=="Activer" ? $val = 1 : $val = 0;
            $this->changeEtatPersonne($id, $val);
        }*/
        $this->_view = new View('ListePalanquee');
        $this->_view->generate(array(), $this);
    }

    public function selectAll(){
        require_once('model/modelPalanquee.php');
        $reader = new modelPalanquee();
        $palanquee = $reader->getAll();
        return $palanquee;
    }
}
?>