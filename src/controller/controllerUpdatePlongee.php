<?php


class controllerUpdatePlongee
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->traitementFormulaire();
        }
    }

    public function traitementFormulaire()
    {
        $valide =
            (!empty($_POST['date'])) &&
            (!empty($_POST['moment'])) &&
            (!empty($_POST['directeurDePlongee'])) &&
            (!empty($_POST['site'])) &&
            (!empty($_POST['securiteDeSurface'])) &&
            (!empty($_POST['embarcation']));

        $data = $_POST;

        if ($valide) {
            $model = new modelPlongee();

            if(!$model->plongeeExiste($_POST['date'],$_POST['moment'])) {
                try {
                    $model->addOrModifyPlongee($data);
                } catch (Exception $e) {
                    echo 'Erreur d\'ecriture dans la base', $e->getMessage();
                }
            }
            else
            {
                echo 'erreur, Plongee existe déjà';
            }
        } else {
            echo 'erreur, formulaire invalide';
        }
    }
}
