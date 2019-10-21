<?php

class controllerModifierPalanquee  extends controller
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
        $this->_view = new View('ModifierPalanquee');
        $this->_view->generate(array(),$this);
    }

    public function selectPalanquee($numPalanquee){
        require_once('model/modelPalanquee.php');
        $reader = new modelPalanquee();
        $palanquee = $reader->getPalanquee($numPalanquee);
        return $palanquee;
    }

    /*public function selectSeance(){
        require_once('model/modelPalanquee.php');
        $reader = new modelPalanquee();
        $req = $reader->getAll();
        if (isset($_POST['PLO_MAT_MID_SOI'])) {
            $defaultCode = $_POST['PLO_MAT_MID_SOI'];
        } else {
            $defaultCode = null;
        }
        echo $this->listeDeroulante($req, "PLO_MAT_MID_SOI", $defaultCode);
    }*/
}
?>