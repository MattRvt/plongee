<?php

class controllerHistoriqueDesPalanquees  extends controller
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

    public function selectPalanquee()
    {
        require_once('model/modelPalanque.php');
        $reader = new modelPalanque();
        $palanquee = $reader->getAll();
        return $palanquee;
    }

    public function mentions()
    {
        $this->_view = new View('HistoriqueDesPalanquees');
        $this->_view->generate(array(), $this);
    }


}

?>