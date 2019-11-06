<?php

class controllerPlongee extends controller
{
    private $_view;
    private $plongeePassee;

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
        $this->plongeePassee = false;

        $this->traitementFormulaire();

        $plongeeDefinit = (!empty($_POST["date"]) and !empty($_POST["moment"]));
        if ($plongeeDefinit) {
            $this->plongeePassee = $this->isPlongeePassee();
            $this->chargerPlongee();
        }

        $this->_view = new View('Plongee');
        $this->_view->generate(array(), $this);

        if ($plongeeDefinit) {
            echo "<script type='text/javascript'>initListePalanquee('" . $_POST['date'] . "','" . $_POST['moment'] . "')</script>";
        }
    }

    public function isPlongeePassee()
    {

        $dateAujourdhui = explode("-", date("Y-m-d"));
        $datePlongee = explode("-", $_POST['date']);
        $dateValide = $dateAujourdhui[0] >= $datePlongee[0];

        if ($dateValide) {
            $dateValide = $dateAujourdhui[1] >= $datePlongee[1];
            if ($dateValide) {
                $dateValide = $dateAujourdhui[2] >= $datePlongee[2];
                return $dateValide;
            }
        }
    }

    public function selectAll()
    {
        require_once('model/modelPalanquee.php');
        $reader = new modelPalanquee();
        $moment = $_POST['moment'];
        $date = $_POST['date'];
        $palanquee = $reader->getDansPlongee($date, $moment);
        return $palanquee;
    }

    public function verifierRempliPrimaire($n)
    {
        echo "\"";
        if (isset($_POST[$n])) {
            $var = $_POST[$n];
            echo $var;
            echo "\"";
            echo "readOnly";
        } else {
            echo "\"";
        }
    }

    public function verifierRempli($n)
    {
        echo "\"";
        if (isset($_POST[$n])) {
            $var = $_POST[$n];
            //if ($var <> "")
            echo $var;
            echo "\"";
            if ($this->plongeePassee) {
                echo "disabled";
            }
        } else {
            echo "\"";
        }
    }

    public function selectIsDisabledPrimaire($n)
    {
       if (isset($_POST["moment"])) {
            echo "disabled";
        }
    }

    public function selectIsDisabled($n)
    {
        if (isset($_POST[$n]) && $this->plongeePassee) {
            echo "disabled";
        } else {
        }
    }

    public function etat($test)
    {
        if($test==0)
        {
            echo "État : ";
        }
        if(!isset($_POST["etat"]))
        {
            echo "Créée";
        }
        else
        {
            echo $_POST["etat"];
        }
    }

    /**
     * method for saving data to the DB
     */
    public function traitementFormulaire()
    {
            $valide =
                (!empty($_POST['moment'])) &&
                (!empty($_POST['directeurDePlongee'])) &&
                (!empty($_POST['site'])) &&
                (!empty($_POST['securiteDeSurface'])) &&
                (!empty($_POST['embarcation']));

            $data = $_POST;

            if ($valide) {
                require_once('model/modelPlongee.php');
                $model = new modelPlongee();
                try {
                    $model->addOrModifyPlongee($data);
                    echo '<strong>Donées correctement enregistré.</strong>';
                } catch (Exception $e) {
                    echo '<strong>Erreur d\'ecriture dans la base. <br></strong> ', $e->getMessage();
                }
            } else {
                echo '<strong>erreur, formulaire invalide</strong>';
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

    /**
     * charge une plongé a partir des données get (tester s'il faut charger avant )
     */
    public function chargerPlongee()
    {
        $reader = new modelPlongee();
        $plongee = $reader->getMatch($_POST["date"], $_POST["moment"])[0];
        if (isset($plongee)) {

            if (array_key_exists("PER_NUM_DIR", $plongee)) {
                $_POST['directeurDePlongee'] = $plongee["PER_NUM_DIR"];
            }
            if (isset($plongee["SIT_NUM"])) {
                $_POST['site'] = $plongee["SIT_NUM"];
            }
            if (isset($plongee["PER_NUM_SECU"])) {
                $_POST['securiteDeSurface'] = $plongee["PER_NUM_SECU"];
            }
            if (isset($plongee["EMB_NUM"])) {
                $_POST['embarcation'] = $plongee["EMB_NUM"];
            }
            if (isset($plongee["PLO_ETAT"])&&empty($_POST['etat'])) {
                $_POST['etat'] = $plongee["PLO_ETAT"];
            }
        }
    }
}

?>