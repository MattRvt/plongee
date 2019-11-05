<?php


class controllerIsConcerne
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->isConcerned();
        }
    }

    public function isConcerned()
    {
        $num = $_POST['num'];
        $dir = $_POST['directeur'];
        $secu = $_POST['secusurf'];
        $t1 = 1;
        $t2 = 1;

        $reader = new modelConcerner();
        $personne= $reader->isConcerned($num);
        if (sizeof($personne)>0) $t1 = 0;


        if ($dir || $secu){
            $reader2 = new modelPlongee();
            $present = $reader2->isConcerner($num);
            if (sizeof($present)>0) $t2=0;
        }

        echo ($t1 && $t2) ;
    }
}