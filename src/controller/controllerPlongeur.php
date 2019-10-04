<?php

class controllerPlongeur
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
        $this->_view = new View('Plongeur');
        $this->_view->generate(array(),$this);
    }

    public function selectAptitude()
    {
        require_once('model/modelAptitude.php');
        $reader = new modelAptitude();
        $aptitude = $reader->getAll();
        return $aptitude;
    }


}

?>