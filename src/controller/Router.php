<?php

require_once('views/view.php');

class Router
{
    private $_controller;
    private $_view;

    public function routeRequete()
    {
        require_once ("model/Settings.php");
        try
        {
            //Chargement automatique des classes
            spl_autoload_register(function($class){
                $pathContorllers = 'controller/' . $class . '.php';
                $pathViews = 'views/' . $class . '.php';
                $pathModels = 'model/' . $class . '.php';

                if (file_exists($pathContorllers))
                {
                    require_once($pathContorllers);
                }
                elseif (file_exists($pathViews))
                {
                    require_once($pathViews);
                }
                elseif (file_exists($pathModels))
                {
                    require_once($pathModels);
                }
            });

            $url = '';

            if(isset($_GET['url']))
            {
                //On récupère tous les paramètres de l'url séparément.
                $url = explode('/',filter_var($_GET['url']),FILTER_SANITIZE_URL);

                //Construction + référencement du controller à utiliser.
                $controller = $url[0];
                $controllerClass = "controller".$controller;
                $controllerFile = "controller/".$controllerClass.".php";

                //une fois construit, on regarde si le fichier existe
                if(file_exists($controllerFile))
                {
                    require_once($controllerFile);
                    //on crée une instance de la classe incluse
                    $this->_controller = new $controllerClass($url);
                }
                else
                {
                    throw new Exception("Page introuvable");
                }
            }
            else
            {
                require_once("controller/controllerAccueil.php");
                //on crée une instance de la classe incluse
                $this->_controller = new controllerAccueil(array(1=>1));
            }

        }
        catch (Exception $e)
        {
            $errorMsg = $e->getMessage();
            $this->_view = new view('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg),NULL);
        }
    }
}