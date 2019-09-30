<?php

class view
{
    private $_file;
    private $_title;

    public function __construct($action)
    {
        //on construit le chemin d'acces de la vue
        $this->_file = 'views/view'.$action.'.php';
    }

    public function generate($data)
    {
        //construit la vue à afficher avec le header et le footer
        $content = $this->generateFile($this->_file, $data);

        $view = $this->generateFile('views/template.php',array('title' => $this->_title, 'content' => $content));
        echo $view;
    }

    //genere un fichier vue
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else
        {
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }
}