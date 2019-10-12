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
       /* require_once('model/modelAptitude.php');
        $reader = new modelAptitude();
        $aptitude = $reader->getAll();
        return $aptitude;*/
    }
}

?>