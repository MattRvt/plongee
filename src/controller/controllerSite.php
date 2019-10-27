<?php


class controllerSite
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->site();
        }
    }

    public function site()
    {
        $this->_view = new View('Site');
        $this->_view->generate(array(), $this);
    }
}