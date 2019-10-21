<?php

class controllerListePlongee
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

    public function mentions()
    {
        $this->_view = new View('ListePlongee');
        $this->_view->generate(array(), $this);
    }

    public function listePlongee()
    {
        $plongee = $this->selectPlongee();
        foreach ($plongee as $key => $contents)
        {
            echo '<tr>';

            foreach ($contents as $key => $content)
            {
                echo '<td>';
                if($key == "PLO_DATE")echo "Date => ".$content;
                else if($key == "PLO_MAT_MID_SOI")$this->matMidSoi($key, $content);
                else if($key == "SIT_NUM")$this->sitePlongee($content);
                else if($key == "EMB_NUM")$this->embPlongee($content);
                else if($key == "PER_NUM_DIR")$this->dirPlongee($content);
                else if($key == "PER_NUM_SECU")$this->secuPlongee($content);
                echo '</td>';
            }
            echo '<td><input type="button" value="Detail" onclick="window.location.href=\'Plongee&date='.$contents['PLO_DATE'].'&matMidSoi='.$contents['PLO_MAT_MID_SOI'].'\'"> </td>';

            echo '</tr>';
        }

    }

    public function selectPlongee()
    {
        $model = new modelPlongee();
        return $model->getAll();
    }

    public function matMidSoi($key,$content)
    {
        echo $key . ' => ';
        if($content == 'A')
        {
            echo "Midi";
        }
        else if($content == 'M')
        {
            echo "Matin";
        }
        else if($content == 'S')
        {
            echo "Soir";
        }
    }

    public function sitePlongee($num)
    {
        $modelSite = new modelSite();
        $site = $modelSite->getSiteByNum($num);
        echo "Site => ".$site["SIT_NOM"];
    }

    public function embPlongee($num)
    {
        $modelEmb = new modelEmbarcation();
        $emb = $modelEmb->getEmbarcationByNum($num);
        echo "Embarcation => ".$emb["EMB_NOM"];
    }

    public function dirPlongee($num)
    {
        $modelPers = new modelPersonne();
        $emb = $modelPers->getPersonneByNum($num);
        echo "Directeur => ".$emb["PER_NOM"]." ".$emb["PER_PRENOM"];
    }

    public function secuPlongee($num)
    {
        $modelPers = new modelPersonne();
        $emb = $modelPers->getPersonneByNum($num);
        echo "Securité de surface => ".$emb["PER_NOM"]." ".$emb["PER_PRENOM"];
    }
}