<?php

class controllerNewPlongeur extends controller
{
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