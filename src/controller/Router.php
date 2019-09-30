<?php

require_once('views/view.php');

class Router
{
    private $_controller;
    private $_view;

    public function routeRequete()
    {
        try
        {
            //Chargement automatique des classes
            spl_autoload_register(function($class){require_once('models/'.$class.'php');});

            $url = '';

            if(isset($_GET['url']))
            {
                //On récupère tous les paramètres de l'url séparément.
                $url = explode('/',filter_var($_GET['url']),FILTER_SANITIZE_URL);

                //Construction + référencement du controller à utiliser.
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass.".php";

                //une fois construit, on regarde si le fichier existe
                if(file_exists($controllerFile))
                {
                    require_once($controllerFile);
                    //on crée une instance de la classe incluse
                    $this->_controller = new $controllerClass($url);
                }
                else
                {
                    throw new Exception('Page introuvable');
                }
            }
            else
            {
                //La page à lancer par défaut
                $this->_view = new view('Accueil');
                $this->_view->generate(array());
            }

        }
        catch (Exception $e)
        {
            $errorMsg = $e->getMessage();
            $this->_view = new view('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}