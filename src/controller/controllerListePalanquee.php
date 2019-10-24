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
        if (!empty($_POST['modifier'])){
            $numPalanquee = $_POST['numPalanquee'];
            $datePalanquee = $_POST['datePalanquee'];
            $seancePalanquee = $_POST['seancePalanquee'];
            $profondeurMaxPalanquee = $_POST['profondeurMaxPalanquee'];
            $dureeMaxPalanquee = $_POST['dureeMaxPalanquee'];
            $heureImmersionPalanquee = $_POST['heureImmersionPalanquee'];
            $heureSortieEauPalanquee = $_POST['heureSortieEauPalanquee'];
            $profondeurReellePalanquee = $_POST['profondeurReellePalanquee'];
            $dureeFondPalanquee = $_POST['dureeFondPalanquee'];
            $this->modifyPalanquee($numPalanquee, $datePalanquee, $seancePalanquee, $profondeurMaxPalanquee,  $dureeMaxPalanquee, $heureImmersionPalanquee, $heureSortieEauPalanquee, $profondeurReellePalanquee, $dureeFondPalanquee);
        }
        $this->_view = new View('ListePalanquee');
        $this->_view->generate(array(), $this);
    }

    public function modifyPalanquee($numPalanquee, $datePalanquee, $seancePalanquee, $profondeurMaxPalanquee,  $dureeMaxPalanquee, $heureImmersionPalanquee, $heureSortieEauPalanquee, $profondeurReellePalanquee, $dureeFondPalanquee){
        require_once('model/modelPalanquee.php');
        $reader = new modelPalanquee();
        $reader->modifyPalanquee($numPalanquee, $datePalanquee, $seancePalanquee, $profondeurMaxPalanquee,  $dureeMaxPalanquee, $heureImmersionPalanquee, $heureSortieEauPalanquee, $profondeurReellePalanquee, $dureeFondPalanquee);
    }

    public function selectAll(){
        require_once('model/modelPalanquee.php');
        $reader = new modelPalanquee();
        $palanquee = $reader->getAll();
        return $palanquee;
    }
}
?>