<?php


class controllerAptitude
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
        $this->_view = new View('Aptitude');
        $this->_view->generate(array(), $this);
        echo "<script type='text/javascript'>updateAptitude()</script>";
    }
}