<?php

class controllerListePlongee
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
        $this->_view = new View('ListePlongee');
        $this->_view->generate(array(), $this);
        echo "<script type='text/javascript'>updatePlongee()</script>";
    }
}