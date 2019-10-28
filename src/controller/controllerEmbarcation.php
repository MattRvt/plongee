<?php

class controllerEmbarcation
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->Embarcation();
        }
    }

    public function Embarcation()
    {
        $this->_view = new View('Embarcation');
        $this->_view->generate(array(), $this);
        echo "<script type='text/javascript'>updateEmbarcation()</script>";
    }
}