<?php

class controllerPalanquee
{
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->mentions();
        }
    }

    public function mentions()
    {
        $this->_view = new View('Palanquee');
        $this->_view->generate(array());
    }
}