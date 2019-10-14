<?php

class controllerPlongee extends controller
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

        $this->traitementFormulaire();
        $this->_view = new View('Plongee');

        $this->_view->generate(array(), $this);


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

        echo "données post :<br>";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        echo "fin données </br>";

        if (!empty($_POST)) {
            $valide =
                (!empty($_POST['date'])) &&
                (!empty($_POST['moment'])) &&
                (!empty($_POST['directeurDePlongee'])) &&
                (!empty($_POST['site'])) &&
                (!empty($_POST['securiteDeSurface'])) &&
                (!empty($_POST['embarcation'])) &&
                (!empty($_POST['etat'])) &&
                (!empty($_POST['hDepart'])) &&
                (!empty($_POST['tpsPervu'])) &&
                (!empty($_POST['profondeurPrevu'])) &&
                (!empty($_POST['hArrivee'])) &&
                (!empty($_POST['tpsRealise'])) &&
                (!empty($_POST['profondeurRealise']));

            $data = $_POST;

            if ($valide) {
                require_once('model/modelPlongee.php');
                $model = new modelPlongee();
                $model->addOrModifyPlongee($data);
            } else {
                echo '<strong>erreur, formulaire invalide</strong>';
            }

        }
    }

    public function selectMoment()
    {
        $req = array(
            array(
                'CODE' => 'M',
                'LIBELLE' => 'matin'
            ),
            array(
                'CODE' => 'A',
                'LIBELLE' => 'apres-midi'
            ),
            array(
                'CODE' => 'S',
                'LIBELLE' => 'soir'
            )
        );

        if (isset($_POST['moment'])) {
            $defaultCode = $_POST['moment'];
        } else {
            $defaultCode = null;
        }
        echo $this->listeDeroulante($req, "LIBELLE", "CODE", $defaultCode);
    }

    public function selectSite()
    {
        require_once('model/modelSite.php');
        $reader = new modelSite();
        $req = $reader->getAll();
        if (isset($_POST['site'])) {
            $defaultCode = $_POST['site'];
        } else {
            $defaultCode = null;
        }



        echo $this->listeDeroulante($req, "SIT_NOM", "SIT_NUM", $defaultCode);
    }

    public function selectDirecteurDePlongee()
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $req = $reader->getDirecteurDePlongee();
        if (isset($_POST['directeurDePlongee'])) {
            $defaultCode = $_POST['directeurDePlongee'];
        } else {
            $defaultCode = null;
        }
        echo $this->listeDeroulante($req, "PER_NOM", "PER_NUM", $defaultCode);
    }

    public function selectSecuriteDeSurface()
    {
        require_once('model/modelPersonne.php');
        $reader = new modelPersonne();
        $req = $reader->getSecuriteDeSurface();
        if (isset($_POST['securiteDeSurface'])) {
            $defaultCode = $_POST['securiteDeSurface'];
        } else {
            $defaultCode = null;
        }
        echo $this->listeDeroulante($req, "PER_NOM", "PER_NUM", $defaultCode);
    }

    public function selectEmbarcation()
    {
        require_once('model/modelEmbarcation.php');
        $reader = new modelEmbarcation();
        $req = $reader->getAll();
        if (isset($_POST['embarcation'])) {
            $defaultCode = $_POST['embarcation'];
        } else {
            $defaultCode = null;
        }
        echo $this->listeDeroulante($req, "EMB_NOM", "EMB_NUM", $defaultCode);
    }


    /*
requette ajout plongé

*/

}

?>