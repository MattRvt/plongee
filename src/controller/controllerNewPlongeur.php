<?php

class controllerNewPlongeur extends controller
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
        $this->_view = new View('NewPlongeur');
        $this->_view->generate(array(),$this);
    }

    public  function selectAptitude()
    {
        require_once('model/modelAptitude.php');
        $reader = new modelAptitude();
        echo $this->listeDeroulante($reader, "APT_LIBELLE","APT_CODE");
    }

    function verifierRempli($n)
    {
        if (isset($_POST[$n])) {
            $var = $_POST[$n];
            if ($var <> "")
                echo $var;
        } else
            echo "";
    }

    function VerifSelectAptitude($n)
    {
        if (isset($_POST["seance"])) {
            if ($_POST["seance"] == $n)
                echo "selected";
        }
    }

    function VerifSelectFonction($n)
    {
        if (isset($_POST["fonction"])) {
            if ($_POST["fonction"] == $n)
                echo "selected";
        }
    }
}

?>