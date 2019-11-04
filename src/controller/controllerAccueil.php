<?php

class controllerAccueil extends controller
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
        $this->_view = new View('Accueil');
        $this->_view->generate(array(), $this);
        if (isset $_POST['archive']){
            if ($_POST['archive'] == 0){
                $this->afficherDernieresPlongee();
            }
            else {
                $this->afficherProchainesPlongee();
            }
        }
        echo "<script type='text/javascript'>affichePlongee()</script>";
    }

    public function afficherDernieresPlongee(){
        $reader = new modelPlongee();

        $dernieres = $reader -> get3LastPlongee();
        echo json_encode($dernieres,JSON_UNESCAPED_UNICODE);
        echo "|";
    }

    public function afficherProchainesPlongee(){
        $reader = new modelPlongee();
        $prochaines = $reader -> get3NextPlongee();

        echo json_encode($prochaines,JSON_UNESCAPED_UNICODE);
    }
}
?>