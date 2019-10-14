<?php

class controllerSelectAptitude extends controller
{
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->SelectAptitude();
        }
    }

    public function SelectAptitude()
    {
        $text = '<h6>Aptitude</h6><br/><select id="aptitude" class="browser-default">';

        $reader = new modelAptitude();
        $data = $reader->getAll();

        $text = $text.$this->listeDeroulante($data, "APT_LIBELLE","APT_CODE");

        $text = $text.'</select>';

        echo $text;
    }
}